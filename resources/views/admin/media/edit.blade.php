@extends('admin.layout')

@section('title', 'Modifier le Média - 2IBSN')
@section('page-title', 'Modifier le Média')

@section('content')
<div class="card form-container">
    <div class="form-header">
        <div class="header-icon">
            <i class="fas fa-edit"></i>
        </div>
        <div>
            <h2 class="form-title">Modifier le Média</h2>
            <p class="form-subtitle">Mettez à jour les informations de cet élément.</p>
        </div>
    </div>
    
    <div class="current-media-preview">
        @if($medium->mime_type === 'video/youtube')
            @php
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $medium->file_path, $match);
                $youtube_id = $match[1] ?? null;
            @endphp
            @if($youtube_id)
                <iframe width="320" height="180" src="https://www.youtube.com/embed/{{ $youtube_id }}" frameborder="0" allowfullscreen style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></iframe>
            @endif
        @elseif(str_starts_with($medium->mime_type, 'video/'))
            <video src="{{ asset('storage/' . $medium->file_path) }}" controls style="max-width: 320px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></video>
        @else
            <img src="{{ asset('storage/' . $medium->file_path) }}" alt="{{ $medium->title }}" style="max-width: 320px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        @endif
    </div>
    
    <form action="{{ route('admin.media.update', $medium) }}" method="POST" enctype="multipart/form-data" class="premium-form">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            {{-- Left Column --}}
            <div class="form-column">
                <div class="input-group">
                    <label for="type"><i class="fas fa-tag"></i> Type de média <span class="required-star">*</span></label>
                    <select id="type" name="type" required class="premium-input">
                        <option value="banner" {{ old('type', $medium->type) == 'banner' ? 'selected' : '' }}>Bannière</option>
                        <option value="gallery" {{ old('type', $medium->type) == 'gallery' ? 'selected' : '' }}>Galerie</option>
                        <option value="logo" {{ old('type', $medium->type) == 'logo' ? 'selected' : '' }}>Logo</option>
                        <option value="other" {{ old('type', $medium->type) == 'other' ? 'selected' : '' }}>Autre</option>
                        <option value="event" {{ old('type', $medium->type) == 'event' ? 'selected' : '' }}>Événement</option>
                    </select>
                    @error('type')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div id="youtube-field" class="input-group" style="display: {{ old('type', $medium->type) == 'event' ? 'block' : 'none' }};">
                    <label for="youtube_url"><i class="fab fa-youtube"></i> Lien Vidéo YouTube</label>
                    <div class="youtube-input-wrapper">
                        <input type="text" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $medium->mime_type == 'video/youtube' ? $medium->file_path : '') }}" placeholder="https://www.youtube.com/watch?v=..." class="premium-input">
                        <i class="fas fa-link link-icon"></i>
                    </div>
                    @error('youtube_url')<span class="error">{{ $message }}</span>@enderror
                </div>
                
                <div class="input-group">
                    <label for="title"><i class="fas fa-heading"></i> Titre</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $medium->title) }}" class="premium-input">
                    @error('title')<span class="error">{{ $message }}</span>@enderror
                </div>
                
                <div class="input-group">
                    <label for="description"><i class="fas fa-align-left"></i> Description</label>
                    <textarea id="description" name="description" rows="3" class="premium-input">{{ old('description', $medium->description) }}</textarea>
                    @error('description')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Right Column --}}
            <div class="form-column">
                <div class="input-group">
                    <label for="order"><i class="fas fa-sort-numeric-down"></i> Ordre d'affichage</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $medium->order) }}" min="0" class="premium-input">
                    @error('order')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div class="input-group">
                    <label for="file"><i class="fas fa-upload"></i> Remplacer le fichier</label>
                    <div class="file-upload-premium" style="height: 150px;">
                        <input type="file" id="file" name="file" accept="image/*,video/*" class="file-input">
                        <div class="upload-design">
                            <i class="fas fa-cloud-upload-alt" style="font-size: 1.5rem; color: var(--primary);"></i>
                            <p class="upload-text" style="font-size: 0.85rem;">Cliquer pour changer de fichier</p>
                        </div>
                    </div>
                    <p class="input-hint">Image ou Vidéo. Laisser vide pour conserver l'actuel.</p>
                    @error('file')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div class="input-group">
                    <label class="toggle-container">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $medium->is_active) ? 'checked' : '' }}>
                        <span class="toggle-label">Média actif sur le site</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-actions-premium">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Enregistrer les modifications
            </button>
            <a href="{{ $medium->type == 'event' ? route('admin.appearance.events') : route('admin.appearance.gallery') }}" class="btn-cancel">
                Annuler
            </a>
        </div>
    </form>
</div>

<style>
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 3rem !important;
        border-radius: 24px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05) !important;
    }

    .form-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .header-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 0;
    }

    .form-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-top: 0.25rem;
    }

    .current-media-preview {
        margin-bottom: 3rem;
        display: flex;
        justify-content: center;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .input-group {
        margin-bottom: 2rem;
    }

    .input-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-main);
        margin-bottom: 0.75rem;
    }

    .input-group label i {
        color: var(--primary);
        font-size: 1rem;
    }

    .premium-input {
        width: 100%;
        padding: 12px 16px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        color: var(--text-main);
        transition: all 0.3s;
    }

    .premium-input:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px var(--primary-light);
    }

    .youtube-input-wrapper {
        position: relative;
    }

    .link-icon {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .input-hint {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    .file-upload-premium {
        position: relative;
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        cursor: pointer;
    }

    .file-upload-premium:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .file-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 10;
    }

    .upload-design {
        text-align: center;
        pointer-events: none;
    }

    .upload-text {
        font-weight: 600;
        color: var(--text-main);
        margin-top: 0.5rem;
    }

    .form-actions-premium {
        margin-top: 4rem;
        display: flex;
        gap: 1.25rem;
        padding-top: 2rem;
        border-top: 1px solid #f1f5f9;
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 14px rgba(26, 77, 46, 0.2);
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 77, 46, 0.3);
    }

    .btn-cancel {
        padding: 14px 28px;
        background: #f1f5f9;
        color: var(--text-muted);
        border-radius: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: var(--text-main);
    }

    .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .toggle-container {
        display: flex;
        align-items: center;
        gap: 12px !important;
        cursor: pointer;
    }

    .toggle-label {
        font-weight: 600;
        color: var(--text-main);
    }

    .error {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 6px;
        display: block;
        font-weight: 500;
    }
</style>
<script>
document.getElementById('type').addEventListener('change', function() {
    const youtubeField = document.getElementById('youtube-field');
    if (this.value === 'event') {
        youtubeField.style.display = 'block';
    } else {
        youtubeField.style.display = 'none';
    }
});
</script>
@endsection
