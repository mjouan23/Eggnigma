<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EggController;
use App\Http\Controllers\AdminSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\HuntSession;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/rules', 'rules')->name('rules');
Route::get('/enigme/{code}', [EggController::class, 'show'])->name('egg.show');

Route::post('/organizer/access', function (Request $request) {
    if ($request->password === '3gGn1gm4') {
        session(['organizer_access' => true]);
        return redirect('/organizer/show');
    }
    return back()->with('organizer_error', 'Mot de passe incorrect.');
})->name('organizer.access');

Route::get('/organizer/show', [AdminSessionController::class, 'show'])->name('organizer.show');

Route::post('/admin-session/create', [AdminSessionController::class, 'create'])->name('admin.session.create');

Route::get('/session/join', function (\Illuminate\Http\Request $request) {
    $sessionKey = strtoupper($request->query('session_key'));
    $session = HuntSession::where('session_key', $sessionKey)->first();
    if (!$session) {
        return response()->json(['error' => 'Session introuvable'], 404);
    }
    return response()->json([
        'session_key' => $session->session_key,
        'started_at' => $session->started_at ? $session->started_at->toIso8601String() : null,
        'ends_at' => $session->ends_at ? $session->ends_at->toIso8601String() : null,
    ]);
})->name('session.join');

Route::view('/session/countdown', 'session.countdown')->name('session.countdown');
