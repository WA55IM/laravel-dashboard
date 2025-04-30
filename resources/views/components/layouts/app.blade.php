<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="layout-menu-fixed" data-base-url="{{url('/')}}" data-framework="laravel">
<head>
  @include('partials.head')
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
  
  <!-- Dropzone CSS -->
  <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
  
  <!-- Custom Styles -->
  @stack('styles')
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Layout Content -->
      <x-layouts.menu.vertical :title="$title ?? null"></x-layouts.menu.vertical>
      <!--/ Layout Content -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <x-layouts.navbar.default :title="$title ?? null"></x-layouts.navbar.default>
        <!--/ Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            {{ $slot }}
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <x-layouts.footer.default :title="$title ?? null"></x-layouts.footer.default>
          <!--/ Footer -->
          <div class="content-backdrop fade"></div>
          <!-- / Content wrapper -->
        </div>
      </div>
      <!-- / Layout page -->
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center">
    <div class="container py-3">
      <p>© {{ date('Y') }} Logicom Informatique. All rights reserved.</p>
    </div>
  </footer>

  <!-- Core JS -->
  @include('partials.scripts')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
  
  <!-- Dropzone JS -->
  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
  
  <!-- Custom Scripts -->
  @stack('scripts')

  <!-- Dropzone Configuration -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Initialize Dropzone if element exists
      if (document.getElementById("kt_dropzonejs_example_1")) {
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
          url: document.getElementById("kt_dropzonejs_example_1").action,
          paramName: "document",
          maxFiles: 10,
          maxFilesize: 10,
          acceptedFiles: ".pdf,image/*",
          addRemoveLinks: true,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          accept: function(file, done) {
            // Custom validation
            if (file.name.toLowerCase() === "forbidden.pdf") {
              done("This file is not allowed.");
            } else {
              done();
            }
          },
          init: function() {
            // Handle form submission
            document.getElementById("kt_dropzonejs_example_1").addEventListener("submit", function(e) {
              e.preventDefault();
              if (myDropzone.getQueuedFiles().length > 0) {
                myDropzone.processQueue();
              } else {
                alert("Please select files to upload.");
              }
            });
          }
        });
      }
    });
  </script>
  <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
</body>
</html>