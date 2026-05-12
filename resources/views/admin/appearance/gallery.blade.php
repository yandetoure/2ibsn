@extends('admin.layout')

@section('title', 'Galerie Photos - 2IBSN')
@section('page-title', 'Galerie Photos')

@section('content')
    <div class="card" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="color: var(--primary);">Gestion de la Galerie</h2>
        <a href="{{ route('admin.media.create', ['type' => 'gallery']) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter des Photos
        </a>
    </div>

    <div class="card">
        <div class="gallery-grid">
            @forelse($media as $item)
                <div class="gallery-item">
                    <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}">
                    <div class="gallery-overlay">
                        <div class="item-info">
                            <span class="item-title">{{ $item->title ?? 'Sans titre' }}</span>
                        </div>
                        <div class="item-actions">
                            <a href="{{ route('admin.media.edit', $item) }}" class="btn-icon" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Supprimer cette photo ?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-icon-danger" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #6b7280;">
                    <p>Aucune photo dans la galerie pour le moment.</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 2rem;">
            {{ $media->links() }}
        </div>
    </div>

    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 1/1;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background: #f3f4f6;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.25rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .item-info {
            margin-bottom: 0.75rem;
        }

        .item-title {
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .item-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: white;
            color: var(--text-dark);
            display: flex;
            items-center: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            align-items: center;
        }

        .btn-icon:hover {
            background: var(--primary);
            color: white;
        }

        .btn-icon-danger:hover {
            background: #ef4444;
            color: white;
        }
    </style>
@endsection
