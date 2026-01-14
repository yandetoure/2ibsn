@extends('admin.layout')

@section('title', 'Modifier le Paiement - 2IBSN')
@section('page-title', 'Modifier le Paiement')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Modifier le Paiement</h2>
    
    <form action="{{ route('admin.payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="student_id">Élève <span style="color: #ef4444;">*</span></label>
                <select id="student_id" name="student_id" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $payment->student_id) == $student->id ? 'selected' : '' }}>
                            {{ $student->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="enrollment_id">Inscription (optionnel)</label>
                <select id="enrollment_id" name="enrollment_id">
                    <option value="">Aucune</option>
                </select>
                @error('enrollment_id')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="amount">Montant (FCFA) <span style="color: #ef4444;">*</span></label>
                <input type="number" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" min="0" step="0.01" required>
                @error('amount')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="type">Type <span style="color: #ef4444;">*</span></label>
                <select id="type" name="type" required>
                    <option value="first_monthly" {{ old('type', $payment->type) == 'first_monthly' ? 'selected' : '' }}>1ère Mensualité</option>
                    <option value="monthly" {{ old('type', $payment->type) == 'monthly' ? 'selected' : '' }}>Mensualité</option>
                    <option value="other" {{ old('type', $payment->type) == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="payment_date">Date de paiement <span style="color: #ef4444;">*</span></label>
                <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date', $payment->payment_date->format('Y-m-d')) }}" required>
                @error('payment_date')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="status">Statut <span style="color: #ef4444;">*</span></label>
                <select id="status" name="status" required>
                    <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>Complété</option>
                    <option value="cancelled" {{ old('status', $payment->status) == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                </select>
                @error('status')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" rows="3">{{ old('notes', $payment->notes) }}</textarea>
            @error('notes')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<style>
.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}
</style>
@endsection
