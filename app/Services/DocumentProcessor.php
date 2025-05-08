<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;

class DocumentProcessor
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('PYTHON_SERVICE_URL', 'http://localhost:5000'),
            'timeout' => 30.0,
        ]);
    }

    public function processDocument(UploadedFile $file)
    {
        $response = $this->client->post('/process-document', [
            'multipart' => [
                [
                    'name' => 'document',
                    'contents' => fopen($file->getRealPath(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}