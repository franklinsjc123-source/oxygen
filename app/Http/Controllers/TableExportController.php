<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TableExportController extends Controller
{
    /**
     * Direct download: receives table HTML via form POST and streams the .xls file back immediately.
     * Works on all platforms including Android WebView because it's a plain HTTP form submission
     * that returns the file as an attachment — no AJAX, no blob URLs, no redirect needed.
     */
    public function directDownload(Request $request)
    {
        $content = $request->input('content', '');
        $filename = $request->input('filename', 'tableExport.xls');

        // Sanitize filename
        $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);
        if (empty($filename) || !str_contains($filename, '.')) {
            $filename = 'tableExport.xls';
        }

        // Add BOM for Excel UTF-8 compatibility
        $bom = "\xEF\xBB\xBF";

        return response($bom . $content)
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    /**
     * Store temporary table export data for HTTP/HTTPS download.
     * Crucial for mobile WebViews where Android DownloadManager can only download HTTP/HTTPS URLs.
     */
    public function storeTempExport(Request $request)
    {
        $rawContent = $request->input('content', '');
        $isBase64 = $request->boolean('is_base64', false);
        $filename = $request->input('filename', 'tableExport.xls');
        $mimeType = $request->input('mime_type', 'application/vnd.ms-excel');

        // Sanitize filename
        $filename = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $filename);
        if (empty($filename) || !str_contains($filename, '.')) {
            $filename = 'tableExport.xls';
        }

        if ($isBase64) {
            $content = base64_decode($rawContent);
        } else {
            $content = $rawContent;
        }

        // Generate a random 40-character token
        $token = Str::random(40);

        // Ensure temp directory exists
        $tempDir = storage_path('app/temp_exports');
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0777, true, true);
        }

        // Clean up temp files older than 1 hour
        try {
            $files = File::files($tempDir);
            $now = time();
            foreach ($files as $file) {
                if ($now - $file->getMTime() > 3600) {
                    File::delete($file->getPathname());
                }
            }
        } catch (\Exception $e) {
            // Ignore cleanup errors
        }

        // Save data and metadata
        $meta = [
            'filename' => $filename,
            'mime_type' => $mimeType,
            'created_at' => time(),
        ];

        file_put_contents($tempDir . '/' . $token . '.meta', json_encode($meta));
        file_put_contents($tempDir . '/' . $token . '.data', $content);
        @chmod($tempDir . '/' . $token . '.meta', 0666);
        @chmod($tempDir . '/' . $token . '.data', 0666);

        $downloadUrl = route('table.export.download', ['token' => $token]);
        $relativeDownloadUrl = route('table.export.download', ['token' => $token], false);

        return response()->json([
            'success' => true,
            'token' => $token,
            'download_url' => $relativeDownloadUrl,
            'full_download_url' => $downloadUrl,
        ]);
    }

    /**
     * Download stored temporary export file via HTTP/HTTPS.
     */
    public function downloadTempExport($token)
    {
        if (!preg_match('/^[a-zA-Z0-9]{40}$/', $token)) {
            abort(404, 'Invalid export token.');
        }

        $tempDir = storage_path('app/temp_exports');
        $metaPath = $tempDir . '/' . $token . '.meta';
        $dataPath = $tempDir . '/' . $token . '.data';

        if (!File::exists($metaPath) || !File::exists($dataPath)) {
            abort(404, 'Export file not found or expired.');
        }

        $meta = json_decode(file_get_contents($metaPath), true);
        $filename = $meta['filename'] ?? 'tableExport.xls';
        $mimeType = $meta['mime_type'] ?? 'application/vnd.ms-excel';

        return response()->download($dataPath, $filename, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
