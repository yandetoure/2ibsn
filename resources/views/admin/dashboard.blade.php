@extends('admin.layout')

@section('title', 'Dashboard Admin - 2IBSN')
@section('page-title', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Élèves</h3>
        <div class="value">{{ $stats['total_students'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Élèves Actifs</h3>
        <div class="value">{{ $stats['active_students'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Inscriptions Actives</h3>
        <div class="value">{{ $stats['total_enrollments'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Total Paiements</h3>
        <div class="value">{{ number_format($stats['total_payments'], 0, ',', ' ') }} F</div>
    </div>
    <div class="stat-card">
        <h3>Paiements en Attente</h3>
        <div class="value">{{ $stats['pending_payments'] }}</div>
    </div>
    <div class="stat-card">
        <h3>Niveaux Actifs</h3>
        <div class="value">{{ $stats['total_levels'] }}</div>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom: 1rem;">Élèves Récents</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Niveau</th>
                <th>Date d'entrée</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent_students as $student)
                <tr>
                    <td>{{ $student->full_name }}</td>
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
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #6b7280;">Aucun élève enregistré</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h2 style="margin-bottom: 1rem;">Paiements Récents</h2>
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
            @forelse($recent_payments as $payment)
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
                            background: {{ $payment->status == 'completed' ? '#d1fae5' : '#fee2e2' }};
                            color: {{ $payment->status == 'completed' ? '#065f46' : '#991b1b' }};">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-primary" style="padding: 0.25rem 0.75rem; font-size: 0.875rem;">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">Aucun paiement enregistré</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
