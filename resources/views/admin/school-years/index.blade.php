@extends('admin.layout')

@section('title', 'Années Scolaires - 2IBSN')
@section('page-title', 'Années Scolaires')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Années Scolaires</h2>
        <a href="{{ route('admin.school-years.create') }}" class="btn btn-primary">Nouvelle Année</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Code</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schoolYears as $year)
                <tr>
                    <td>{{ $year->name }}</td>
                    <td>{{ $year->code }}</td>
                    <td>{{ $year->start_date->format('d/m/Y') }}</td>
                    <td>{{ $year->end_date->format('d/m/Y') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; 
                            background: {{ $year->is_current ? '#d1fae5' : '#fee2e2' }};
                            color: {{ $year->is_current ? '#065f46' : '#991b1b' }};">
                            {{ $year->is_current ? 'Année Courante' : 'Passée' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.school-years.edit', $year) }}" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">Aucune année scolaire enregistrée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $schoolYears->links() }}
    </div>
</div>
@endsection
