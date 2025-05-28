<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\DirecteurDashboardController;
use App\Http\Controllers\DpafDashboardController;
use App\Http\Controllers\RhDashboardController;
use App\Http\Controllers\CongeController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Debug Routes (Only for Dev)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/check-gate', function () {
        return response()->json([
            'role_db' => Auth::user()->role,
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

/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
    Route::get('/agent/conges', [CongeController::class, 'index'])->name('agent.conges');
    Route::get('/agent/conges/historique', [CongeController::class, 'historique'])->name('agent.conges.historique');
    Route::get('/agent/conges/create', fn() => view('agent.demande'))->name('agent.conges.create');
    Route::post('/agent/conges', [CongeController::class, 'store'])->name('agent.conges.store');
});

/*
|--------------------------------------------------------------------------
| Directeur Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/directeur/dashboard', fn() => view('dashboards.directeur'))->name('directeur.dashboard');
    Route::get('/directeur/conges', [DirecteurDashboardController::class, 'index'])->name('directeur.conges');
    Route::post('/directeur/conges/{id}/transmettre', [CongeController::class, 'transmettreAuDpaf'])->name('directeur.conges.transmettre');
    Route::post('/directeur/conges/{id}/refuser', [CongeController::class, 'refuserParDirecteur'])->name('directeur.conges.refuser');
});

/*
|--------------------------------------------------------------------------
| DPAF Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dpaf/dashboard', fn() => view('dashboards.dpaf'))->name('dpaf.dashboard');
    Route::get('/dpaf/conges', [DpafDashboardController::class, 'index'])->name('dpaf.conges');

    Route::post('/dpaf/conges/{id}/vers-rh', [CongeController::class, 'envoyerAuRh'])->name('dpaf.conges.vers_rh');
    Route::post('/dpaf/conges/{id}/finaliser', [CongeController::class, 'finaliserParDpaf'])->name('dpaf.conges.finaliser');
});

/*
|--------------------------------------------------------------------------
| RH Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/rh/dashboard', fn() => view('dashboards.rh'))->name('rh.dashboard');
    Route::get('/rh/conges', [RhDashboardController::class, 'index'])->name('rh.conges');
    Route::post('/rh/conges/{id}/retour', [CongeController::class, 'retourRh'])->name('rh.conges.retour');
});

/*
|--------------------------------------------------------------------------
| Dev Tools
|--------------------------------------------------------------------------
*/
Route::get('/check-db', fn() => DB::select("SHOW TABLES"));
Route::get('/check-db-name', fn() => DB::select("SELECT DATABASE() as name"));

/*
|--------------------------------------------------------------------------
| Default Fallback
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', fn() => "Bienvenue sur le Dashboard !")->middleware('auth');
