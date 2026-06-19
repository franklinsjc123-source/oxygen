<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, $request) {
            try {
                $flasher = app(\Flasher\Prime\FlasherInterface::class);
                $flasher->addError('The uploaded files are too large! Please upload smaller files (max total 8MB).');
            } catch (\Throwable $th) {
                // fallback if Flasher is not loaded/fails
            }

            return redirect()->back()->with('error', 'The uploaded files are too large! Please upload smaller files (max total 8MB).');
        });

        $this->renderable(function (\Symfony\Component\HttpFoundation\File\Exception\FileException $e, $request) {
            $msg = 'File upload error: ' . $e->getMessage();
            if ($e instanceof \Symfony\Component\HttpFoundation\File\Exception\IniSizeFileException) {
                $msg = 'One of the uploaded files exceeds the limit (max 2MB per file).';
            }
            try {
                $flasher = app(\Flasher\Prime\FlasherInterface::class);
                $flasher->addError($msg);
            } catch (\Throwable $th) {
                // fallback
            }

            return redirect()->back()->with('error', $msg);
        });
    }
}
