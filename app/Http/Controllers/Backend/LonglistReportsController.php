<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LonglistReportsController extends Controller
{
    //
    public function listReports()
    {
        // Get all files in the pdf directory
        $files = Storage::files('pdfs');

        // Pass files to the view
        return view('reports.longlist_index', ['files' => $files]);
    }

    public function downloadReport($fileName)
    {
        $filePath = 'pdfs/' . $fileName;

        // Check if the file exists
        if (!Storage::exists($filePath)) {
            return abort(404, 'File not found.');
        }

        // Return file as a download
        return Storage::download($filePath);
    }
}
