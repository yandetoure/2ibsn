@extends('admin.layout')

@section('title', 'Gestion des Paiements - 2IBSN')
@section('page-title', 'Gestion des Paiements')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Liste des Paiements</h2>
        <a href="{{ route('admin.payments.create') }}" class="btn btn-primary">Nouveau Paiement</a>
    </div>
    
    <form method="GET" action="{{ route('admin.payments.index') }}" style="margin-bottom: 1.5rem;">
        <div class="form-row">
            <div class="form-group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher (nom élève...)" style="margin-bottom: 0;">
            </div>
            <div class="form-group">
                <select name="status" style="margin-bottom: 0;">
                    <option value="">Tous les statuts</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Complété</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <div class="form-group">
                <select name="type" style="margin-bottom: 0;">
                    <option value="">Tous les types</option>
                    <option value="first_monthly" {{ request('type') == 'first_monthly' ? 'selected' : '' }}>1ère Mensualité</option>
                    <option value="monthly" {{ request('type') == 'monthly' ? 'selected' : '' }}>Mensualité</option>
                    <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" style="margin-bottom: 0;">Filtrer</button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary" style="margin-bottom: 0;">Réinitialiser</a>
            </div>
        </div>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Élève</th>
                <th>Montant</th>
                <th>Type</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->student->full_name }}</td>
                    <td>{{ number_format($payment->amount, 0, ',', ' ') }} F</td>
                    <td>
                        @if($payment->type == 'first_monthly') 1ère Mensualité
                        @elseif($payment->type == 'monthly') Mensualité
                        @else Autre
                        @endif
                    </td>
                    <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; 
                            background: {{ $payment->status == 'completed' ? '#d1fae5' : ($payment->status == 'pending' ? '#fef3c7' : '#fee2e2') }};
                            color: {{ $payment->status == 'completed' ? '#065f46' : ($payment->status == 'pending' ? '#92400e' : '#991b1b') }};">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-primary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Voir</a>
                        <a href="{{ route('admin.payments.receipt.generate', $payment) }}" class="btn btn-success" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Reçu</a>
                        <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-secondary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Modifier</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">Aucun paiement trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $payments->links() }}
    </div>
</div>
@endsection
