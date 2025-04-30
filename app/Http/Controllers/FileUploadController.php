<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function showDocumentsPage()
    {
        return view('documents');
    }

    public function processUpload(Request $request)
    {
        $request->validate([
            'uploads' => 'required',
            'uploads.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        if ($request->hasFile('uploads')) {
            foreach ($request->file('uploads') as $file) {
                $path = $file->store('public/uploads');
                // Here you can add additional processing logic
            }
        }

        return back()->with('success', 'Files uploaded successfully!');
    }
}
