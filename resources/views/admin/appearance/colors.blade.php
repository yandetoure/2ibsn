@extends('admin.layout')

@section('title', 'Couleurs & Thème - 2IBSN')
@section('page-title', 'Couleurs & Thème')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Identité Visuelle</h2>

        <form action="{{ route('admin.appearance.colors.update') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="primary_color">Couleur Primaire</label>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="color" id="primary_color" name="primary_color" value="{{ $primary_color }}" style="width: 60px; height: 60px; padding: 2px; border: none; cursor: pointer;">
                        <input type="text" value="{{ $primary_color }}" readonly style="background: #f9fafb; border: 1px solid #e5e7eb;">
                    </div>
                    <small>Utilisée pour le fond du menu, les boutons principaux, etc.</small>
                </div>

                <div class="form-group">
                    <label for="secondary_color">Couleur Secondaire</label>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="color" id="secondary_color" name="secondary_color" value="{{ $secondary_color }}" style="width: 60px; height: 60px; padding: 2px; border: none; cursor: pointer;">
                        <input type="text" value="{{ $secondary_color }}" readonly style="background: #f9fafb; border: 1px solid #e5e7eb;">
                    </div>
                    <small>Utilisée pour les accents, les badges, les titres dorés.</small>
                </div>
            </div>

            <div class="form-group" style="margin-top: 1rem;">
                <label for="accent_color">Couleur d'Accent / Fond Léger</label>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <input type="color" id="accent_color" name="accent_color" value="{{ $accent_color }}" style="width: 60px; height: 60px; padding: 2px; border: none; cursor: pointer;">
                    <input type="text" value="{{ $accent_color }}" readonly style="background: #f9fafb; border: 1px solid #e5e7eb;">
                </div>
                <small>Utilisée pour les fonds de section clairs.</small>
            </div>

            <div style="margin-top: 2rem; padding: 1.5rem; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                <h4 style="margin-bottom: 1rem; color: #64748b; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">Prévisualisation</h4>
                <div style="display: flex; gap: 1rem;">
                    <div style="padding: 1rem 2rem; background: {{ $primary_color }}; color: white; border-radius: 8px; font-weight: 600;">Bouton Primaire</div>
                    <div style="padding: 1rem 2rem; background: {{ $secondary_color }}; color: white; border-radius: 8px; font-weight: 600;">Accent Secondaire</div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Appliquer les Couleurs</button>
                <button type="button" onclick="resetDefaults()" class="btn btn-secondary">Réinitialiser aux Défauts</button>
            </div>
        </form>
    </div>

    <script>
        function resetDefaults() {
            if (confirm('Voulez-vous vraiment réinitialiser les couleurs aux valeurs par défaut ?')) {
                document.getElementById('primary_color').value = '#1a4d2e';
                document.getElementById('secondary_color').value = '#d4af37';
                document.getElementById('accent_color').value = '#f7f5f0';
                
                // Update text displays if they exist
                document.querySelectorAll('input[type="text"][readonly]').forEach(input => {
                    const colorInput = input.previousElementSibling;
                    if (colorInput && colorInput.type === 'color') {
                        input.value = colorInput.value;
                    }
                });
            }
        }

        // Keep text inputs in sync with color pickers
        document.querySelectorAll('input[type="color"]').forEach(picker => {
            picker.addEventListener('input', (e) => {
                const textInput = e.target.nextElementSibling;
                if (textInput && textInput.type === 'text') {
                    textInput.value = e.target.value;
                }
            });
        });
    </script>
@endsection
