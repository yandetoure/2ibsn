@extends('admin.layout')

@section('title', 'Ajouter un Média - 2IBSN')
@section('page-title', 'Ajouter un Média')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Ajouter un Média</h2>
    
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="type">Type <span style="color: #ef4444;">*</span></label>
                <select id="type" name="type" required>
                    <option value="banner" {{ old('type') == 'banner' ? 'selected' : '' }}>Bannière</option>
                    <option value="gallery" {{ old('type') == 'gallery' ? 'selected' : '' }}>Galerie</option>
                    <option value="logo" {{ old('type') == 'logo' ? 'selected' : '' }}>Logo</option>
                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="order">Ordre d'affichage</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                @error('order')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label for="file">Fichier Image <span style="color: #ef4444;">*</span></label>
            <input type="file" id="file" name="file" accept="image/*" required>
            <small style="color: #6b7280; display: block; margin-top: 0.25rem;">Formats acceptés: JPG, PNG, GIF (max 10MB)</small>
            @error('file')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Ajouter</button>
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
