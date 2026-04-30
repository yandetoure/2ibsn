@extends('admin.layout')

@section('title', 'Paramètres - 2IBSN')
@section('page-title', 'Paramètres')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1.5rem;">Paramètres de l'Institut</h2>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h3 class="section-title">Informations Générales</h3>

                <div class="form-group">
                    <label for="setting_institute_name">Nom de l'Institut</label>
                    <input type="text" id="setting_institute_name" name="setting_institute_name"
                        value="{{ App\Models\Setting::get('institute_name', 'Institut International Baye Barhamou') }}">
                </div>

                <div class="form-group">
                    <label for="setting_institute_address">Adresse</label>
                    <textarea id="setting_institute_address" name="setting_institute_address"
                        rows="2">{{ App\Models\Setting::get('institute_address', '') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="setting_institute_phone">Téléphone</label>
                        <input type="text" id="setting_institute_phone" name="setting_institute_phone"
                            value="{{ App\Models\Setting::get('institute_phone', '') }}">
                    </div>
                    <div class="form-group">
                        <label for="setting_institute_email">Email</label>
                        <input type="email" id="setting_institute_email" name="setting_institute_email"
                            value="{{ App\Models\Setting::get('institute_email', '') }}">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">Apparence & Couleurs</h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="setting_primary_color">Couleur Primaire</label>
                        <input type="color" id="setting_primary_color" name="setting_primary_color"
                            value="{{ App\Models\Setting::get('primary_color', '#1e40af') }}"
                            style="height: 40px; padding: 2px;">
                    </div>
                    <div class="form-group">
                        <label for="setting_secondary_color">Couleur Secondaire</label>
                        <input type="color" id="setting_secondary_color" name="setting_secondary_color"
                            value="{{ App\Models\Setting::get('secondary_color', '#10b981') }}"
                            style="height: 40px; padding: 2px;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="setting_banner_image">Image de la Section Hero</label>
                    @if($path = App\Models\Setting::get('banner_image'))
                        <div style="margin-bottom: 0.5rem;">
                            <img src="{{ asset('storage/' . $path) }}" alt="Banner"
                                style="max-height: 100px; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" id="setting_banner_image" name="setting_banner_image" accept="image/*">
                    <small>Format recommandé: 1920x800px. Laisse vide pour garder l'image actuelle.</small>
                </div>

                <div class="form-group">
                    <label for="setting_logo_image">Logo de l'Institut</label>
                    @if($logo = App\Models\Setting::get('logo_image'))
                        <div style="margin-bottom: 0.5rem;">
                            <img src="{{ asset('storage/' . $logo) }}" alt="Logo" style="max-height: 60px; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" id="setting_logo_image" name="setting_logo_image" accept="image/*">
                    <small>Laisse vide pour garder le logo actuel.</small>
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