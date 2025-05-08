<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentProcessor;
use App\Models\Document;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    protected $processor;

    public function __construct(DocumentProcessor $processor)
    {
        $this->processor = $processor;
    }

    public function showDocumentsPage()
    {
        return view('documents');
    }

    public function processUpload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        try {
            $file = $request->file('document');
            
            // Process with Python service
            $result = $this->processor->processDocument($file);
            
            // Save to database
            $document = new Document();
            $document->type = $result['classification']['class'] ?? 'Unknown';
            $document->confidence = $result['classification']['confidence'] ?? 0;
            $document->fields = $result['fields'] ?? null;
            $document->path = $file->store('public/uploads'); // Saves to storage/app/public/uploads
            $document->save();

            return back()
                ->with('success', 'Document processed successfully!')
                ->with('result', $result);

        } catch (\Exception $e) {
            Log::error('Document processing failed: ' . $e->getMessage());
            return back()
                ->with('error', 'Processing failed: ' . $e->getMessage());
        }
    }
}