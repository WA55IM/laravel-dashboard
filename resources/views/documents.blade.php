@section('title', __('Documents'))
<x-layouts.app :title="__('Documents')">
    <!-- Include Flowbite CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />
    
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('Documents') }}</h1>

        <!-- Upload Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Upload Documents') }}</h5>
            </div>
            <div class="card-body">
                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Processing Results --}}
                @if(session('result'))
                    <div class="alert alert-light alert-dismissible fade show mb-4" role="alert">
                        <h6 class="alert-heading">Processing Results:</h6>
                        <div class="mt-2">
                            <div class="p-2 border rounded border-success">
                                <strong>Type:</strong> {{ session('result')['classification']['class'] }}
                                <span class="ms-3">Confidence: {{ number_format(session('result')['classification']['confidence'] * 100, 1) }}%</span>
                                
                                @if(isset(session('result')['fields']))
                                    <div class="mt-2">
                                        <h6>Extracted Fields:</h6>
                                        <ul class="list-unstyled">
                                            @foreach(session('result')['fields'] as $field => $data)
                                                <li class="mb-1">
                                                    <i class="fas fa-file-alt text-primary"></i>
                                                    <strong>{{ ucfirst($field) }}:</strong> 
                                                    {{ $data['validated'] ?: $data['text'] }}
                                                    <span class="text-muted">(Confidence: {{ number_format($data['confidence'] * 100, 2) }}%)</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Upload Form with Dropzone -->
                <form class="form" 
                      action="{{ route('documents.process-upload') }}" 
                      method="post"
                      enctype="multipart/form-data"
                      id="documentUploadForm"
                      onsubmit="handleFormSubmit()">
                    @csrf

                    <!-- Dropzone Component -->
                    <div class="max-w-full mx-auto">
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Upload your document to process</p>
                                </div>
                                <input id="dropzone-file" name="document" type="file" class="hidden" required />
                            </label>
                        </div>
                        <p id="file-name" class="mt-2 text-center text-sm text-gray-500" style="display: none;"></p>
                    </div>

                    <!-- Image Preview Section -->
                    <div class="mt-3 mb-3" id="previewContainer" style="display: none;">
                        <img id="previewImage" class="img-fluid rounded" alt="Preview">
                    </div>
                    
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-cloud-upload-alt me-2"></i> Process Document
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Processed Documents List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">{{ __('Processed Documents') }}</h5>
                <a href="{{ route('documents.index') }}" class="btn btn-sm btn-light-primary">
                    <i class="fas fa-list me-2"></i> View All
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Type</th>
                            <th>Confidence</th>
                            <th>Fields</th>
                            <th>Uploaded At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>{{ basename($document->path) }}</td>
                                <td>{{ $document->type }}</td>
                                <td>{{ number_format($document->confidence * 100, 1) }}%</td>
                                <td>
                                    @if($document->fields)
                                        <ul>
                                            @foreach($document->fields as $field => $data)
                                                <li>{{ ucfirst($field) }}: {{ $data['validated'] ?: $data['text'] }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $document->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.4.4/dist/flowbite.js"></script>
    <script>
        // Form submission handler
        function handleFormSubmit() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Processing...
            `;
        }

        // Initialize dropzone functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropzoneFile = document.getElementById('dropzone-file');
            const dropzoneLabel = document.querySelector('label[for="dropzone-file"]');
            
            // File input change event
            dropzoneFile.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImage').src = e.target.result;
                        document.getElementById('previewContainer').style.display = 'block';
                        
                        // Show filename under dropzone
                        const fileNameElement = document.getElementById('file-name');
                        if (fileNameElement) {
                            fileNameElement.textContent = file.name;
                            fileNameElement.style.display = 'block';
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    document.getElementById('previewContainer').style.display = 'none';
                    
                    // Hide filename
                    const fileNameElement = document.getElementById('file-name');
                    if (fileNameElement) {
                        fileNameElement.style.display = 'none';
                    }
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzoneLabel.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzoneLabel.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzoneLabel.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzoneLabel.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight() {
                dropzoneLabel.classList.remove('border-blue-500', 'bg-blue-50');
            }

            dropzoneLabel.addEventListener('drop', handleDrop, false);


            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    dropzoneFile.files = files;
                    
                    // Trigger change event to show preview
                    const event = new Event('change');
                    dropzoneFile.dispatchEvent(event);
                }
            }
            
        });
        
    </script>
</x-layouts.app>