<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\CongeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

// Auth
Route::middleware(['auth'])->group(function () {
    Route::get('/agent/conges', [CongeController::class, 'vueComplete'])->name('agent.conges');
    Route::post('/agent/conges', [CongeController::class, 'store'])->name('agent.conges.store');
});
// GET → Pour afficher les demandes (historique ou tableau index)
Route::get('/agent/conges', [CongeController::class, 'index'])->name('agent.conges');


// ✅ Debug (auth required)
Route::middleware(['auth'])->group(function () {
    Route::get('/check-gate', function () {
        $user = Auth::user();
        Log::debug('Gate Check', [
            'role' => $user->role,
            'isAdmin' => Gate::allows('isAdmin')
        ]);
        return response()->json([
            'role_db' => $user->role,
            'isAdmin' => Gate::allows('isAdmin')
        ]);
    });

    Route::get('/debug-role', fn() => [
        'role_db' => Auth::user()->role,
        'isAdmin' => Gate::allows('isAdmin'),
        'session_role' => session()->all()
    ]);

    Route::get('/test-role', fn() => [
        'connecté' => Auth::check(),
        'id' => Auth::id(),
        'email' => Auth::user()->email,
        'role' => Auth::user()->role,
        'gate_isAdmin' => Gate::allows('isAdmin'),
    ]);
});

// ✅ Agent routes
Route::middleware(['auth'])->group(function () {
    // Dashboard congés (résumé)
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');

    // Historique des demandes
    Route::get('/agent/conges/historique', [CongeController::class, 'index'])->name('agent.conges.historique');

    // Formulaire nouvelle demande
    Route::get('/agent/conges/create', fn() => view('agent.demande'))->name('agent.conges.create');
    Route::post('/agent/conges', [CongeController::class, 'store'])->name('agent.conges.store');
});


// ✅ Dashboards
Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'dashboards.admin')->name('admin.dashboard');
    Route::view('/rh/dashboard', 'dashboards.rh')->name('rh.dashboard');
    Route::view('/directeur/dashboard', 'dashboards.directeur')->name('directeur.dashboard');
    Route::view('/dpaf/dashboard', 'dashboards.dpaf')->name('dpaf.dashboard');
});

// ✅ Congé workflow (CDC)
Route::middleware(['auth'])->group(function () {
    // Directeur
    Route::get('/directeur/conges', [CongeController::class, 'indexDirecteur'])->name('directeur.conges');
    Route::post('/directeur/conges/{id}/transmettre', [CongeController::class, 'transmettreAuDpaf'])->name('directeur.conges.transmettre');
    Route::post('/directeur/conges/{id}/refuser', [CongeController::class, 'refuserParDirecteur'])->name('directeur.conges.refuser');

    // DPAF
    Route::get('/dpaf/conges', [CongeController::class, 'indexDpaf'])->name('dpaf.conges');
    Route::post('/dpaf/conges/{id}/vers-rh', [CongeController::class, 'envoyerAuRh'])->name('dpaf.conges.vers_rh');
    Route::post('/dpaf/conges/{id}/finaliser', [CongeController::class, 'finaliserParDpaf'])->name('dpaf.conges.finaliser');

    // RH
    Route::get('/rh/conges', [CongeController::class, 'indexRh'])->name('rh.conges');
    Route::post('/rh/conges/{id}/retour', [CongeController::class, 'retourRh'])->name('rh.conges.retour');
});

// ✅ Test DB
Route::get('/check-db', fn() => DB::select("SHOW TABLES"));
Route::get('/check-db-name', fn() => DB::select("SELECT DATABASE() as name"));

// ✅ Default
Route::get('/dashboard', fn() => "Bienvenue sur le Dashboard !")->middleware('auth');
