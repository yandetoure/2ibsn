@extends('admin.layout')

@section('title', 'Gestion des Niveaux - 2IBSN')
@section('page-title', 'Niveaux & Tarifications')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h2 style="color: var(--primary); font-size: 1.5rem; font-weight: 700;">Grille Tarifaire</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Gérez les frais d'inscription et mensualités par niveau.</p>
        </div>
        <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouveau Niveau
        </a>
    </div>
    
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Niveau</th>
                    <th>Code</th>
                    <th>Standard (Insc/Mens)</th>
                    <th>D-Pension (Insc/Mens)</th>
                    <th>Statut</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($levels as $level)
                    <tr>
                        <td>
                            @php
                                $categories = [
                                    'preschool' => '🌱 Préscolaire',
                                    'elementary' => '📐 Élémentaire',
                                    'college' => '🎓 Collège'
                                ];
                            @endphp
                            <span class="badge-category-{{ $level->category }}" style="padding: 6px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700;">
                                {{ $categories[$level->category] ?? $level->category }}
                            </span>
                        </td>
                        <td style="font-weight: 600; color: var(--primary);">{{ $level->name }}</td>
                        <td><code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $level->code }}</code></td>
                        <td>
                            <div style="font-weight: 700;">{{ number_format($level->registration_fee, 0, ',', ' ') }} F</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ number_format($level->monthly_fee, 0, ',', ' ') }} F / mois</div>
                        </td>
                        <td>
                            @if($level->half_pension_registration_fee > 0 || $level->half_pension_monthly_fee > 0)
                                <div style="font-weight: 700; color: var(--secondary);">{{ number_format($level->half_pension_registration_fee, 0, ',', ' ') }} F</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ number_format($level->half_pension_monthly_fee, 0, ',', ' ') }} F / mois</div>
                            @else
                                <span style="color: #9ca3af; font-size: 0.8rem;">Non disponible</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-indicator {{ $level->is_active ? 'status-active' : 'status-inactive' }}" 
                                  style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.8rem; font-weight: 600;">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: {{ $level->is_active ? '#10b981' : '#ef4444' }};"></span>
                                {{ $level->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.levels.edit', $level) }}" class="btn-action" title="Modifier" style="color: var(--text-muted); background: #f8fafc; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #e2e8f0; text-decoration: none;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action" title="Supprimer" style="color: #ef4444; background: #fff1f2; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 8px; border: 1px solid #fecaca; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 4rem; color: var(--text-muted);">
                            <i class="fas fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 1rem; opacity: 0.3;"></i>
                            Aucun niveau enregistré
                        </td>
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
    .badge-category-preschool { background: #dcfce7; color: #166534; }
    .badge-category-elementary { background: #dbeafe; color: #1e40af; }
    .badge-category-college { background: #f3e8ff; color: #6b21a8; }
    
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
    }
</style>
@endsection
