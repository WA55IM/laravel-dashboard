@section('title', __('Create Compte'))
<x-layouts.app :title="__('Create Compte')">
    <h1 class="mb-4">{{ __('Create Compte') }}</h1>
    <form action="{{ route('comptes.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="row g-4">
            <!-- Nom Bank -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nom_bank" class="form-label">{{ __('Nom Bank') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nom_bank') is-invalid @enderror" id="nom_bank" name="nom_bank" value="{{ old('nom_bank') }}" required>
                    @error('nom_bank')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- RIB -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="rib" class="form-label">{{ __('RIB') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('rib') is-invalid @enderror" id="rib" name="rib" value="{{ old('rib') }}" required>
                    @error('rib')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- IBAN -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="iban" class="form-label">{{ __('IBAN') }}</label>
                    <input type="text" class="form-control @error('iban') is-invalid @enderror" id="iban" name="iban" value="{{ old('iban') }}">
                    @error('iban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- SWIFT -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="swift" class="form-label">{{ __('SWIFT') }}</label>
                    <input type="text" class="form-control @error('swift') is-invalid @enderror" id="swift" name="swift" value="{{ old('swift') }}">
                    @error('swift')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- Type Compt -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="type_compt" class="form-label">{{ __('Type Compt') }} <span class="text-danger">*</span></label>
                    <select class="form-select @error('type_compt') is-invalid @enderror" id="type_compt" name="type_compt" required>
                        <option value="client">Client</option>
                        <option value="fournisseur">Fournisseur</option>
                    </select>
                    @error('type_compt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="user_id" class="form-label">{{ __('Select User') }} <span class="text-danger">*</span></label>
                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                        <option value="">-- Select --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" data-type="client">{{ $client->name }}</option>
                        @endforeach
                        @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" data-type="fournisseur">{{ $fournisseur->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Create Compte') }}</button>
    </form>

    <script>
        // Dynamically filter users based on type_compt
        document.getElementById('type_compt').addEventListener('change', function () {
            const type = this.value;
            const options = document.querySelectorAll('#user_id option');

            options.forEach(option => {
                if (option.dataset.type === type || option.value === '') {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            // Reset selection
            document.getElementById('user_id').value = '';
        });
    </script>
</x-layouts.app>