@extends('layouts.app')

@section('title', 'Compte à rebours - Eggnigma')
@section('body-class', 'countdown-page')

@section('content')
<div id="countdown-container" class="d-flex flex-column justify-content-center align-items-center vh-100 bg-dark text-light" style="min-height:100vh;">
    <h1 id="session-name" class="mb-4 text-center"></h1>
    <img src="{{ asset('images/logo.png') }}" alt="Eggnigma" class="mb-4" height="230">
    <div id="countdown" class="display-1 fw-bold mb-4"></div>
    <div id="session-infos-start" class="mb-2"></div>
    <div id="session-infos-end" class="mb-2"></div>
    <div id="elapsed-overlay" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.95);justify-content:center;align-items:center;">
        <img src="{{ asset('images/elapsed-time.png') }}" alt="Temps écoulé" style="max-width:90vw;max-height:90vh;">
    </div>
</div>
@endsection

@push('scripts')
<script>
function pad(n) { return n < 10 ? '0' + n : n; }
function formatCountdown(ms) {
    if (ms <= 0) return '00:00:00';
    const totalSec = Math.floor(ms / 1000);
    const h = Math.floor(totalSec / 3600);
    const m = Math.floor((totalSec % 3600) / 60);
    const s = totalSec % 60;
    return pad(h) + ':' + pad(m) + ':' + pad(s);
}

function blockGameInteractions() {
    // Désactive le scan et la saisie sur toutes les pages
    localStorage.setItem('eggHuntSessionElapsed', '1');
}

document.addEventListener('DOMContentLoaded', function () {
    const session = JSON.parse(localStorage.getItem('eggHuntSession') || '{}');
    const name = session.session_key || 'Aucune session rejointe';
    const startedAt = session.started_at ? new Date(session.started_at) : null;
    const endsAt = session.ends_at ? new Date(session.ends_at) : null;
    document.getElementById('session-name').textContent = name;
    if (!startedAt || !endsAt) {
        document.getElementById('countdown').textContent = 'Session non démarrée';
        document.getElementById('session-infos').textContent = '';
        return;
    }
    function updateCountdown() {
        const now = new Date();
        const ms = endsAt - now;
        document.getElementById('countdown').textContent = formatCountdown(ms);
        if (ms <= 0) {
            document.getElementById('countdown').textContent = 'Terminé';
            clearInterval(timer);
            blockGameInteractions();
            // Affiche l'overlay
            const overlay = document.getElementById('elapsed-overlay');
            overlay.style.display = 'flex';
            setTimeout(function() {
                overlay.style.display = 'none';
                window.location.href = '/';
            }, 2000);
        }
    }
    document.getElementById('session-infos-start').textContent = 'Début de la chasse : ' + startedAt.toLocaleString();
    document.getElementById('session-infos-end').textContent = 'Fin de la chasse : ' + endsAt.toLocaleString();
    updateCountdown();
    const timer = setInterval(updateCountdown, 1000);
});
</script>
@endpush
