<?php declare(strict_types=1); 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AppearanceController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\Admin\ImportExportController;
use App\Http\Controllers\Admin\ReceiptController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/a-propos', function () {
    return view('about');
})->name('about');

Route::get('/programmes', function () {
    return view('programs');
})->name('programs');

Route::get('/admissions', function () {
    $preschoolLevels = \App\Models\Level::where('category', 'preschool')->where('is_active', true)->orderBy('id')->get();
    $elementaryLevels = \App\Models\Level::where('category', 'elementary')->where('is_active', true)->orderBy('id')->get();
    $collegeLevels = \App\Models\Level::where('category', 'college')->where('is_active', true)->orderBy('id')->get();
    return view('admissions', compact('preschoolLevels', 'elementaryLevels', 'collegeLevels'));
})->name('admissions');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Routes d'inscription
Route::get('/inscription', [RegistrationController::class, 'showForm'])->name('registration');
Route::post('/inscription', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/inscription/success/{id}', [RegistrationController::class, 'success'])->name('registration.success');

// Routes d'authentification admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Routes admin (protégées)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Routes élèves
    Route::resource('students', StudentController::class);
    
    // Routes paiements
    Route::resource('payments', PaymentController::class);
    Route::get('/payments/{payment}/receipt', [ReceiptController::class, 'generate'])->name('payments.receipt');
    Route::get('/payments/{payment}/receipt/view', [ReceiptController::class, 'view'])->name('payments.receipt.view');
    Route::get('/payments/{payment}/receipt/download', [ReceiptController::class, 'download'])->name('payments.receipt.download');
    
    // Routes niveaux
    Route::resource('levels', LevelController::class);
    
    // Routes médias
    Route::resource('media', MediaController::class)->except(['index']);
    
    // Routes paramètres
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
    // Routes Apparence (Hero, Couleurs)
    Route::get('/appearance/hero', [AppearanceController::class, 'hero'])->name('appearance.hero');
    Route::post('/appearance/hero', [AppearanceController::class, 'updateHero'])->name('appearance.hero.update');
    Route::get('/appearance/colors', [AppearanceController::class, 'colors'])->name('appearance.colors');
    Route::post('/appearance/colors', [AppearanceController::class, 'updateColors'])->name('appearance.colors.update');
    Route::get('/appearance/gallery', [AppearanceController::class, 'gallery'])->name('appearance.gallery');
    
    // Routes années scolaires
    Route::resource('school-years', SchoolYearController::class);
    
    // Routes import/export
    Route::get('/students/export', [ImportExportController::class, 'exportStudents'])->name('students.export');
    Route::get('/students/import', [ImportExportController::class, 'importStudentsForm'])->name('students.import');
    Route::post('/students/import', [ImportExportController::class, 'importStudents'])->name('students.import');
});
