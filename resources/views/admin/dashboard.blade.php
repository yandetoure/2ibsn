@extends('admin.layout')

@section('title', 'Dashboard - 2IBSN Admin')
@section('page-title', 'Tableau de Bord')

@section('content')
<div class="stats-overview" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
    <!-- Stat Card 1 -->
    <div class="stat-card-premium" style="background: white; padding: 1.5rem; border-radius: 20px; box-shadow: var(--shadow-sm); border: 1px solid rgba(0,0,0,0.05); display: flex; align-items: center; gap: 20px;">
        <div class="stat-icon" style="width: 56px; height: 56px; border-radius: 16px; background: rgba(26, 77, 46, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="stat-details">
            <span style="display: block; color: var(--text-muted); font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Total Élèves</span>
            <span style="display: block; font-size: 1.75rem; font-weight: 700; color: var(--primary);">{{ $stats['total_students'] }}</span>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="stat-card-premium" style="background: white; padding: 1.5rem; border-radius: 20px; box-shadow: var(--shadow-sm); border: 1px solid rgba(0,0,0,0.05); display: flex; align-items: center; gap: 20px;">
        <div class="stat-icon" style="width: 56px; height: 56px; border-radius: 16px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-details">
            <span style="display: block; color: var(--text-muted); font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Élèves Actifs</span>
            <span style="display: block; font-size: 1.75rem; font-weight: 700; color: #10b981;">{{ $stats['active_students'] }}</span>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="stat-card-premium" style="background: white; padding: 1.5rem; border-radius: 20px; box-shadow: var(--shadow-sm); border: 1px solid rgba(0,0,0,0.05); display: flex; align-items: center; gap: 20px;">
        <div class="stat-icon" style="width: 56px; height: 56px; border-radius: 16px; background: rgba(212, 175, 55, 0.1); color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-wallet"></i>
        </div>
        <div class="stat-details">
            <span style="display: block; color: var(--text-muted); font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Recettes Totales</span>
            <span style="display: block; font-size: 1.75rem; font-weight: 700; color: var(--text-main);">{{ number_format($stats['total_payments'], 0, ',', ' ') }} F</span>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="stat-card-premium" style="background: white; padding: 1.5rem; border-radius: 20px; box-shadow: var(--shadow-sm); border: 1px solid rgba(0,0,0,0.05); display: flex; align-items: center; gap: 20px;">
        <div class="stat-icon" style="width: 56px; height: 56px; border-radius: 16px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-details">
            <span style="display: block; color: var(--text-muted); font-size: 0.85rem; font-weight: 600; margin-bottom: 4px;">Attente Paiement</span>
            <span style="display: block; font-size: 1.75rem; font-weight: 700; color: #ef4444;">{{ $stats['pending_payments'] }}</span>
        </div>
    </div>
</div>

<div class="dashboard-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Recent Students Table -->
    <div class="card" style="padding: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.15rem; font-weight: 700; color: var(--primary);">Inscriptions Récentes</h2>
            <a href="{{ route('admin.students.index') }}" style="font-size: 0.85rem; font-weight: 600; color: var(--secondary); text-decoration: none;">Voir tout</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Élève</th>
                        <th>Niveau</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_students as $student)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $student->full_name }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Inscrit le {{ $student->created_at->format('d/m/Y') }}</div>
                            </td>
                            <td><span style="font-size: 0.85rem; padding: 4px 8px; background: #f1f5f9; border-radius: 4px;">{{ $student->level->name ?? 'N/A' }}</span></td>
                            <td>
                                <span style="padding: 0.35rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
                                    background: {{ $student->status == 'active' ? '#dcfce7' : '#fee2e2' }};
                                    color: {{ $student->status == 'active' ? '#166534' : '#991b1b' }};">
                                    {{ $student->status == 'active' ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.students.show', $student) }}" class="btn-secondary" style="padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; text-decoration: none;">Gérer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-muted);">Aucun élève récemment inscrit.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="card" style="padding: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.15rem; font-weight: 700; color: var(--primary);">Derniers Paiements</h2>
            <a href="{{ route('admin.payments.index') }}" style="font-size: 0.85rem; font-weight: 600; color: var(--secondary); text-decoration: none;">Voir tout</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Élève</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_payments as $payment)
                        <tr>
                            <td>
                                <div style="font-weight: 600;">{{ $payment->student->full_name }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $payment->payment_date->format('d/m/Y') }}</div>
                            </td>
                            <td><span style="font-weight: 700; color: var(--primary);">{{ number_format($payment->amount, 0, ',', ' ') }} F</span></td>
                            <td>
                                <span style="font-size: 0.8rem; color: var(--text-muted);">
                                    @if($payment->type == 'first_monthly') 1ère Mens.
                                    @elseif($payment->type == 'monthly') Mensualité
                                    @else Autre
                                    @endif
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.payments.show', $payment) }}" class="btn-secondary" style="padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; text-decoration: none;">Recu</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: var(--text-muted);">Aucun paiement enregistré.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
