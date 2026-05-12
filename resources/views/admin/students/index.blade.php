@extends('admin.layout')

@section('title', 'Gestion des Élèves - 2IBSN')
@section('page-title', 'Répertoire des Élèves')

@section('content')
<div class="card" style="padding: 0; overflow: hidden; border: none; box-shadow: var(--shadow-md);">
    <!-- Header Section -->
    <div style="padding: 2rem; background: white; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <h2 style="color: var(--primary); font-size: 1.5rem; font-weight: 700;">Liste des Élèves</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Consultez et gérez les dossiers académiques.</p>
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('registration') }}" class="btn btn-primary" style="background: var(--primary);">
                <i class="fas fa-plus-circle"></i> Nouvelle Inscription
            </a>
            <a href="{{ route('admin.students.export', request()->all()) }}" class="btn btn-secondary" style="background: #f1f5f9; color: var(--text-main); border: 1px solid #e2e8f0;">
                <i class="fas fa-download"></i> Exporter
            </a>
        </div>
    </div>

    <!-- Filter Bar -->
    <div style="padding: 1.25rem 2rem; background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
        <form method="GET" action="{{ route('admin.students.index') }}" style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 1rem; align-items: end;">
            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Recherche</label>
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, prénom, téléphone..." 
                           style="width: 100%; padding: 0.65rem 0.75rem 0.65rem 2.5rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; transition: all 0.2s;">
                </div>
            </div>

            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Statut</label>
                <select name="status" style="width: 100%; padding: 0.65rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; background: white; cursor: pointer;">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                    <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Diplômé</option>
                    <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>Transféré</option>
                </select>
            </div>

            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Niveau</label>
                <select name="level_id" style="width: 100%; padding: 0.65rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; background: white; cursor: pointer;">
                    <option value="">Tous les niveaux</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ request('level_id') == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.25rem; border-radius: 10px; height: 42px;">
                    Filtrer
                </button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary" style="padding: 0.65rem 1.25rem; border-radius: 10px; height: 42px; background: white; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center;" title="Réinitialiser">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-container" style="padding: 1rem 2rem 2rem;">
        <table>
            <thead>
                <tr>
                    <th>Élève</th>
                    <th>Sexe</th>
                    <th>Niveau Scolaire</th>
                    <th>Date d'Entrée</th>
                    <th>Statut</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr style="transition: all 0.2s;">
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                                    {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--text-main);">{{ $student->full_name }}</div>
                                    <div style="font-size: 0.75rem; color: var(--text-muted);">Ref: #2IBSN{{ $student->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-size: 0.9rem;">{{ $student->gender == 'M' ? 'Masculin' : 'Féminin' }}</span>
                        </td>
                        <td>
                            <span style="font-size: 0.85rem; padding: 4px 10px; background: #f1f5f9; border-radius: 6px; color: var(--text-main); font-weight: 500;">
                                {{ $student->level->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size: 0.9rem; color: var(--text-muted);">
                                <i class="far fa-calendar-alt" style="margin-right: 4px;"></i>
                                {{ $student->entry_date->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'active' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                    'inactive' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                    'graduated' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                    'transferred' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                ];
                                $color = $statusColors[$student->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
                            @endphp
                            <span style="padding: 0.4rem 0.85rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; background: {{ $color['bg'] }}; color: {{ $color['text'] }}; border: 1px solid rgba(0,0,0,0.05);">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.students.show', $student) }}" class="action-btn" style="color: var(--primary); background: var(--primary-light);" title="Voir Détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.students.edit', $student) }}" class="action-btn" style="color: #64748b; background: #f1f5f9;" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 4rem;">
                            <img src="https://illustrations.popsy.co/gray/search-not-found.svg" alt="Aucun résultat" style="width: 120px; opacity: 0.5; margin-bottom: 1.5rem;">
                            <p style="color: var(--text-muted); font-size: 1.1rem;">Aucun élève ne correspond à votre recherche.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 1rem 2rem 2rem;">
        {{ $students->links() }}
    </div>
</div>

<style>
    .filter-group input:focus, .filter-group select:focus {
        outline: none;
        border-color: var(--primary) !important;
        box-shadow: 0 0 0 3px rgba(26, 77, 46, 0.1);
    }
    .action-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
    }
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
</style>
@endsection
