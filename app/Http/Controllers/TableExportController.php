<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TableExportController extends Controller
{
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

        $relativeDownloadUrl = ($basePath ? $basePath : '') . '/export-table-download/' . $token;
        $downloadUrl = $scheme . $host . $relativeDownloadUrl;

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
