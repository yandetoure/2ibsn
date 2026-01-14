@extends('admin.layout')

@section('title', 'Modifier l\'Élève - 2IBSN')
@section('page-title', 'Modifier l\'Élève')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Modifier {{ $student->full_name }}</h2>
    
    <form action="{{ route('admin.students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-section">
            <h3 class="section-title">Informations de l'Élève</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">Prénom <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $student->first_name) }}" required>
                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Nom <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $student->last_name) }}" required>
                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label>Sexe <span style="color: #ef4444;">*</span></label>
                    <div style="display: flex; gap: 1rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="radio" name="gender" value="M" {{ old('gender', $student->gender) == 'M' ? 'checked' : '' }} required>
                            <span>Masculin</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="radio" name="gender" value="F" {{ old('gender', $student->gender) == 'F' ? 'checked' : '' }}>
                            <span>Féminin</span>
                        </label>
                    </div>
                    @error('gender')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="birth_date">Date de naissance <span style="color: #ef4444;">*</span></label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $student->birth_date->format('Y-m-d')) }}" required>
                    @error('birth_date')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="birth_place">Lieu de naissance <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place', $student->birth_place) }}" required>
                    @error('birth_place')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nationality">Nationalité <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="nationality" name="nationality" value="{{ old('nationality', $student->nationality) }}" required>
                    @error('nationality')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="spoken_language">Langue parlée <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="spoken_language" name="spoken_language" value="{{ old('spoken_language', $student->spoken_language) }}" required>
                    @error('spoken_language')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="level_id">Niveau <span style="color: #ef4444;">*</span></label>
                    <select id="level_id" name="level_id" required>
                        <option value="">Sélectionner</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id', $student->level_id) == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('level_id')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_boarding" value="1" {{ old('is_boarding', $student->is_boarding) ? 'checked' : '' }}>
                        <span>Internat</span>
                    </label>
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_day_student" value="1" {{ old('is_day_student', $student->is_day_student) ? 'checked' : '' }}>
                        <span>Externat</span>
                    </label>
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_holiday" value="1" {{ old('is_holiday', $student->is_holiday) ? 'checked' : '' }}>
                        <span>Vacance</span>
                    </label>
                </div>
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_preschool" value="1" {{ old('is_preschool', $student->is_preschool) ? 'checked' : '' }}>
                        <span>Préscolaire</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3 class="section-title">Informations Parentales</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="father_name">Nom du Père</label>
                    <input type="text" id="father_name" name="father_name" value="{{ old('father_name', $student->father_name) }}">
                </div>
                <div class="form-group">
                    <label for="father_phone">Téléphone Père</label>
                    <input type="text" id="father_phone" name="father_phone" value="{{ old('father_phone', $student->father_phone) }}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="mother_name">Nom de la Mère</label>
                    <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}">
                </div>
                <div class="form-group">
                    <label for="mother_phone">Téléphone Mère</label>
                    <input type="text" id="mother_phone" name="mother_phone" value="{{ old('mother_phone', $student->mother_phone) }}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="parents_address">Adresse</label>
                    <input type="text" id="parents_address" name="parents_address" value="{{ old('parents_address', $student->parents_address) }}">
                </div>
                <div class="form-group">
                    <label for="villa_number">Villa N°</label>
                    <input type="text" id="villa_number" name="villa_number" value="{{ old('villa_number', $student->villa_number) }}">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="responsible_name">Responsable</label>
                    <input type="text" id="responsible_name" name="responsible_name" value="{{ old('responsible_name', $student->responsible_name) }}">
                </div>
                <div class="form-group">
                    <label for="responsible_phone">Téléphone Responsable</label>
                    <input type="text" id="responsible_phone" name="responsible_phone" value="{{ old('responsible_phone', $student->responsible_phone) }}">
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <h3 class="section-title">Informations Administratives</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="entry_date">Date d'entrée <span style="color: #ef4444;">*</span></label>
                    <input type="date" id="entry_date" name="entry_date" value="{{ old('entry_date', $student->entry_date->format('Y-m-d')) }}" required>
                    @error('entry_date')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label for="exit_date">Date de sortie</label>
                    <input type="date" id="exit_date" name="exit_date" value="{{ old('exit_date', $student->exit_date ? $student->exit_date->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label for="status">Statut <span style="color: #ef4444;">*</span></label>
                    <select id="status" name="status" required>
                        <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                        <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Diplômé</option>
                        <option value="transferred" {{ old('status', $student->status) == 'transferred' ? 'selected' : '' }}>Transféré</option>
                    </select>
                    @error('status')<span class="error">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="exit_reason">Motif de sortie</label>
                <textarea id="exit_reason" name="exit_reason" rows="3">{{ old('exit_reason', $student->exit_reason) }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="observations">Observations</label>
                <textarea id="observations" name="observations" rows="3">{{ old('observations', $student->observations) }}</textarea>
            </div>
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.students.show', $student) }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<style>
.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e5e7eb;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    color: var(--primary);
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}
</style>
@endsection
