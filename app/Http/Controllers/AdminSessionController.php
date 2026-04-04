<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HuntSession;
use Illuminate\Support\Str;

class AdminSessionController extends Controller
{
    public function show()
    {
        $sessionCode = session('created_session_code');
        return view('organizer.show', compact('sessionCode'));
    }

    public function create(Request $request)
    {
        error_log('Création d\'une nouvelle session de chasse aux œufs');
        // Générer un code unique de 5 lettres
        do {
            $code = strtoupper(Str::random(5));
        } while (HuntSession::where('session_key', $code)->exists());

        $session = HuntSession::create([
            'session_key' => $code,
            'started_at' => now(),
            // 'ends_at' => now()->addHour(),
            'ends_at' => now()->addMinutes(2), // 2 minutes pour test
        ]);
        session(['created_session_code' => $code]);
        return redirect()->route('organizer.show')->with('created_session_code', $code);
    }
}
