@section('title', __('Documents'))
<x-layouts.app :title="__('Documents')">
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('Documents') }}</h1>

        <!-- Upload Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Upload Documents') }}</h5>
            </div>
            <div class="card-body">
                {{-- Processing Results Display --}}
                @if(session('processingResults'))
                    <div class="alert alert-light alert-dismissible fade show mb-4" role="alert">
                        <h6 class="alert-heading">Processing Results:</h6>
                        <div class="mt-2">
                            @foreach(session('processingResults') as $result)
                                <div class="mb-2 p-2 border rounded 
                                    @if($result['status'] === 'success') border-success @else border-danger @endif">
                                    
                                    <strong>{{ $result['file'] }}</strong>
                                    
                                    @if($result['status'] === 'success')
                                        <div class="mt-2">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <span>Type: <strong>{{ $result['data']['classification']['class'] }}</strong></span>
                                            <span class="ms-3">Confidence: {{ number_format($result['data']['classification']['confidence'] * 100, 1) }}%</span>
                                        </div>
                                        
                                        @if(isset($result['data']['fields']))
                                            <div class="mt-2">
                                                <h6>Extracted Fields:</h6>
                                                <ul class="list-unstyled">
                                                    @foreach($result['data']['fields'] as $field => $data)
                                                        <li class="mb-1">
                                                            <i class="fas fa-file-alt text-primary"></i>
                                                            <strong>{{ ucfirst($field) }}:</strong> 
                                                            {{ $data['validated'] ?: $data['text'] }}
                                                            <span class="text-muted">(Confidence: {{ $data['confidence'] * 100 }}%)</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        
                                    @else
                                        <div class="mt-2 text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Error: {{ $result['message'] }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!--begin::Form-->
                <form class="form" 
                      action="{{ route('documents.process-upload') }}" 
                      method="post"
                      id="kt_dropzonejs_example_1"
                      enctype="multipart/form-data">
                    @csrf
                    
                    <!--begin::Dropzone-->
                    <div class="fv-row">
                        <div class="dropzone" id="kt_dropzonejs_example_1">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>

                                <!--begin::Info-->
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files (PDF, JPG, PNG)</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <!--end::Dropzone-->

                        <!-- Process Button -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cloud-upload-alt me-2"></i> {{ __('Process Upload') }}
                            </button>
                        </div>
                    </div>
                    <!--end::Input group-->
                </form>
                <!--end::Form-->
            </div>
        </div>

        <!-- Uploaded Documents List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title mb-0">{{ __('Processed Documents') }}</h5>
                <a href="{{ route('documents.index') }}" class="btn btn-sm btn-light-primary">
                    <i class="fas fa-list me-2"></i> View All
                </a>
            </div>
            <div class="card-body">
                <!-- Document list implementation goes here -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("kt_dropzonejs_example_1")) {
                // Initialize Dropzone
                const myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                    url: "{{ route('documents.process-upload') }}",
                    paramName: "uploads", // Changed to match controller's expected input
                    maxFiles: 10,
                    maxFilesize: 10, // MB
                    acceptedFiles: "image/*,application/pdf",
                    addRemoveLinks: true,
                    autoProcessQueue: false,
                    parallelUploads: 10,
                    uploadMultiple: true,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    init: function() {
                        this.on("addedfile", file => {
                            // Add custom preview template
                            const previewTemplate = `
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-image">
                                        <img data-dz-thumbnail />
                                    </div>
                                    <div class="dz-details">
                                        <div class="dz-size">
                                            <span data-dz-size></span>
                                        </div>
                                        <div class="dz-filename">
                                            <span data-dz-name></span>
                                        </div>
                                    </div>
                                    <div class="dz-progress">
                                        <span class="dz-upload" data-dz-uploadprogress></span>
                                    </div>
                                    <div class="dz-error-message">
                                        <span data-dz-errormessage></span>
                                    </div>
                                    <div class="dz-success-mark">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dz-error-mark">
                                        <i class="fas fa-times"></i>
                                    </div>
                                </div>
                            `;
                            file.previewElement.innerHTML = previewTemplate;
                        });

                        // Handle form submission
                        document.querySelector('form').addEventListener('submit', (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            if (myDropzone.getQueuedFiles().length > 0) {
                                myDropzone.processQueue();
                            }
                        });

                        this.on("successmultiple", (files, response) => {
                            // Handle success response
                        });

                        this.on("errormultiple", (files, response) => {
                            // Handle error response
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>