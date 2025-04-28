@section('title', __('Clients'))
<x-layouts.app :title="__('Clients')">
    <div class="container-fluid px-4">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">{{ __('Clients List') }}</h3>
                <form method="GET" action="{{ route('clients.index') }}" class="d-flex" style="width: 300px;">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" 
                               placeholder="{{ __('Search clients...') }}" 
                               value="{{ request('search') }}">
                        <button class="btn btn-light btn-sm" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('clients.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if(request('search') && $clients->isEmpty())
    <div class="alert alert-warning alert-dismissible fade show">
        {{ __('No clients found matching your search.') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" 
                style="padding: 0.25rem; transform: scale(0.8); margin-right: -0.25rem;"></button>
    </div>
@endif

                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="background-color: #e3f2fd;">{{ __('Code') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Company') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Type') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Address') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Postal Code') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Activity') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Tax ID') }}</th>
                                <th style="background-color: #e3f2fd;">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td class="fw-semibold">{{ $client->code }}</td>
                                    <td>{{ $client->raison_sociale }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($client->type_client === 'étatique') bg-info
                                            @elseif($client->type_client === 'privée') bg-success
                                            @else bg-warning text-dark
                                            @endif">
                                            {{ ucfirst($client->type_client) }}
                                        </span>
                                    </td>
                                    <td>{{ $client->adresse }}</td>
                                    <td>{{ $client->code_postal }}</td>
                                    <td>{{ $client->activite }}</td>
                                    <td>{{ $client->matricule_fiscale }}</td>
                                    <td>
                                        @if($client->blockage)
                                            <span class="badge bg-danger rounded-pill">
                                                <i class="fas fa-lock me-1"></i> {{ __('Blocked') }}
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-check me-1"></i> {{ __('Active') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                            <div class="empty-state-icon mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-binoculars text-muted" viewBox="0 0 16 16">
                                                    <path d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5zM11 7v.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V7zm-3 5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3zm-6 0v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3z"/>
                                                </svg>
                                            </div>
                                            
                                            <h4 class="h5 text-muted mb-3">
                                                @if(request('search'))
                                                    {{ __('No matches for') }} "<strong>{{ request('search') }}</strong>"
                                                @else
                                                    {{ __('No clients found') }}
                                                @endif
                                            </h4>

                                            @if(request('search'))
                                            <p class="text-center text-muted mb-4">
                                                {{ __('Try adjusting your search or remove filters') }}
                                            </p>
                                            <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">
                                                <i class="fas fa-undo me-2"></i>
                                                {{ __('Clear search') }}
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($clients->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        {{ __('Showing') }} {{ $clients->firstItem() }} - {{ $clients->lastItem() }} {{ __('of') }} {{ $clients->total() }}
                    </div>
                    <nav>
                        {{ $clients->appends(request()->query())->links() }}
                    </nav>
                </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .btn-close {
    --bs-btn-close-focus-shadow: none;
    background-size: 0.6em;
    padding: 0.5rem;
    transform: scale(0.8);
}
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
        .rounded-pill {
            padding: 0.35em 0.65em;
        }
        .table th {
            border-top: none;
            border-bottom: 2px solid #dee2e6;
        }
        .empty-state-icon {
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .empty-state-icon:hover {
            opacity: 0.8;
        }
        .btn-outline-primary {
            transition: all 0.2s ease;
        }
        .btn-outline-primary:hover {
            transform: translateY(-1px);
        }
    </style>
    @endpush
</x-layouts.app>