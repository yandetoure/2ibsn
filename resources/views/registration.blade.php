@extends('layouts.app')

@section('title', 'Formulaire d\'Inscription - 2IBSN')

@section('content')
<div class="page-header py-12 bg-primary text-white text-center">
    <div class="container">
        <h1 class="text-3xl font-serif font-bold">FICHE D'INSCRIPTION</h1>
        <p class="uppercase tracking-widest text-sm opacity-80 mt-2">INSTITUT INTERNATIONAL BAYE BARHAMOU</p>
    </div>
</div>

<section class="py-16 bg-[#f7f5f0]">
    <div class="container">
        <form action="{{ route('registration.store') }}" method="POST" class="registration-form max-w-4xl mx-auto bg-white p-8 rounded-3xl shadow-lg">
            @csrf

            <!-- Type d'inscription -->
            <div class="form-section mb-12 pb-8 border-b border-gray-100">
                <h2 class="text-xl font-serif font-bold mb-6 text-primary flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-sm">1</span>
                    Type d'Inscription
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <label class="p-4 border rounded-2xl cursor-pointer hover:border-primary transition-all flex items-center gap-3">
                        <input type="checkbox" name="is_boarding" value="1" {{ old('is_boarding') ? 'checked' : '' }}>
                        <span class="text-sm font-semibold">Internat</span>
                    </label>
                    <label class="p-4 border rounded-2xl cursor-pointer hover:border-primary transition-all flex items-center gap-3">
                        <input type="checkbox" name="is_day_student" value="1" {{ old('is_day_student') ? 'checked' : '' }}>
                        <span class="text-sm font-semibold">Externat</span>
                    </label>
                    <label class="p-4 border rounded-2xl cursor-pointer hover:border-primary transition-all flex items-center gap-3">
                        <input type="checkbox" name="is_half_pension" value="1" {{ old('is_half_pension') ? 'checked' : '' }} id="is_half_pension">
                        <span class="text-sm font-semibold">Demi-Pension</span>
                    </label>
                    <label class="p-4 border rounded-2xl cursor-pointer hover:border-primary transition-all flex items-center gap-3">
                        <input type="checkbox" name="is_holiday" value="1" {{ old('is_holiday') ? 'checked' : '' }}>
                        <span class="text-sm font-semibold">Vacance</span>
                    </label>
                </div>
            </div>

            <!-- Informations de l'élève -->
            <div class="form-section mb-12 pb-8 border-b border-gray-100">
                <h2 class="text-xl font-serif font-bold mb-6 text-primary flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-sm">2</span>
                    Informations de l'Élève
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="block text-sm font-semibold mb-2">Sexe <span class="text-red-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="M" {{ old('gender') == 'M' ? 'checked' : '' }} required>
                                <span>Garçon (M)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="gender" value="F" {{ old('gender') == 'F' ? 'checked' : '' }}>
                                <span>Fille (F)</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="level_id" class="block text-sm font-semibold mb-2">Niveau de l'élève <span class="text-red-500">*</span></label>
                        <select id="level_id" name="level_id" required class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-primary/20">
                            <option value="">Sélectionner un niveau</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}" 
                                    data-reg="{{ $level->registration_fee }}" 
                                    data-month="{{ $level->monthly_fee }}"
                                    data-reg-dp="{{ $level->half_pension_registration_fee }}"
                                    data-month-dp="{{ $level->half_pension_monthly_fee }}"
                                    {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="form-group">
                        <label for="first_name" class="block text-sm font-semibold mb-2">Prénom <span class="text-red-500">*</span></label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="block text-sm font-semibold mb-2">Nom <span class="text-red-500">*</span></label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required class="w-full p-3 border rounded-xl">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="form-group">
                        <label for="birth_date" class="block text-sm font-semibold mb-2">Date de naissance <span class="text-red-500">*</span></label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" required class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label for="birth_place" class="block text-sm font-semibold mb-2">Lieu de naissance <span class="text-red-500">*</span></label>
                        <input type="text" id="birth_place" name="birth_place" value="{{ old('birth_place') }}" required class="w-full p-3 border rounded-xl">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="form-group">
                        <label for="nationality" class="block text-sm font-semibold mb-2">Nationalité <span class="text-red-500">*</span></label>
                        <input type="text" id="nationality" name="nationality" value="{{ old('nationality', 'Sénégalaise') }}" required class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label class="block text-sm font-semibold mb-2">Langue parlée <span class="text-red-500">*</span></label>
                        <select name="spoken_language" id="spoken_language" class="w-full p-3 border rounded-xl">
                            <option value="Wolof" {{ old('spoken_language') == 'Wolof' ? 'selected' : '' }}>Wolof</option>
                            <option value="Poular" {{ old('spoken_language') == 'Poular' ? 'selected' : '' }}>Poular</option>
                            <option value="Sérère" {{ old('spoken_language') == 'Sérère' ? 'selected' : '' }}>Sérère</option>
                            <option value="Autres" {{ old('spoken_language') == 'Autres' ? 'selected' : '' }}>Autres</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Informations parentales -->
            <div class="form-section mb-12 pb-8 border-b border-gray-100">
                <h2 class="text-xl font-serif font-bold mb-6 text-primary flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-sm">3</span>
                    Informations Parentales
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="father_name" class="block text-sm font-semibold mb-2">Prénom et Nom du Père</label>
                        <input type="text" id="father_name" name="father_name" value="{{ old('father_name') }}" class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label for="father_phone" class="block text-sm font-semibold mb-2">Tél Père</label>
                        <input type="text" id="father_phone" name="father_phone" value="{{ old('father_phone') }}" class="w-full p-3 border rounded-xl">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="form-group">
                        <label for="mother_name" class="block text-sm font-semibold mb-2">Prénom et Nom de la Mère</label>
                        <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name') }}" class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label for="mother_phone" class="block text-sm font-semibold mb-2">Tél Mère</label>
                        <input type="text" id="mother_phone" name="mother_phone" value="{{ old('mother_phone') }}" class="w-full p-3 border rounded-xl">
                    </div>
                </div>

                <div class="form-group mt-6">
                    <label for="parents_address" class="block text-sm font-semibold mb-2">Adresse / Villa N°</label>
                    <input type="text" id="parents_address" name="parents_address" value="{{ old('parents_address') }}" class="w-full p-3 border rounded-xl" placeholder="Ex: Liberté 6, Villa 123">
                </div>
            </div>

            <!-- Informations administratives -->
            <div class="form-section mb-12">
                <h2 class="text-xl font-serif font-bold mb-6 text-primary flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-sm">4</span>
                    Paiement & Inscription
                </h2>

                <div id="fee-summary" class="bg-primary/5 p-6 rounded-2xl mb-8 hidden">
                    <h3 class="font-bold text-primary mb-4 text-sm uppercase">Récapitulatif des frais estimés</h3>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm">Frais d'inscription :</span>
                        <span id="reg-amount" class="font-bold">0 F</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm">Mensualité :</span>
                        <span id="month-amount" class="font-bold">0 F</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="entry_date" class="block text-sm font-semibold mb-2">Date d'entrée <span class="text-red-500">*</span></label>
                        <input type="date" id="entry_date" name="entry_date" value="{{ old('entry_date', date('Y-m-d')) }}" required class="w-full p-3 border rounded-xl">
                    </div>
                    <div class="form-group">
                        <label for="first_monthly_paid" class="block text-sm font-semibold mb-2">Montant versé à l'inscription (FCFA)</label>
                        <input type="number" id="first_monthly_paid" name="first_monthly_paid" value="{{ old('first_monthly_paid') }}" class="w-full p-3 border rounded-xl" placeholder="Ex: 50000">
                    </div>
                </div>

                <div class="form-group mt-6">
                    <label class="block text-sm font-semibold mb-2">Inclure la 1ère mensualité dans ce montant ?</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="first_monthly_included" value="1" {{ old('first_monthly_included', '1') == '1' ? 'checked' : '' }}>
                            <span>Oui</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="first_monthly_included" value="0" {{ old('first_monthly_included', '1') == '0' ? 'checked' : '' }}>
                            <span>Non</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12">
                <button type="submit" class="bg-primary text-white px-10 py-4 rounded-full font-bold hover:bg-primary-dark transition-all shadow-lg">
                    Confirmer l'Inscription
                </button>
                <a href="{{ route('admissions') }}" class="text-center px-10 py-4 rounded-full font-bold border border-gray-200 hover:bg-gray-50 transition-all">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const levelSelect = document.getElementById('level_id');
    const isHalfPension = document.getElementById('is_half_pension');
    const feeSummary = document.getElementById('fee-summary');
    const regAmount = document.getElementById('reg-amount');
    const monthAmount = document.getElementById('month-amount');

    function updateFees() {
        const selected = levelSelect.options[levelSelect.selectedIndex];
        if (!selected || !selected.value) {
            feeSummary.classList.add('hidden');
            return;
        }

        feeSummary.classList.remove('hidden');
        const isDP = isHalfPension.checked;
        
        const reg = isDP ? selected.dataset.regDp : selected.dataset.reg;
        const month = isDP ? selected.dataset.monthDp : selected.dataset.month;

        regAmount.textContent = new Intl.NumberFormat('fr-FR').format(reg) + ' F';
        monthAmount.textContent = new Intl.NumberFormat('fr-FR').format(month) + ' F';
    }

    levelSelect.addEventListener('change', updateFees);
    isHalfPension.addEventListener('change', updateFees);

    // Trigger on load if there's an old value
    if (levelSelect.value) updateFees();
});
</script>
@endsection
