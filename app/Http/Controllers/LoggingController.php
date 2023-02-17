<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LoggingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ip() != config('constants.debug_ip')) {
            abort('404');
        }
        $pathFile = storage_path('logs/laravel.log');

        if ($request->filled('date')) {
            $pathFile = storage_path('logs/laravel-' . $request->date . '.log');
        }

        if (File::exists($pathFile)) {
            if ($request->clear) {
                file_put_contents($pathFile, "Logs cleared.\n");
            }
            return response(File::get($pathFile))->header('Content-Type', 'text/plain');
        }
    }
}
