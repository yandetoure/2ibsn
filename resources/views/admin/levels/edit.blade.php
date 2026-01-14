@extends('admin.layout')

@section('title', 'Modifier le Niveau - 2IBSN')
@section('page-title', 'Modifier le Niveau')

@section('content')
<div class="card">
    <h2 style="margin-bottom: 1.5rem;">Modifier {{ $level->name }}</h2>
    
    <form action="{{ route('admin.levels.update', $level) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom <span style="color: #ef4444;">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $level->name) }}" required>
                @error('name')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="code">Code <span style="color: #ef4444;">*</span></label>
                <input type="text" id="code" name="code" value="{{ old('code', $level->code) }}" required>
                @error('code')<span class="error">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="monthly_fee">Mensualité (FCFA) <span style="color: #ef4444;">*</span></label>
                <input type="number" id="monthly_fee" name="monthly_fee" value="{{ old('monthly_fee', $level->monthly_fee) }}" min="0" step="0.01" required>
                @error('monthly_fee')<span class="error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1.75rem;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $level->is_active) ? 'checked' : '' }}>
                    <span>Actif</span>
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ old('description', $level->description) }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.levels.index') }}" class="btn btn-secondary">Annuler</a>
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
