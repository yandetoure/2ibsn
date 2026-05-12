@extends('admin.layout')

@section('title', 'Gestion des Niveaux - 2IBSN')
@section('page-title', 'Gestion des Niveaux')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="color: var(--primary);">Liste des Niveaux & Tarifications</h2>
        <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Niveau
        </a>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Inscription</th>
                    <th>Mensualité</th>
                    <th>D-Pension (Insc/Mens)</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($levels as $level)
                    <tr>
                        <td>
                            @php
                                $categories = [
                                    'preschool' => 'Préscolaire',
                                    'elementary' => 'Élémentaire',
                                    'college' => 'Collège'
                                ];
                            @endphp
                            <span class="badge badge-category-{{ $level->category }}">
                                {{ $categories[$level->category] ?? $level->category }}
                            </span>
                        </td>
                        <td style="font-weight: 600;">{{ $level->name }}</td>
                        <td><code>{{ $level->code }}</code></td>
                        <td>{{ number_format($level->registration_fee, 0, ',', ' ') }} F</td>
                        <td>{{ number_format($level->monthly_fee, 0, ',', ' ') }} F</td>
                        <td>
                            @if($level->half_pension_registration_fee > 0 || $level->half_pension_monthly_fee > 0)
                                {{ number_format($level->half_pension_registration_fee, 0, ',', ' ') }} / {{ number_format($level->half_pension_monthly_fee, 0, ',', ' ') }} F
                            @else
                                <span style="color: #9ca3af;">N/A</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge {{ $level->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $level->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-secondary btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 3rem; color: #6b7280;">Aucun niveau enregistré</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $levels->links() }}
    </div>
</div>

<style>
    .badge {
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .badge-category-preschool { background: #dcfce7; color: #166534; }
    .badge-category-elementary { background: #dbeafe; color: #1e40af; }
    .badge-category-college { background: #f3e8ff; color: #6b21a8; }

    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .status-active { background: #d1fae5; color: #065f46; }
    .status-inactive { background: #fee2e2; color: #991b1b; }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endsection
