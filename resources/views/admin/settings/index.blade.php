@extends('admin.layout')

@section('title', 'Paramètres - 2IBSN')
@section('page-title', 'Paramètres')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Paramètres de l'Institut</h2>
    
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        
        <div class="form-section">
            <h3 class="section-title">Informations Générales</h3>
            
            <div class="form-group">
                <label for="setting_institute_name">Nom de l'Institut</label>
                <input type="text" id="setting_institute_name" name="setting_institute_name" value="{{ App\Models\Setting::get('institute_name', 'Institut International Baye Barhamou') }}">
            </div>
            
            <div class="form-group">
                <label for="setting_institute_address">Adresse</label>
                <textarea id="setting_institute_address" name="setting_institute_address" rows="2">{{ App\Models\Setting::get('institute_address', '') }}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="setting_institute_phone">Téléphone</label>
                    <input type="text" id="setting_institute_phone" name="setting_institute_phone" value="{{ App\Models\Setting::get('institute_phone', '') }}">
                </div>
                <div class="form-group">
                    <label for="setting_institute_email">Email</label>
                    <input type="email" id="setting_institute_email" name="setting_institute_email" value="{{ App\Models\Setting::get('institute_email', '') }}">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3 class="section-title">Apparence</h3>
            
            <div class="form-group">
                <label for="setting_banner_image">Image de Bannière (URL)</label>
                <input type="text" id="setting_banner_image" name="setting_banner_image" value="{{ App\Models\Setting::get('banner_image', '') }}" placeholder="URL de l'image ou chemin">
            </div>
            
            <div class="form-group">
                <label for="setting_logo_image">Logo (URL)</label>
                <input type="text" id="setting_logo_image" name="setting_logo_image" value="{{ App\Models\Setting::get('logo_image', '') }}" placeholder="URL de l'image ou chemin">
            </div>
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer les Paramètres</button>
        </div>
    </form>
</div>

<style>
.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 1.25rem;
}
</style>
@endsection
