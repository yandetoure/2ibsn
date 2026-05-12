@extends('admin.layout')

@section('title', 'Section Hero & Branding - 2IBSN')
@section('page-title', 'Section Hero & Branding')

@section('content')
    <div class="card">
        <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Identité & Contenu Hero</h2>

        <form action="{{ route('admin.appearance.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h3 class="sub-title">Logo de l'Institut</h3>
                <div class="form-group">
                    @if($logo_image)
                        <div style="margin-bottom: 1rem; background: #f9fafb; padding: 15px; border-radius: 12px; display: inline-block; border: 1px solid #e5e7eb;">
                            <img src="{{ asset('storage/' . $logo_image) }}" alt="Logo actuel" style="max-height: 80px;">
                        </div>
                    @endif
                    <div class="file-upload-wrapper" style="height: 100px;">
                        <input type="file" id="logo_image" name="logo_image" accept="image/*" class="file-input">
                        <div class="file-upload-design">
                            <i class="fas fa-image" style="font-size: 1.5rem;"></i>
                            <p>Modifier le logo de l'institut</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #e5e7eb;">

            <div class="form-section">
                <h3 class="sub-title">Textes de la Section Hero</h3>
                <div class="form-group">
                    <label for="hero_label">Petit Badge (au-dessus du titre)</label>
                    <input type="text" id="hero_label" name="hero_label" value="{{ $hero_label }}">
                    <small>Ex: Fondé en 2016 · Dakar, Sénégal</small>
                </div>

                <div class="form-group">
                    <label for="hero_title">Titre Principal</label>
                    <input type="text" id="hero_title" name="hero_title" value="{{ $hero_title }}">
                    <small>Astuce: Utilisez le symbole <strong>&</strong> pour séparer les lignes stylisées.</small>
                </div>

                <div class="form-group">
                    <label for="hero_subtitle">Sous-titre / Description</label>
                    <textarea id="hero_subtitle" name="hero_subtitle" rows="3">{{ $hero_subtitle }}</textarea>
                </div>
            </div>

            <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #e5e7eb;">

            <div class="form-section">
                <h3 class="sub-title">Ajouter des Bannières au Carrousel</h3>
                <div class="form-group">
                    <div class="file-upload-wrapper">
                        <input type="file" id="banners" name="banners[]" accept="image/*" multiple class="file-input">
                        <div class="file-upload-design">
                            <i class="fas fa-images"></i>
                            <p>Sélectionnez une ou plusieurs images pour le carrousel</p>
                            <span class="browse-btn">Parcourir</span>
                        </div>
                    </div>
                    <div id="file-list" class="file-list"></div>
                    <small style="color: #6b7280; display: block; margin-top: 0.5rem;">Format recommandé: 1920x1080px.</small>
                </div>
            </div>

            <div style="margin-top: 3rem;">
                <button type="submit" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1rem;">
                    <i class="fas fa-save"></i> Enregistrer tout le contenu Hero
                </button>
            </div>
        </form>
    </div>

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 style="color: var(--primary);">Images du Carousel Actuel</h3>
            <span style="font-size: 0.875rem; color: #6b7280;">{{ $banners->count() }} bannières actives</span>
        </div>
        <div class="banners-grid">
            @forelse($banners as $banner)
                <div class="banner-item">
                    <img src="{{ asset('storage/' . $banner->file_path) }}" alt="Banner">
                    <div class="banner-actions">
                        <form action="{{ route('admin.media.destroy', $banner) }}" method="POST" onsubmit="return confirm('Supprimer cette image du carrousel ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6b7280; background: #f9fafb; border-radius: 12px; border: 2px dashed #e5e7eb;">
                    <p>Aucune bannière personnalisée. Le site affiche les images par défaut.</p>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .sub-title {
            font-size: 1.1rem;
            color: #374151;
            margin-bottom: 1.25rem;
            font-weight: 700;
        }

        .banners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .banner-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
        }

        .banner-item img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
        }

        .banner-actions {
            padding: 1rem;
            display: flex;
            justify-content: center;
            background: white;
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
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .file-preview {
            font-size: 0.75rem;
            color: #4b5563;
            background: #f3f4f6;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
    </style>

    <script>
        document.getElementById('banners').addEventListener('change', function(e) {
            const fileList = document.getElementById('file-list');
            fileList.innerHTML = '';
            
            for (let i = 0; i < this.files.length; i++) {
                const div = document.createElement('div');
                div.className = 'file-preview';
                div.textContent = this.files[i].name;
                fileList.appendChild(div);
            }
            
            if (this.files.length > 0) {
                this.nextElementSibling.querySelector('p').textContent = this.files.length + ' image(s) sélectionnée(s)';
            }
        });

        document.getElementById('logo_image').addEventListener('change', function(e) {
            if (this.files.length > 0) {
                this.nextElementSibling.querySelector('p').textContent = 'Nouveau logo sélectionné : ' + this.files[0].name;
                this.nextElementSibling.querySelector('p').style.color = 'var(--primary)';
                this.nextElementSibling.querySelector('p').style.fontWeight = 'bold';
            }
        });
    </script>
@endsection
