@extends('admin.layout')

@section('title', 'Détails du Paiement - 2IBSN')
@section('page-title', 'Détails du Paiement')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Paiement #{{ $payment->id }}</h2>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('admin.payments.receipt', $payment) }}" class="btn btn-success">Générer Reçu</a>
            <a href="{{ route('admin.payments.receipt.download', $payment) }}" class="btn btn-primary">Télécharger Reçu</a>
            <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-secondary">Modifier</a>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Élève</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">
                <a href="{{ route('admin.students.show', $payment->student) }}" style="color: var(--primary); text-decoration: none;">
                    {{ $payment->student->full_name }}
                </a>
            </div>
        </div>
        <div class="form-group">
            <label>Montant</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px; font-size: 1.25rem; font-weight: 600; color: var(--primary);">
                {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
            </div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Type</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">
                @if($payment->type == 'first_monthly') 1ère Mensualité
                @elseif($payment->type == 'monthly') Mensualité
                @else Autre
                @endif
            </div>
        </div>
        <div class="form-group">
            <label>Date de paiement</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $payment->payment_date->format('d/m/Y') }}</div>
        </div>
        <div class="form-group">
            <label>Statut</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">
                <span style="padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem; 
                    background: {{ $payment->status == 'completed' ? '#d1fae5' : ($payment->status == 'pending' ? '#fef3c7' : '#fee2e2') }};
                    color: {{ $payment->status == 'completed' ? '#065f46' : ($payment->status == 'pending' ? '#92400e' : '#991b1b') }};">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>
        </div>
    </div>
    
    @if($payment->enrollment)
        <div class="form-group">
            <label>Inscription associée</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">
                {{ $payment->enrollment->level->name }} - {{ $payment->enrollment->enrollment_date->format('d/m/Y') }}
            </div>
        </div>
    @endif
    
    @if($payment->notes)
        <div class="form-group">
            <label>Notes</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $payment->notes }}</div>
        </div>
    @endif
</div>
@endsection
