@extends('admin.layout')

@section('title', 'Nouveau Paiement - 2IBSN')
@section('page-title', 'Nouveau Paiement')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Enregistrer un Nouveau Paiement</h2>
    
    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="student_id">Élève <span style="color: #ef4444;">*</span></label>
                <select id="student_id" name="student_id" required>
                    <option value="">Sélectionner un élève</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->full_name }} - {{ $student->level->name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="enrollment_id">Inscription (optionnel)</label>
                <select id="enrollment_id" name="enrollment_id">
                    <option value="">Aucune (sera trouvée automatiquement)</option>
                    @foreach($enrollments as $enrollment)
                        <option value="{{ $enrollment->id }}" data-student-id="{{ $enrollment->student_id }}">
                            {{ $enrollment->student->full_name }} - {{ $enrollment->level->name }} ({{ $enrollment->enrollment_date->format('d/m/Y') }})
                        </option>
                    @endforeach
                </select>
                @error('enrollment_id')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="amount">Montant (FCFA) <span style="color: #ef4444;">*</span></label>
                <input type="number" id="amount" name="amount" value="{{ old('amount') }}" min="0" step="0.01" required>
                @error('amount')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="type">Type <span style="color: #ef4444;">*</span></label>
                <select id="type" name="type" required>
                    <option value="first_monthly" {{ old('type') == 'first_monthly' ? 'selected' : '' }}>1ère Mensualité</option>
                    <option value="monthly" {{ old('type') == 'monthly' ? 'selected' : '' }}>Mensualité</option>
                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('type')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="payment_date">Date de paiement <span style="color: #ef4444;">*</span></label>
                <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                @error('payment_date')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
            @error('notes')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Annuler</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const studentSelect = document.getElementById('student_id');
    const enrollmentSelect = document.getElementById('enrollment_id');
    
    studentSelect.addEventListener('change', function() {
        const studentId = this.value;
        const options = enrollmentSelect.querySelectorAll('option');
        
        // Afficher toutes les options
        options.forEach(option => {
            option.style.display = '';
        });
        
        // Si un élève est sélectionné, filtrer les inscriptions
        if (studentId) {
            options.forEach(option => {
                if (option.value && option.dataset.studentId !== studentId) {
                    option.style.display = 'none';
                }
            });
            
            // Sélectionner automatiquement l'inscription active de l'élève si disponible
            const activeEnrollment = Array.from(options).find(option => 
                option.dataset.studentId === studentId && option.value
            );
            if (activeEnrollment) {
                enrollmentSelect.value = activeEnrollment.value;
            }
        }
    });
});
</script>
@endsection
