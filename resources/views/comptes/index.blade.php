@section('title', __('Bank Accounts'))
<x-layouts.app :title="__('Bank Accounts')">
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('Bank Accounts') }}</h1>

        <!-- Add Button -->
        <div class="mb-4">
            <a href="{{ route('comptes.create') }}" class="btn btn-primary">
                {{ __('Add Bank Account') }}
            </a>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('comptes.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="{{ __('Search...') }}" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
            </div>
        </form>

        <!-- Comptes Table -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Nom Bank') }}</th>
                            <th scope="col">{{ __('RIB') }}</th>
                            <th scope="col">{{ __('IBAN') }}</th>
                            <th scope="col">{{ __('SWIFT') }}</th>
                            <th scope="col">{{ __('Type Compte') }}</th>
                            <th scope="col">{{ __('User Name') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comptes as $compte)
                            <tr>
                                <td>{{ $compte->id }}</td>
                                <td>{{ $compte->nom_bank }}</td>
                                <td>{{ $compte->rib }}</td>
                                <td>{{ $compte->iban ?? '-' }}</td>
                                <td>{{ $compte->swift ?? '-' }}</td>
                                <td>{{ ucfirst($compte->type_compt) }}</td>
                                <td>{{ $compte->user?->name ?? '-' }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('comptes.edit', $compte->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> {{ __('Edit') }}
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('comptes.destroy', $compte->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">
                                            <i class="fas fa-trash"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('No bank accounts found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $comptes->links() }}
        </div>
    </div>
</x-layouts.app>