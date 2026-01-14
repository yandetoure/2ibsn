@extends('layouts.app')

@section('title', 'Formulaire d\'Inscription - 2IBSN')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>FICHE D'INSCRIPTION</h1>
        <p>INSTITUT INTERNATIONAL BAYE BARHAMOU</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <form action="{{ route('registration.store') }}" method="POST" class="registration-form">
            @csrf

            <!-- Type d'inscription -->
            <div class="form-section">
                <h2 class="section-title">Type d'Inscription</h2>
                <div class="form-group checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_boarding" value="1" {{ old('is_boarding') ? 'checked' : '' }}>
                        <span>Internat</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_day_student" value="1" {{ old('is_day_student') ? 'checked' : '' }}>
                        <span>Externat</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_holiday" value="1" {{ old('is_holiday') ? 'checked' : '' }}>
                        <span>Vacance</span>
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="is_preschool" value="1" {{ old('is_preschool') ? 'checked' : '' }}>
                        <span>Préscolaire</span>
                    </label>
                </div>
            </div>

            <!-- Informations de l'élève -->
            <div class="form-section">
                <h2 class="section-title">Informations de l'Élève</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Sexe <span class="required">*</span></label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="gender" value="M" {{ old('gender') == 'M' ? 'checked' : '' }} required>
                                <span>M</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="gender" value="F" {{ old('gender') == 'F' ? 'checked' : '' }}>
                                <span>F</span>
                            </label>
                        </div>
                        @error('gender')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">Prénom et Nom de l'élève <span class="required">*</span></label>
                        <div class="form-row">
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom" required>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Nom" required>
                        </div>
                        @error('first_name')<span class="error">{{ $message }}</span>@enderror
                        @error('last_name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="birth_date">Date et Lieu de naissance <span class="required">*</span></label>
                        <div class="form-row">
                            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required>
                            <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}" placeholder="Lieu de naissance" required>
                        </div>
                        @error('birth_date')<span class="error">{{ $message }}</span>@enderror
                        @error('birth_place')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nationality">Nationalité <span class="required">*</span></label>
                        <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}" required>
                        @error('nationality')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Langue parlée <span class="required">*</span></label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="spoken_language" value="Wolof" {{ old('spoken_language') == 'Wolof' ? 'checked' : '' }} required>
                                <span>Wolof</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="spoken_language" value="Poular" {{ old('spoken_language') == 'Poular' ? 'checked' : '' }}>
                                <span>Poular</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="spoken_language" value="Sérère" {{ old('spoken_language') == 'Sérère' ? 'checked' : '' }}>
                                <span>Sérère</span>
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="spoken_language" value="Autres" {{ old('spoken_language') == 'Autres' ? 'checked' : '' }}>
                                <span>Autres</span>
                            </label>
                        </div>
                        @error('spoken_language')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row" id="other_language_row" style="display: {{ old('spoken_language') == 'Autres' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label for="other_language">Préciser la langue</label>
                        <input type="text" id="other_language" name="other_language" value="{{ old('other_language') }}" placeholder="Autre langue">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="level_id">Niveau de l'élève <span class="required">*</span></label>
                        <select id="level_id" name="level_id" required>
                            <option value="">Sélectionner un niveau</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_id')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Informations parentales -->
            <div class="form-section">
                <h2 class="section-title">Informations Parentales</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label for="father_name">Prénom et Nom du Père</label>
                        <div class="form-row">
                            <input type="text" id="father_name" name="father_name" value="{{ old('father_name') }}" placeholder="Nom du père">
                            <input type="text" id="father_phone" name="father_phone" value="{{ old('father_phone') }}" placeholder="Tél" style="max-width: 200px;">
                        </div>
                        @error('father_name')<span class="error">{{ $message }}</span>@enderror
                        @error('father_phone')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="mother_name">Prénom et Nom de la Mère</label>
                        <div class="form-row">
                            <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" placeholder="Nom de la mère">
                            <input type="text" id="mother_phone" name="mother_phone" value="{{ old('mother_phone') }}" placeholder="Tél" style="max-width: 200px;">
                        </div>
                        @error('mother_name')<span class="error">{{ $message }}</span>@enderror
                        @error('mother_phone')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="parents_address">Adresse des parents</label>
                        <div class="form-row">
                            <input type="text" id="parents_address" name="parents_address" value="{{ old('parents_address') }}" placeholder="Adresse">
                            <input type="text" id="villa_number" name="villa_number" value="{{ old('villa_number') }}" placeholder="Villa N°" style="max-width: 150px;">
                        </div>
                        @error('parents_address')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="responsible_name">Responsable</label>
                        <div class="form-row">
                            <input type="text" id="responsible_name" name="responsible_name" value="{{ old('responsible_name') }}" placeholder="Nom du responsable">
                            <input type="text" id="responsible_phone" name="responsible_phone" value="{{ old('responsible_phone') }}" placeholder="Tél" style="max-width: 200px;">
                        </div>
                        @error('responsible_name')<span class="error">{{ $message }}</span>@enderror
                        @error('responsible_phone')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Informations administratives -->
            <div class="form-section">
                <h2 class="section-title">Informations Administratives</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label for="entry_date">Date d'entrée <span class="required">*</span></label>
                        <input type="date" id="entry_date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required>
                        @error('entry_date')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first_monthly_paid">Sommes versées</label>
                        <div class="form-row">
                            <input type="number" id="first_monthly_paid" name="first_monthly_paid" value="{{ old('first_monthly_paid') }}" placeholder="Montant" min="0" step="0.01">
                            <div class="radio-group" style="margin-left: 20px;">
                                <label class="radio-label">
                                    <input type="radio" name="first_monthly_included" value="1" {{ old('first_monthly_included', '0') == '1' ? 'checked' : '' }}>
                                    <span>1er Mensualité y compris OUI</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="first_monthly_included" value="0" {{ old('first_monthly_included', '0') == '0' ? 'checked' : '' }}>
                                    <span>NON</span>
                                </label>
                            </div>
                        </div>
                        @error('first_monthly_paid')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="observations">Observation</label>
                        <textarea id="observations" name="observations" rows="3" placeholder="Observations">{{ old('observations') }}</textarea>
                        @error('observations')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Soumettre l'Inscription</button>
                <a href="{{ route('admissions') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</section>

<style>
.registration-form {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #e5e7eb;
}

.form-section:last-of-type {
    border-bottom: none;
}

.section-title {
    color: var(--primary);
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
    font-weight: 600;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text-dark);
}

.required {
    color: #ef4444;
}

.form-row {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.form-row input,
.form-row select {
    flex: 1;
}

input[type="text"],
input[type="date"],
input[type="number"],
input[type="email"],
select,
textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(26, 77, 46, 0.1);
}

.checkbox-group,
.radio-group {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.checkbox-label,
.radio-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.checkbox-label input[type="checkbox"],
.radio-label input[type="radio"] {
    width: auto;
    cursor: pointer;
}

.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 1rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
}

.alert-error ul {
    margin: 0;
    padding-left: 1.5rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s;
}

.btn-primary {
    background: var(--primary);
    color: white;
}

.btn-primary:hover {
    background: #0f3d1f;
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background: #4b5563;
}

@media (max-width: 768px) {
    .registration-form {
        padding: 1rem;
    }
    
    .form-row {
        flex-direction: column;
    }
    
    .checkbox-group,
    .radio-group {
        flex-direction: column;
        gap: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otherLanguageRadio = document.querySelector('input[value="Autres"]');
    const otherLanguageRow = document.getElementById('other_language_row');
    
    document.querySelectorAll('input[name="spoken_language"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'Autres') {
                otherLanguageRow.style.display = 'block';
            } else {
                otherLanguageRow.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
