@extends('admin.layout')

@section('title', 'Modifier l\'Année Scolaire - 2IBSN')
@section('page-title', 'Modifier l\'Année Scolaire')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Modifier {{ $schoolYear->name }}</h2>
    
    <form action="{{ route('admin.school-years.update', $schoolYear) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom <span style="color: #ef4444;">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $schoolYear->name) }}" required>
                @error('name')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="code">Code <span style="color: #ef4444;">*</span></label>
                <input type="text" id="code" name="code" value="{{ old('code', $schoolYear->code) }}" required>
                @error('code')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Date de début <span style="color: #ef4444;">*</span></label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $schoolYear->start_date->format('Y-m-d')) }}" required>
                @error('start_date')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="end_date">Date de fin <span style="color: #ef4444;">*</span></label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $schoolYear->end_date->format('Y-m-d')) }}" required>
                @error('end_date')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" rows="3">{{ old('notes', $schoolYear->notes) }}</textarea>
            @error('notes')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', $schoolYear->is_current) ? 'checked' : '' }}>
                <span>Marquer comme année courante</span>
            </label>
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.school-years.index') }}" class="btn btn-secondary">Annuler</a>
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
