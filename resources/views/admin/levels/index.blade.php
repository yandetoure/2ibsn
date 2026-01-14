@extends('admin.layout')

@section('title', 'Gestion des Niveaux - 2IBSN')
@section('page-title', 'Gestion des Niveaux')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Liste des Niveaux</h2>
        <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">Nouveau Niveau</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Code</th>
                <th>Mensualité</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($levels as $level)
                <tr>
                    <td>{{ $level->name }}</td>
                    <td>{{ $level->code }}</td>
                    <td>{{ number_format($level->monthly_fee, 0, ',', ' ') }} F</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; 
                            background: {{ $level->is_active ? '#d1fae5' : '#fee2e2' }};
                            color: {{ $level->is_active ? '#065f46' : '#991b1b' }};">
                            {{ $level->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #6b7280;">Aucun niveau enregistré</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $levels->links() }}
    </div>
</div>
@endsection
