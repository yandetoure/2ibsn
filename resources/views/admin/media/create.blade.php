@extends('admin.layout')

@section('title', 'Ajouter des Médias - 2IBSN')
@section('page-title', 'Ajouter des Médias')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Ajouter des Médias ({{ ucfirst($type) }})</h2>
    
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Hidden type field --}}
        <input type="hidden" name="type" value="{{ $type }}">
        
        <div class="form-row">
            <div class="form-group">
                <label for="order">Ordre d'affichage par défaut</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                @error('order')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="title">Titre global (optionnel)</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Ex: Sortie scolaire 2024">
            @error('title')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description globale (optionnelle)</label>
            <textarea id="description" name="description" rows="2">{{ old('description') }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="files">Sélectionnez une ou plusieurs images <span style="color: #ef4444;">*</span></label>
            <div class="file-upload-wrapper">
                <input type="file" id="files" name="files[]" accept="image/*" required multiple class="file-input">
                <div class="file-upload-design">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Cliquez ou glissez-déposez vos images ici</p>
                    <span class="browse-btn">Parcourir</span>
                </div>
            </div>
            <div id="file-list" class="file-list"></div>
            <small style="color: #6b7280; display: block; margin-top: 0.5rem;">Formats acceptés: JPG, PNG, GIF. Vous pouvez sélectionner plusieurs fichiers à la fois.</small>
            @error('files')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Lancer l'importation</button>
            <a href="{{ $type == 'gallery' ? route('admin.appearance.gallery') : ($type == 'banner' ? route('admin.appearance.hero') : route('admin.dashboard')) }}" class="btn btn-secondary">Annuler</a>
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

.file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 150px;
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    background: #f9fafb;
    cursor: pointer;
}

.file-upload-wrapper:hover {
    border-color: var(--primary);
    background: #f0fdf4;
}

.file-input {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.file-upload-design {
    text-align: center;
    color: #6b7280;
}

.file-upload-design i {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    color: var(--primary);
}

.browse-btn {
    display: inline-block;
    margin-top: 0.75rem;
    padding: 0.4rem 1rem;
    background: var(--primary);
    color: white;
    border-radius: 6px;
    font-size: 0.875rem;
}

.file-list {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 1rem;
}

.file-preview {
    font-size: 0.75rem;
    color: #4b5563;
    background: #f3f4f6;
    padding: 0.5rem;
    border-radius: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

<script>
document.getElementById('files').addEventListener('change', function(e) {
    const fileList = document.getElementById('file-list');
    fileList.innerHTML = '';
    
    for (let i = 0; i < this.files.length; i++) {
        const div = document.createElement('div');
        div.className = 'file-preview';
        div.textContent = this.files[i].name;
        fileList.appendChild(div);
    }
    
    if (this.files.length > 0) {
        document.querySelector('.file-upload-design p').textContent = this.files.length + ' fichier(s) sélectionné(s)';
    } else {
        document.querySelector('.file-upload-design p').textContent = 'Cliquez ou glissez-déposez vos images ici';
    }
});
</script>
@endsection
