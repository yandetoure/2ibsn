@extends('admin.layout')

@section('title', 'Gestion des Événements - 2IBSN')
@section('page-title', 'Gestion des Événements')

@section('content')
    <div class="card" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h2 style="color: var(--primary);">Section Événements</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Gérez les événements affichés avant la galerie sur la page d'accueil.</p>
        </div>
        <div style="display: flex; align-items: center; gap: 1.5rem;">
            <form action="{{ route('admin.appearance.events.toggle') }}" method="POST" id="toggle-form" style="display: flex; align-items: center; gap: 10px; background: #f8fafc; padding: 8px 16px; border-radius: 50px; border: 1px solid #e2e8f0;">
                @csrf
                <span style="font-weight: 600; font-size: 0.85rem; color: var(--text-main);">Visibilité :</span>
                <label class="switch">
                    <input type="checkbox" name="show_events_section" {{ $show_events ? 'checked' : '' }} onchange="document.getElementById('toggle-form').submit()">
                    <span class="slider round"></span>
                </label>
                <span style="font-weight: 700; color: {{ $show_events ? 'var(--primary)' : '#ef4444' }}; font-size: 0.85rem;">
                    {{ $show_events ? 'ACTIVÉE' : 'DÉSACTIVÉE' }}
                </span>
            </form>
            
            <a href="{{ route('admin.media.create', ['type' => 'event']) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un Événement
            </a>
        </div>
    </div>

    <div class="card">
        <div class="events-grid">
            @forelse($events as $item)
                <div class="event-card">
                    <div class="event-media">
                        @if($item->mime_type === 'video/youtube')
                            @php
                                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $item->file_path, $match);
                                $youtube_id = $match[1] ?? null;
                            @endphp
                            @if($youtube_id)
                                <img src="https://img.youtube.com/vi/{{ $youtube_id }}/mqdefault.jpg" alt="{{ $item->title }}">
                                <div class="play-overlay"><i class="fab fa-youtube"></i></div>
                            @else
                                <div class="placeholder-media"><i class="fas fa-video"></i></div>
                            @endif
                        @elseif(str_starts_with($item->mime_type, 'video/'))
                            <video src="{{ asset('storage/' . $item->file_path) }}" muted></video>
                            <div class="play-overlay"><i class="fas fa-play"></i></div>
                        @else
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}">
                        @endif
                        
                        <div class="event-type-badge">
                            @if($item->mime_type === 'video/youtube')
                                <i class="fab fa-youtube"></i> YouTube
                            @elseif(str_starts_with($item->mime_type, 'video/'))
                                <i class="fas fa-video"></i> Vidéo
                            @else
                                <i class="fas fa-image"></i> Image
                            @endif
                        </div>
                    </div>
                    
                    <div class="event-content">
                        <h3 class="event-title">{{ $item->title ?? 'Sans titre' }}</h3>
                        <p class="event-description">{{ Str::limit($item->description, 80) ?? 'Aucune description' }}</p>
                        
                        <div class="event-footer">
                            <span class="event-order">Ordre : {{ $item->order }}</span>
                            <div class="event-actions">
                                <a href="{{ route('admin.media.edit', $item) }}" class="btn-icon" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-icon-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 4rem 2rem; color: #6b7280; background: #f8fafc; border-radius: 20px; border: 2px dashed #e2e8f0;">
                    <i class="fas fa-calendar-alt" style="font-size: 3rem; margin-bottom: 1.5rem; color: #cbd5e1;"></i>
                    <p style="font-size: 1.1rem; font-weight: 500;">Aucun événement enregistré.</p>
                    <p style="font-size: 0.9rem; margin-top: 0.5rem;">Commencez par ajouter votre premier événement pour l'afficher sur le site.</p>
                    <a href="{{ route('admin.media.create', ['type' => 'event']) }}" class="btn btn-primary" style="margin-top: 1.5rem;">
                        Ajouter un événement
                    </a>
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div style="margin-top: 2rem;">
                {{ $events->links() }}
            </div>
        @endif
    </div>

    <style>
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: var(--primary-light);
        }

        .event-media {
            position: relative;
            aspect-ratio: 16/9;
            background: #f1f5f9;
            overflow: hidden;
        }

        .event-media img, .event-media video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .event-card:hover .event-media img {
            transform: scale(1.05);
        }

        .play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.2);
            color: white;
            font-size: 2.5rem;
            opacity: 0.8;
        }

        .event-type-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-main);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .event-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .event-description {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }

        .event-order {
            font-size: 0.75rem;
            font-weight: 600;
            color: #94a3b8;
        }

        .event-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: #f8fafc;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
            cursor: pointer;
        }

        .btn-icon:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .btn-icon-danger:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        /* Switch toggle styles */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: var(--primary);
        }

        input:checked + .slider:before {
            transform: translateX(20px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .placeholder-media {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            color: #94a3b8;
            font-size: 3rem;
        }
    </style>
@endsection
