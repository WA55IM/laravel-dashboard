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
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
            <div class="card-header">
                <h5 class="card-title mb-0">{{ __('Uploaded Documents') }}</h5>
            </div>
            <div class="card-body">
                <!-- Add documents list here -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Only initialize if element exists
            if (document.getElementById("kt_dropzonejs_example_1")) {
                // Set up CSRF token for Laravel
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
                    url: "{{ route('documents.process-upload') }}",
                    paramName: "document",
                    maxFiles: 10,
                    maxFilesize: 10, // MB
                    acceptedFiles: ".pdf,image/*",
                    addRemoveLinks: true,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    dictDefaultMessage: "Drop files here or click to upload",
                    init: function() {
                        this.on("error", function(file, message) {
                            console.error("Upload Error:", message);
                            alert(message);
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>