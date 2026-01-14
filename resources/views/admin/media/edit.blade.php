@extends('admin.layout')

@section('title', 'Modifier le Média - 2IBSN')
@section('page-title', 'Modifier le Média')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Modifier le Média</h2>
    
    <div style="margin-bottom: 1.5rem; text-align: center;">
        <img src="{{ asset('storage/' . $media->file_path) }}" alt="{{ $media->title }}" style="max-width: 300px; max-height: 300px; border-radius: 8px;">
    </div>
    
    <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="type">Type <span style="color: #ef4444;">*</span></label>
                <select id="type" name="type" required>
                    <option value="banner" {{ old('type', $media->type) == 'banner' ? 'selected' : '' }}>Bannière</option>
                    <option value="gallery" {{ old('type', $media->type) == 'gallery' ? 'selected' : '' }}>Galerie</option>
                    <option value="logo" {{ old('type', $media->type) == 'logo' ? 'selected' : '' }}>Logo</option>
                    <option value="other" {{ old('type', $media->type) == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" value="{{ old('order', $media->order) }}" min="0">
                @error('order')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="{{ old('title', $media->title) }}">
            @error('title')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ old('description', $media->description) }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="file">Nouveau Fichier Image (optionnel)</label>
            <input type="file" id="file" name="file" accept="image/*">
            <small style="color: #6b7280; display: block; margin-top: 0.25rem;">Laisser vide pour conserver l'image actuelle</small>
            @error('file')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $media->is_active) ? 'checked' : '' }}>
                <span>Actif</span>
            </label>
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Annuler</a>
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
