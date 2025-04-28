@section('title', __('Dashboard'))
<x-layouts.app :title="__('Dashboard')">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

  <div class="container mt-4">
    <div class="mb-4">
      <h2>Welcome, {{ $user->name }}!</h2>
      
  </div>
    <div class="row">
        <!-- Component 1: Total Users -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
              <div class="card-body d-flex flex-column justify-content-between">
                  <!-- Add the stretched-link anchor -->
                  <a href="{{ route('users.index') }}" class="stretched-link text-decoration-none"></a>
                  
                  <div class="d-flex align-items-center">
                      <i class="fas fa-users text-primary me-2"></i>
                      <span class="fs-5">Total Utilisateurs</span>
                  </div>
                  <h1 class="fs-3 fw-bold">{{$totalUsers}}</h1>
              </div>
          </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <a href="{{ route('clients.index') }}" class="stretched-link text-decoration-none"></a>
                <div class="d-flex align-items-center">
                    <i class="fas fa-users text-primary me-2"></i>
                    <span class="fs-5">Total Clients</span>
                </div>
                <h1 class="fs-3 fw-bold">{{ $totalClients }}</h1>
            </div>
        </div>
    </div>

        <!-- Component 2: Total Bank Accounts -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <a href="{{ route('comptes.index') }}" class="stretched-link text-decoration-none"></a>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-university text-primary me-2"></i>
                        <span class="fs-5">Total Comptes Bancaires</span>
                    </div>
                    <h1 class="fs-3 fw-bold">{{$totalComptes}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    
                    <div class="d-flex align-items-center">
                        <i class="fas fa-truck text-primary me-2"></i>
                        <span class="fs-5">Total Fournisseurs</span>
                    </div>
                    <h1 class="fs-3 fw-bold">{{$totalFournisseurs}}</h1>
                </div>
            </div>
        </div>

        <!-- Component 3: Total Uploaded Files -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-upload text-primary me-2"></i>
                        <span class="fs-5">Total Fichiers Uploadés</span>
                    </div>
                    <h1 class="fs-3 fw-bold"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Calendar</h5>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) { // Ensure the element exists
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
               
                eventColor: '#007bff', // Matches your dashboard's primary color
                height: 'auto' // Adjusts height dynamically
            });
            calendar.render();
        } else {
            console.error('Calendar element not found!');
        }
    });
</script>

<!-- Optional Styling -->
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
    .fc {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .fc-button {
        background-color: #007bff !important;
        border: none !important;
    }
    .fc-button:hover {
        background-color: #0056b3 !important;
    }
</style>

</x-layouts.app>


