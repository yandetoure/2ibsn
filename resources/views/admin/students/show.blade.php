@extends('admin.layout')

@section('title', 'Détails de l\'Élève - 2IBSN')
@section('page-title', 'Détails de l\'Élève')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>{{ $student->full_name }}</h2>
        <div>
            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-primary">Modifier</a>
            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Prénom</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->first_name }}</div>
        </div>
        <div class="form-group">
            <label>Nom</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->last_name }}</div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Sexe</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->gender == 'M' ? 'Masculin' : 'Féminin' }}</div>
        </div>
        <div class="form-group">
            <label>Date de naissance</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->birth_date->format('d/m/Y') }}</div>
        </div>
        <div class="form-group">
            <label>Lieu de naissance</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->birth_place }}</div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Nationalité</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->nationality }}</div>
        </div>
        <div class="form-group">
            <label>Langue parlée</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->spoken_language }}{{ $student->other_language ? ' (' . $student->other_language . ')' : '' }}</div>
        </div>
        <div class="form-group">
            <label>Niveau</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->level->name ?? 'N/A' }}</div>
        </div>
    </div>
    
    <h3 style="margin: 2rem 0 1rem;">Type d'inscription</h3>
    <div class="form-row">
        <div class="form-group">
            <label>Internat</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->is_boarding ? 'Oui' : 'Non' }}</div>
        </div>
        <div class="form-group">
            <label>Externat</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->is_day_student ? 'Oui' : 'Non' }}</div>
        </div>
        <div class="form-group">
            <label>Vacance</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->is_holiday ? 'Oui' : 'Non' }}</div>
        </div>
        <div class="form-group">
            <label>Préscolaire</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->is_preschool ? 'Oui' : 'Non' }}</div>
        </div>
    </div>
    
    <h3 style="margin: 2rem 0 1rem;">Informations parentales</h3>
    <div class="form-row">
        <div class="form-group">
            <label>Père</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->father_name ?? 'N/A' }}</div>
        </div>
        <div class="form-group">
            <label>Téléphone Père</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->father_phone ?? 'N/A' }}</div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Mère</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->mother_name ?? 'N/A' }}</div>
        </div>
        <div class="form-group">
            <label>Téléphone Mère</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->mother_phone ?? 'N/A' }}</div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Adresse</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->parents_address ?? 'N/A' }}</div>
        </div>
        <div class="form-group">
            <label>Villa N°</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->villa_number ?? 'N/A' }}</div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label>Responsable</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->responsible_name ?? 'N/A' }}</div>
        </div>
        <div class="form-group">
            <label>Téléphone Responsable</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->responsible_phone ?? 'N/A' }}</div>
        </div>
    </div>
    
    <h3 style="margin: 2rem 0 1rem;">Informations administratives</h3>
    <div class="form-row">
        <div class="form-group">
            <label>Date d'entrée</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->entry_date->format('d/m/Y') }}</div>
        </div>
        <div class="form-group">
            <label>Date de sortie</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->exit_date ? $student->exit_date->format('d/m/Y') : 'N/A' }}</div>
        </div>
        <div class="form-group">
            <label>Statut</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ ucfirst($student->status) }}</div>
        </div>
    </div>
    
    @if($student->exit_reason)
        <div class="form-group">
            <label>Motif de sortie</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->exit_reason }}</div>
        </div>
    @endif
    
    @if($student->observations)
        <div class="form-group">
            <label>Observations</label>
            <div style="padding: 0.75rem; background: #f9fafb; border-radius: 4px;">{{ $student->observations }}</div>
        </div>
    @endif
    
    <h3 style="margin: 2rem 0 1rem;">Inscriptions</h3>
    @if($student->enrollments->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Niveau</th>
                    <th>Date</th>
                    <th>Mensualité</th>
                    <th>Total payé</th>
                    <th>Reste</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->enrollments as $enrollment)
                    <tr>
                        <td>{{ $enrollment->level->name }}</td>
                        <td>{{ $enrollment->enrollment_date->format('d/m/Y') }}</td>
                        <td>{{ number_format($enrollment->monthly_fee, 0, ',', ' ') }} F</td>
                        <td>{{ number_format($enrollment->total_paid, 0, ',', ' ') }} F</td>
                        <td>{{ number_format($enrollment->remaining_amount, 0, ',', ' ') }} F</td>
                        <td>{{ ucfirst($enrollment->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #6b7280;">Aucune inscription enregistrée</p>
    @endif
    
    <h3 style="margin: 2rem 0 1rem;">Paiements</h3>
    @if($student->payments->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Type</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->payments as $payment)
                    <tr>
                        <td>{{ $payment->payment_date->format('d/m/Y') }}</td>
                        <td>{{ number_format($payment->amount, 0, ',', ' ') }} F</td>
                        <td>
                            @if($payment->type == 'first_monthly') 1ère Mensualité
                            @elseif($payment->type == 'monthly') Mensualité
                            @else Autre
                            @endif
                        </td>
                        <td>{{ ucfirst($payment->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #6b7280;">Aucun paiement enregistré</p>
    @endif
</div>
@endsection
