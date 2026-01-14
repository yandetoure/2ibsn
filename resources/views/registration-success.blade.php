@extends('layouts.app')

@section('title', 'Inscription Réussie - 2IBSN')

@section('content')
<div class="page-header">
    <div class="container">
        <h1>Inscription Réussie</h1>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="success-message">
            <div class="success-icon">✓</div>
            <h2>Félicitations !</h2>
            <p>L'inscription de <strong>{{ $student->full_name }}</strong> a été enregistrée avec succès.</p>
            
            <div class="student-info">
                <h3>Informations de l'élève</h3>
                <ul>
                    <li><strong>Nom complet:</strong> {{ $student->full_name }}</li>
                    <li><strong>Niveau:</strong> {{ $student->level->name ?? 'Non défini' }}</li>
                    <li><strong>Date d'entrée:</strong> {{ $student->entry_date->format('d/m/Y') }}</li>
                    <li><strong>Statut:</strong> {{ ucfirst($student->status) }}</li>
                </ul>
            </div>

            <div class="actions">
                <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
                <a href="{{ route('registration') }}" class="btn btn-secondary">Nouvelle inscription</a>
            </div>
        </div>
    </div>
</section>

<style>
.success-message {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
    background: white;
    padding: 3rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.success-icon {
    width: 80px;
    height: 80px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 1.5rem;
}

.success-message h2 {
    color: var(--primary);
    margin-bottom: 1rem;
}

.student-info {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 4px;
    margin: 2rem 0;
    text-align: left;
}

.student-info h3 {
    margin-bottom: 1rem;
    color: var(--text-dark);
}

.student-info ul {
    list-style: none;
    padding: 0;
}

.student-info li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #e5e7eb;
}

.student-info li:last-child {
    border-bottom: none;
}

.actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}
</style>
@endsection
