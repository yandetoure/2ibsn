@extends('admin.layout')

@section('title', 'Ajouter des Médias - 2IBSN')
@section('page-title', 'Ajouter des Médias')

@section('content')
<div class="card form-container">
    <div class="form-header">
        <div class="header-icon">
            <i class="fas fa-calendar-plus"></i>
        </div>
        <div>
            <h2 class="form-title">Ajouter un Événement</h2>
            <p class="form-subtitle">Complétez les informations pour publier un nouvel événement sur le site.</p>
        </div>
    </div>
    
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="premium-form">
        @csrf
        
        <input type="hidden" name="type" value="{{ $type }}">
        
        <div class="form-grid">
            {{-- Left Column: Info --}}
            <div class="form-column">
                <div class="input-group">
                    <label for="title"><i class="fas fa-heading"></i> Titre de l'événement</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Ex: Cérémonie de remise des diplômes 2024" class="premium-input">
                    @error('title')<span class="error">{{ $message }}</span>@enderror
                </div>
                
                <div class="input-group">
                    <label for="description"><i class="fas fa-align-left"></i> Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Décrivez brièvement l'événement..." class="premium-input">{{ old('description') }}</textarea>
                    @error('description')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="order"><i class="fas fa-sort-numeric-down"></i> Ordre d'affichage</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0" class="premium-input">
                        @error('order')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Right Column: Media --}}
            <div class="form-column">
                @if($type === 'event')
                    <div class="input-group">
                        <label for="youtube_url"><i class="fab fa-youtube"></i> Lien Vidéo YouTube</label>
                        <div class="youtube-input-wrapper">
                            <input type="text" id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="premium-input">
                            <i class="fas fa-link link-icon"></i>
                        </div>
                        <p class="input-hint">Optionnel. Si renseigné, le lecteur YouTube sera affiché en priorité.</p>
                        @error('youtube_url')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    
                    <div class="input-group">
                        <label for="files"><i class="fas fa-photo-video"></i> Média Local (Image ou Vidéo) <span class="required-star" id="file-required-star">*</span></label>
                        <div class="file-upload-premium">
                            <input type="file" id="files" name="files[]" accept="image/*,video/*" class="file-input">
                            <div class="upload-design">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="upload-text">Glissez-déposez ou cliquez ici</p>
                                <span class="upload-hint">JPG, PNG, MP4, WEBM (Max 10Mo)</span>
                            </div>
                        </div>
                        <div id="file-list" class="file-list-premium"></div>
                        @error('files')<span class="error">{{ $message }}</span>@enderror
                    </div>
                @else
                    <div class="input-group">
                        <label for="files"><i class="fas fa-images"></i> Sélectionner des images <span class="required-star">*</span></label>
                        <div class="file-upload-premium">
                            <input type="file" id="files" name="files[]" accept="image/*" required multiple class="file-input">
                            <div class="upload-design">
                                <div class="upload-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <p class="upload-text">Sélectionner une ou plusieurs images</p>
                                <span class="upload-hint">JPG, PNG, GIF</span>
                            </div>
                        </div>
                        <div id="file-list" class="file-list-premium"></div>
                        @error('files')<span class="error">{{ $message }}</span>@enderror
                    </div>
                @endif
            </div>
        </div>
        
        <div class="form-actions-premium">
            <button type="submit" class="btn-submit">
                <i class="fas fa-check"></i> Publier l'événement
            </button>
            <a href="{{ $type == 'gallery' ? route('admin.appearance.gallery') : ($type == 'event' ? route('admin.appearance.events') : route('admin.dashboard')) }}" class="btn-cancel">
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
        margin-bottom: 3rem;
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
        height: 200px;
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

    .upload-icon {
        width: 64px;
        height: 64px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        color: var(--primary);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .upload-text {
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }

    .upload-hint {
        font-size: 0.75rem;
        color: #64748b;
    }

    .file-list-premium {
        margin-top: 1.5rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .file-chip {
        padding: 6px 12px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.8rem;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .file-chip i {
        color: var(--primary);
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

    .error {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 6px;
        display: block;
        font-weight: 500;
    }
</style>

<script>
const fileInput = document.getElementById('files');
const youtubeInput = document.getElementById('youtube_url');
const star = document.getElementById('file-required-star');

if (youtubeInput) {
    const updateRequired = () => {
        if (youtubeInput.value.trim() !== '') {
            fileInput.required = false;
            if (star) star.style.display = 'none';
        } else {
            fileInput.required = true;
            if (star) star.style.display = 'inline';
        }
    };
    youtubeInput.addEventListener('input', updateRequired);
    updateRequired();
}

fileInput.addEventListener('change', function(e) {
    const fileList = document.getElementById('file-list');
    fileList.innerHTML = '';
    
    for (let i = 0; i < this.files.length; i++) {
        const chip = document.createElement('div');
        chip.className = 'file-chip';
        
        const icon = document.createElement('i');
        icon.className = this.files[i].type.startsWith('image/') ? 'fas fa-image' : 'fas fa-video';
        
        const name = document.createTextNode(this.files[i].name);
        
        chip.appendChild(icon);
        chip.appendChild(name);
        fileList.appendChild(chip);
    }
    
    const uploadText = document.querySelector('.upload-text');
    if (this.files.length > 0) {
        uploadText.textContent = this.files.length + ' média(s) sélectionné(s)';
    } else {
        uploadText.textContent = 'Glissez-déposez ou cliquez ici';
    }
});
</script>
@endsection
