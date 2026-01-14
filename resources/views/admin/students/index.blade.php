@extends('admin.layout')

@section('title', 'Gestion des Élèves - 2IBSN')
@section('page-title', 'Gestion des Élèves')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h2>Liste des Élèves</h2>
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <a href="{{ route('registration') }}" class="btn btn-primary">Nouvelle Inscription</a>
            <a href="{{ route('admin.students.import') }}" class="btn btn-success">Importer</a>
            <a href="{{ route('admin.students.export', request()->all()) }}" class="btn btn-secondary">Exporter</a>
        </div>
    </div>
    
    <form method="GET" action="{{ route('admin.students.index') }}" style="margin-bottom: 1.5rem;">
        <div class="form-row">
            <div class="form-group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher (nom, téléphone...)" style="margin-bottom: 0;">
            </div>
            <div class="form-group">
                <select name="status" style="margin-bottom: 0;">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                    <option value="graduated" {{ request('status') == 'graduated' ? 'selected' : '' }}>Diplômé</option>
                    <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>Transféré</option>
                </select>
            </div>
            <div class="form-group">
                <select name="level_id" style="margin-bottom: 0;">
                    <option value="">Tous les niveaux</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id }}" {{ request('level_id') == $level->id ? 'selected' : '' }}>
                            {{ $level->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-bottom: 0;">Filtrer</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary" style="margin-bottom: 0;">Réinitialiser</a>
            </div>
        </div>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sexe</th>
                <th>Niveau</th>
                <th>Date d'entrée</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->gender == 'M' ? 'Masculin' : 'Féminin' }}</td>
                    <td>{{ $student->level->name ?? 'N/A' }}</td>
                    <td>{{ $student->entry_date->format('d/m/Y') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; 
                            background: {{ $student->status == 'active' ? '#d1fae5' : '#fee2e2' }};
                            color: {{ $student->status == 'active' ? '#065f46' : '#991b1b' }};">
                            {{ ucfirst($student->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.students.show', $student) }}" class="btn btn-primary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Voir</a>
                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">Aucun élève trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $students->links() }}
    </div>
</div>
@endsection
