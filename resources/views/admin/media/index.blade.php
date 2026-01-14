@extends('admin.layout')

@section('title', 'Gestion des Médias - 2IBSN')
@section('page-title', 'Gestion des Médias')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Médias</h2>
        <a href="{{ route('admin.media.create') }}" class="btn btn-primary">Ajouter un Média</a>
    </div>
    
    <form method="GET" action="{{ route('admin.media.index') }}" style="margin-bottom: 1.5rem;">
        <div class="form-row">
            <div class="form-group">
                <select name="type" style="margin-bottom: 0;">
                    <option value="">Tous les types</option>
                    <option value="banner" {{ request('type') == 'banner' ? 'selected' : '' }}>Bannière</option>
                    <option value="gallery" {{ request('type') == 'gallery' ? 'selected' : '' }}>Galerie</option>
                    <option value="logo" {{ request('type') == 'logo' ? 'selected' : '' }}>Logo</option>
                    <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-bottom: 0;">Filtrer</button>
                <a href="{{ route('admin.media.index') }}" class="btn btn-secondary" style="margin-bottom: 0;">Réinitialiser</a>
            </div>
        </div>
    </form>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
        @forelse($media as $item)
            <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; background: white;">
                <div style="width: 100%; height: 200px; overflow: hidden; background: #f3f4f6;">
                    <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="padding: 1rem;">
                    <h3 style="margin-bottom: 0.5rem; font-size: 1rem;">{{ $item->title ?? 'Sans titre' }}</h3>
                    <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">
                        Type: <strong>{{ ucfirst($item->type) }}</strong>
                    </p>
                    <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">
                        Statut: 
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.75rem; 
                            background: {{ $item->is_active ? '#d1fae5' : '#fee2e2' }};
                            color: {{ $item->is_active ? '#065f46' : '#991b1b' }};">
                            {{ $item->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </p>
                    <div style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                        <a href="{{ route('admin.media.edit', $item) }}" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem; flex: 1;">Modifier</a>
                        <form action="{{ route('admin.media.destroy', $item) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce média?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.75rem; font-size: 0.875rem; width: 100%;">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #6b7280;">
                <p>Aucun média trouvé</p>
            </div>
        @endforelse
    </div>
    
    <div class="pagination" style="margin-top: 2rem;">
        {{ $media->links() }}
    </div>
</div>
@endsection
