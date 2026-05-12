@extends('admin.layout')

@section('title', 'Nouveau Niveau - 2IBSN')
@section('page-title', 'Nouveau Niveau')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Créer un Nouveau Niveau</h2>
    
    <form action="{{ route('admin.levels.store') }}" method="POST">
        @csrf
        
        <div class="form-section">
            <h3 style="font-size: 1.1rem; color: #374151; margin-bottom: 1rem;">Informations Générales</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nom du Niveau <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ex: 6ème">
                    @error('name')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="code">Code <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" required placeholder="Ex: 6EME">
                    @error('code')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="category">Catégorie <span style="color: #ef4444;">*</span></label>
                    <select id="category" name="category" required>
                        <option value="preschool" {{ old('category') == 'preschool' ? 'selected' : '' }}>Préscolaire</option>
                        <option value="elementary" {{ old('category') == 'elementary' ? 'selected' : '' }}>Élémentaire</option>
                        <option value="college" {{ old('category') == 'college' ? 'selected' : '' }}>Collège</option>
                    </select>
                    @error('category')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.75rem;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span style="font-weight: 600;">Niveau Actif</span>
                    </label>
                </div>
            </div>
        </div>

        <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #e5e7eb;">

        <div class="form-section">
            <h3 style="font-size: 1.1rem; color: #374151; margin-bottom: 1rem;">Grille Tarifaire (Externat)</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="registration_fee">Frais d'Inscription (FCFA) <span style="color: #ef4444;">*</span></label>
                    <input type="number" id="registration_fee" name="registration_fee" value="{{ old('registration_fee', 0) }}" min="0" step="1" required>
                    @error('registration_fee')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="monthly_fee">Mensualité (FCFA) <span style="color: #ef4444;">*</span></label>
                    <input type="number" id="monthly_fee" name="monthly_fee" value="{{ old('monthly_fee', 0) }}" min="0" step="1" required>
                    @error('monthly_fee')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="form-section" style="margin-top: 2rem;">
            <h3 style="font-size: 1.1rem; color: #374151; margin-bottom: 1rem;">Grille Tarifaire (Demi-Pension)</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="half_pension_registration_fee">Inscription Demi-Pension (FCFA)</label>
                    <input type="number" id="half_pension_registration_fee" name="half_pension_registration_fee" value="{{ old('half_pension_registration_fee', 0) }}" min="0" step="1" required>
                    @error('half_pension_registration_fee')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="half_pension_monthly_fee">Mensualité Demi-Pension (FCFA)</label>
                    <input type="number" id="half_pension_monthly_fee" name="half_pension_monthly_fee" value="{{ old('half_pension_monthly_fee', 0) }}" min="0" step="1" required>
                    @error('half_pension_monthly_fee')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            <small style="color: #6b7280;">Mettre à 0 si la demi-pension n'est pas disponible pour ce niveau.</small>
        </div>

        <div class="form-group" style="margin-top: 2rem;">
            <label for="description">Notes / Description interne</label>
            <textarea id="description" name="description" rows="3" placeholder="Description du niveau">{{ old('description') }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 3rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">Créer le Niveau</button>
            <a href="{{ route('admin.levels.index') }}" class="btn btn-secondary" style="padding: 0.75rem 2rem;">Annuler</a>
        </div>
    </form>
</div>

<style>
.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}
</style>
@endsection
