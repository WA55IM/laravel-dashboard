@section('title', __('Create User'))
<x-layouts.app :title="__('Create User')">
    
        <h1 class="mb-4">{{ __('Create User') }}</h1>
        
        <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="card h-100">
                        
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    {{ __('Name') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    {{ __('Password') }} <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    {{ __('email') }} <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Code -->
                            <div class="mb-3">
                                <label for="code" class="form-label">
                                    {{ __('Code') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                    id="code" name="code" value="{{ old('code') }}" required>
                                @error('code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Raison Sociale -->
                            <div class="mb-3">
                                <label for="raison_sociale" class="form-label">
                                    {{ __('Raison Sociale') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('raison_sociale') is-invalid @enderror" 
                                    id="raison_sociale" name="raison_sociale" value="{{ old('raison_sociale') }}" required>
                                @error('raison_sociale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Type Client -->
                            <div class="mb-3">
                                <label for="type_client" class="form-label">
                                    {{ __('Type Client') }} <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('type_client') is-invalid @enderror" 
                                id="typeClient" name="type_client">
                                    <option value="étatique">{{ __('Étatique') }}</option>
                                    <option value="privée">{{ __('Privée') }}</option>
                                    <option value="étranger">{{ __('Étranger') }}</option>
                                </select>
                                @error('type_client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Num Siret (Conditional) -->
                            <div class="mb-3" id="siretContainer" style="display: none;">
                                <label for="num_siret" class="form-label">{{ __('Num SIRET') }}</label>
                                <input type="text" class="form-control @error('num_siret') is-invalid @enderror" 
                                    id="num_siret" name="num_siret" value="{{ old('num_siret') }}">
                                @error('num_siret')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Adresse -->
                            <div class="mb-3">
                                <label for="adresse" class="form-label">
                                    {{ __('Adresse') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                                    id="adresse" name="adresse" value="{{ old('adresse') }}" required>
                                @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Matricule Fiscale -->
                            <div class="mb-3">
                                <label for="matricule_fiscale" class="form-label">
                                    {{ __('Matricule Fiscale') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('matricule_fiscale') is-invalid @enderror" 
                                    id="matricule_fiscale" name="matricule_fiscale" value="{{ old('matricule_fiscale') }}" required>
                                @error('matricule_fiscale')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="card h-100">
                        
                        <div class="card-body">
                            <!-- Code Postal -->
                            <div class="mb-3">
                                <label for="code_postal" class="form-label">
                                    {{ __('Code Postal') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('code_postal') is-invalid @enderror" 
                                    id="code_postal" name="code_postal" value="{{ old('code_postal') }}" required>
                                @error('code_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Activité -->
                            <div class="mb-3">
                                <label for="activite" class="form-label">
                                    {{ __('Activité') }} <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('activite') is-invalid @enderror" 
                                    id="activite" name="activite" value="{{ old('activite') }}" required>
                                @error('activite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="telephone" class="form-label">
                                    {{ __('Phone Number') }} <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                    id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    {{ __('Email') }} <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Blockage -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('Blockage') }}</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="blockage" 
                                            id="blockage1" value="1" {{ old('blockage') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="blockage1">{{ __('Yes') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="blockage" 
                                            id="blockage0" value="0" {{ old('blockage', '0') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="blockage0">{{ __('No') }}</label>
                                    </div>
                                </div>
                                @error('blockage')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <!-- Exomée -->
                           

                            <!-- Exomée Fields -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                        id="exomeeCheckbox" name="exomee" value="1">
                                    <label class="form-check-label" for="exomeeCheckbox">{{ __('Exomée') }}</label>
                                </div>
                            </div>
                
                            <!-- Exomée Fields (Initially hidden) -->
                            <div id="exomeeFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="num_decision" class="form-label">{{ __('Num Décision') }}</label>
                                    <input type="text" class="form-control @error('num_decision') is-invalid @enderror" 
                                        id="num_decision" name="num_decision" value="{{ old('num_decision') }}">
                                    @error('num_decision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                
                                <div class="mb-3">
                                    <label for="date_debut" class="form-label">{{ __('Date Début') }}</label>
                                    <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                                        id="date_debut" name="date_debut" value="{{ old('date_debut') }}">
                                    @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">{{ __('Date Fin') }}</label>
                                    <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                                        id="date_fin" name="date_fin" value="{{ old('date_fin') }}">
                                    @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Footer -->
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">{{ __('Create User') }}</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary px-4">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-layouts.app>
<script>
    // Toggle Exomée fields visibility
    document.getElementById('exomeeCheckbox').addEventListener('change', function() {
        const exomeeFields = document.getElementById('exomeeFields');
        exomeeFields.style.display = this.checked ? 'block' : 'none';
    });

    // Initialize fields based on initial checkbox state
    window.addEventListener('DOMContentLoaded', () => {
        const checkbox = document.getElementById('exomeeCheckbox');
        const exomeeFields = document.getElementById('exomeeFields');
        exomeeFields.style.display = checkbox.checked ? 'block' : 'none';
    });
</script>
<script>
    // Client type change handler
    document.getElementById('typeClient').addEventListener('change', function() {
        const siretContainer = document.getElementById('siretContainer');
        siretContainer.style.display = this.value === 'étranger' ? 'block' : 'none';
    });

    // Initial check on page load
    window.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.getElementById('typeClient');
        const siretContainer = document.getElementById('siretContainer');
        siretContainer.style.display = typeSelect.value === 'étranger' ? 'block' : 'none';
    });
</script>

<style>
    /* Optional transition effects */
    #siretContainer {
        transition: all 0.3s ease;
        overflow: hidden;
        opacity: 0;
        max-height: 0;
    }
    
    #siretContainer[style*="display: block"] {
        opacity: 1;
        max-height: 200px;
    }
</style>
