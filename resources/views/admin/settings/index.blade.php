@extends('admin.layout')

@section('title', 'Paramètres Généraux - 2IBSN')
@section('page-title', 'Paramètres Généraux')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Informations sur l'Institut</h2>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <div class="form-group">
                    <label for="institute_name">Nom de l'Institut</label>
                    <input type="text" id="institute_name" name="institute_name"
                        value="{{ App\Models\Setting::get('institute_name', 'Institut International Baye Barhamou') }}">
                </div>

                <div class="form-group">
                    <label for="institute_address">Adresse</label>
                    <textarea id="institute_address" name="institute_address"
                        rows="2">{{ App\Models\Setting::get('institute_address', 'Dakar, Sénégal, Quartier Liberté 6') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="institute_phone">Téléphone</label>
                        <input type="text" id="institute_phone" name="institute_phone"
                            value="{{ App\Models\Setting::get('institute_phone', '+221 77 375 07 24') }}">
                    </div>
                    <div class="form-group">
                        <label for="institute_email">Email</label>
                        <input type="email" id="institute_email" name="institute_email"
                            value="{{ App\Models\Setting::get('institute_email', 'contact@2ibsn.edu.sn') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="logo_image">Logo de l'Institut</label>
                    @if($logo = App\Models\Setting::get('logo_image'))
                        <div style="margin-bottom: 0.5rem; background: #f9fafb; padding: 10px; border-radius: 8px; display: inline-block;">
                            <img src="{{ asset('storage/' . $logo) }}" alt="Logo" style="max-height: 60px; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" id="logo_image" name="logo_image" accept="image/*">
                    <small>Laisse vide pour garder le logo actuel.</small>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Enregistrer les Informations</button>
            </div>
        </form>
    </div>

    <style>
        .form-section {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-group input, 
        .form-group textarea {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            transition: all 0.2s;
        }

        .form-group input:focus, 
        .form-group textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 77, 46, 0.1);
            outline: none;
        }
    </style>
@endsection