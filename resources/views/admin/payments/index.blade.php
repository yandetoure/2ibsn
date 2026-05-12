@extends('admin.layout')

@section('title', 'Gestion des Paiements - 2IBSN')
@section('page-title', 'Historique des Paiements')

@section('content')
<div class="card" style="padding: 0; overflow: hidden; border: none; box-shadow: var(--shadow-md);">
    <!-- Header Section -->
    <div style="padding: 2rem; background: white; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <h2 style="color: var(--primary); font-size: 1.5rem; font-weight: 700;">Liste des Paiements</h2>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Suivez les transactions et règlements de scolarité.</p>
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('admin.payments.create') }}" class="btn btn-primary" style="background: var(--primary);">
                <i class="fas fa-plus-circle"></i> Nouveau Paiement
            </a>
            <button class="btn btn-secondary" style="background: #f1f5f9; color: var(--text-main); border: 1px solid #e2e8f0;">
                <i class="fas fa-file-export"></i> Exporter
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div style="padding: 1.25rem 2rem; background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
        <form method="GET" action="{{ route('admin.payments.index') }}" style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 1rem; align-items: end;">
            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Recherche</label>
                <div style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 0.9rem;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom de l'élève..." 
                           style="width: 100%; padding: 0.65rem 0.75rem 0.65rem 2.5rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; transition: all 0.2s;">
                </div>
            </div>

            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Statut</label>
                <select name="status" style="width: 100%; padding: 0.65rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; background: white; cursor: pointer;">
                    <option value="">Tous les statuts</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complété</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>

            <div class="filter-group">
                <label style="display: block; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">Type</label>
                <select name="type" style="width: 100%; padding: 0.65rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 0.9rem; background: white; cursor: pointer;">
                    <option value="">Tous les types</option>
                    <option value="first_monthly" {{ request('type') == 'first_monthly' ? 'selected' : '' }}>1ère Mensualité</option>
                    <option value="monthly" {{ request('type') == 'monthly' ? 'selected' : '' }}>Mensualité</option>
                    <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.65rem 1.25rem; border-radius: 10px; height: 42px;">
                    Filtrer
                </button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary" style="padding: 0.65rem 1.25rem; border-radius: 10px; height: 42px; background: white; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center;" title="Réinitialiser">
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
                    <th>Montant</th>
                    <th>Type de Frais</th>
                    <th>Date du Paiement</th>
                    <th>Statut</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr style="transition: all 0.2s;">
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                                    {{ substr($payment->student->first_name, 0, 1) }}{{ substr($payment->student->last_name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--text-main);">{{ $payment->student->full_name }}</div>
                                    <div style="font-size: 0.75rem; color: var(--text-muted);">Ref Transaction: #PAY{{ $payment->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--primary); font-size: 1.1rem;">
                                {{ number_format($payment->amount, 0, ',', ' ') }} F
                            </div>
                        </td>
                        <td>
                            @php
                                $typeLabels = [
                                    'first_monthly' => '1ère Mensualité',
                                    'monthly' => 'Mensualité',
                                    'other' => 'Autre / Frais divers',
                                ];
                            @endphp
                            <span style="font-size: 0.85rem; color: var(--text-main); font-weight: 500;">
                                {{ $typeLabels[$payment->type] ?? $payment->type }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size: 0.9rem; color: var(--text-muted);">
                                <i class="far fa-calendar-alt" style="margin-right: 4px;"></i>
                                {{ $payment->payment_date->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusColors = [
                                    'completed' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                    'pending' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                    'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                ];
                                $color = $statusColors[$payment->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569'];
                            @endphp
                            <span style="padding: 0.4rem 0.85rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; background: {{ $color['bg'] }}; color: {{ $color['text'] }}; border: 1px solid rgba(0,0,0,0.05);">
                                {{ $payment->status == 'completed' ? 'Payé' : ($payment->status == 'pending' ? 'En Attente' : 'Annulé') }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.payments.show', $payment) }}" class="action-btn" style="color: var(--primary); background: var(--primary-light);" title="Voir Détails">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                <a href="{{ route('admin.payments.receipt', $payment) }}" class="action-btn" style="color: #10b981; background: #ecfdf5;" title="Imprimer Reçu">
                                    <i class="fas fa-print"></i>
                                </a>
                                <a href="{{ route('admin.payments.edit', $payment) }}" class="action-btn" style="color: #64748b; background: #f1f5f9;" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 4rem;">
                            <img src="https://illustrations.popsy.co/gray/data-analysis.svg" alt="Aucun résultat" style="width: 120px; opacity: 0.5; margin-bottom: 1.5rem;">
                            <p style="color: var(--text-muted); font-size: 1.1rem;">Aucun paiement trouvé dans l'historique.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="padding: 1rem 2rem 2rem;">
        {{ $payments->links() }}
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
