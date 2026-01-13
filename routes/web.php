<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ruta principal - muestra la pantalla de selección o el dashboard
Route::get('/', function () {
    if (!auth()->check()) return view('welcome');
    
    // Si es un niño jugando, lo mandamos a la selección de aventura
    if (session('active_player_id')) {
        return redirect()->route('game.selection');
    }
    
    // Si es el guardián, lo mandamos al dashboard
    return redirect()->route('dashboard');
})->name('welcome');

// Rutas de autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/aventura', \App\Livewire\Game\PlayerLogin::class)->name('game.player-login');
});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/players', function () {
        return view('players.index');
    })->name('players.index');

    Route::get('/select-adventure', function () {
        return view('game.adventure-selection');
    })->name('game.selection');

    Route::get('/map', function () {
        return view('game.map');
    })->name('game.map');

    Route::get('/lesson/{world}/{level}', function ($world, $level) {
        return view('game.lesson', ['world' => $world, 'level' => $level]);
    })->name('game.lesson');

    Route::get('/challenge/{world}', function ($world) {
        return view('game.challenge', ['world' => $world]);
    })->name('game.challenge');

    Route::get('/speed-challenge/{world}', function ($world) {
        return view('game.speed-challenge', ['world' => $world]);
    })->name('game.speed-challenge');

    Route::get('/trophies', function () {
        return view('game.trophies');
    })->name('game.trophies');

    Route::get('/lessons', function () {
        return view('game.lessons');
    })->name('game.lessons');

    Route::get('/player/profile', function () {
        return view('game.profile');
    })->name('game.profile');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
