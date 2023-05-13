<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadFileRequest;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadFile(DownloadFileRequest $request)
    {
//        $filename = $request->file_name;
        $path = $request->path;
        if (!Storage::disk('public')->exists($path)) {
            return redirect()->back()->withErrors(['file_name' => 'Файл табылмады']);
        }
        return Storage::disk('public')->download($path);
//        $filename = explode('/', $filename);
//        $filename = end($filename);
//        $content = file_get_contents($filepath);
//        return response($content)->withHeaders([
//            'Content-Type' => mime_content_type($filepath),
//            'Content-disposition' => "attachment; filename=$filename"
//        ]);
    }

}
