@extends('admin.layout')

@section('title', 'Importer des Élèves - 2IBSN')
@section('page-title', 'Importer des Élèves')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Importer des Élèves</h2>
    
    <div style="background: #f0f9ff; border: 1px solid #0ea5e9; border-radius: 4px; padding: 1rem; margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 0.5rem; color: #0369a1;">Format du fichier Excel/CSV</h3>
        <p style="margin: 0; color: #0c4a6e;">Le fichier doit contenir les colonnes suivantes (en-têtes en première ligne):</p>
        <ul style="margin: 0.5rem 0 0 1.5rem; color: #0c4a6e;">
            <li>Prénom, Nom, Sexe (M/F), Date de naissance (dd/mm/yyyy), Lieu de naissance</li>
            <li>Nationalité, Langue, Niveau (nom ou code), Date d'entrée (dd/mm/yyyy)</li>
            <li>Nom Père, Tél Père, Nom Mère, Tél Mère, Adresse, Villa N°</li>
            <li>Responsable, Tél Responsable</li>
        </ul>
    </div>
    
    <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="file">Fichier Excel/CSV <span style="color: #ef4444;">*</span></label>
            <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required>
            <small style="color: #6b7280; display: block; margin-top: 0.25rem;">Formats acceptés: .xlsx, .xls, .csv (max 10MB)</small>
            @error('file')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Importer</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Annuler</a>
            <a href="{{ route('admin.students.export') }}" class="btn btn-success">Télécharger un exemple</a>
        </div>
    </form>
    
    @if(session('errors') && count(session('errors')) > 0)
        <div style="margin-top: 2rem; background: #fee2e2; border: 1px solid #ef4444; border-radius: 4px; padding: 1rem;">
            <h3 style="color: #991b1b; margin-bottom: 0.5rem;">Erreurs rencontrées:</h3>
            <ul style="margin: 0; padding-left: 1.5rem; color: #991b1b;">
                @foreach(session('errors') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
