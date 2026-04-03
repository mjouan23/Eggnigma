@extends('layouts.app')

@section('title', 'Règles du jeu - Eggnigma')
@section('body-class', 'rules-page')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/logo.png') }}" alt="Eggnigma" height="100">
    <h1 class="mt-2">Règles du jeu</h1>
</div>
<!-- Encart pour les organisateurs -->
<div class="accordion mb-4" id="accordionOrganizer">
  <div class="accordion-item card shadow-sm">
    <h2 class="accordion-header" id="headingOrganizer">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrganizer" aria-expanded="false" aria-controls="collapseOrganizer">
        <h5 class="h5">Pour l'organisateur</h5>
      </button>
    </h2>
    <div id="collapseOrganizer" class="accordion-collapse collapse" aria-labelledby="headingOrganizer" data-bs-parent="#accordionOrganizer">
      <div class="accordion-body card-body">
        <p>Entre le mot de passe pour accéder à l'organisation d'une chasse.</p>
        <div class="text-center mb-3 mx-3">
          <form id="organizer-access-form" class="mt-4" method="POST" action="{{ route('organizer.access') }}">
            @csrf
            <div class="mb-3">
              <label for="organizerPassword" class="form-label">Mot de passe organisateur</label>
              <input type="password" name="password" id="organizerPassword" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-secondary">Organiser une chasse</button>
            @if(session('organizer_error'))
              <div class="alert alert-danger mt-2">{{ session('organizer_error') }}</div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Encart des règles pour les participants -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h2 class="h5">Comment jouer ?</h2>
        <ul class="list-unstyled mt-3">
            <li class="mb-1"><strong>1.</strong> Rejoins la session à l'aide du code communiqué par l'organisateur.</li>
            <li class="mb-1"><strong>2.</strong> Trouve les œufs dissimulés un peu partout.</li>
            <li class="mb-1"><strong>3.</strong> Scanne le QR Code sur l'œuf pour afficher l'énigme.</li>
            <li class="mb-1"><strong>4.</strong> Réponds à un maximum d'énigmes avant la fin du compte à rebours.</li>
            <li class="mb-1"><strong>5.</strong> Si tu as le plus d'énigmes résolues à la fin du compte à rebours, tu remportes la partie !</li>
            <li class="mb-1"><strong>6.</strong> Tu peux également gagner en résolvant les 20 énigmes avant la fin du temps imparti !</li>
        </ul>

        <h2 class="h5 mt-2">Conseils</h2>
        <p>Les énigmes peuvent contenir des indices optionnels. Clique sur <strong>Afficher l'indice</strong> si tu en as besoin.</p>
        <p>Chaque énigme résolue te rapproche de la victoire, alors n'hésite pas à chercher d'autres œufs si tu bloques sur une énigme.</p>
        <p>
            Si tu souhaites revenir sur une énigme non résolue, pas de panique, tu peux le faire en appuyant sur
            <svg width="20px" height="20px" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 6L21 6.00078M8 12L21 12.0008M8 18L21 18.0007M3 6.5H4V5.5H3V6.5ZM3 12.5H4V11.5H3V12.5ZM3 18.5H4V17.5H3V18.5Z" stroke="#212529" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>.
        </p>
        <p>
            N'hésite pas consulter le compte à rebours à tout moment en appuyant sur
            <svg width="20px" height="20px" viewBox="-2 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-519.000000, -360.000000)" fill="#212529" fill-rule="evenodd">
                        <path d="M533,374.184 L533,369 C533,368.448 532.553,368 532,368 C531.447,368 531,368.448 531,369 L531,374.184 C529.838,374.597 529,375.695 529,377 C529,378.657 530.343,380 532,380 C533.657,380 535,378.657 535,377 C535,375.695 534.162,374.597 533,374.184 L533,374.184 Z M532,388 C525.925,388 521,383.075 521,377 C521,370.925 525.925,366 532,366 C538.075,366 543,370.925 543,377 C543,383.075 538.075,388 532,388 L532,388 Z M532.99,364.05 C532.991,364.032 533,364.018 533,364 L533,362 L537,362 C537.553,362 538,361.553 538,361 C538,360.447 537.553,360 537,360 L527,360 C526.447,360 526,360.447 526,361 C526,361.553 526.447,362 527,362 L531,362 L531,364 C531,364.018 531.009,364.032 531.01,364.05 C524.295,364.558 519,370.154 519,377 C519,384.18 524.82,390 532,390 C539.18,390 545,384.18 545,377 C545,370.154 539.705,364.558 532.99,364.05 L532.99,364.05 Z" id="timer" sketch:type="MSShapeGroup"></path>
                    </g>
                </g>
            </svg>.
        </p>
    </div>
    <div class="text-center mx-3">
        <form method="GET" action="{{ route('session.join') }}" class="mb-4">
            <div class="mb-3">
                <label for="session_key" class="form-label">Code pour rejoindre la chasse</label>
                <input type="text" name="session_key" id="session_key" class="form-control" maxlength="5" required placeholder="Ex : ABCDE">
            </div>
            <button type="submit" class="btn btn-secondary">Rejoindre la chasse !</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/util.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
                // Méthode générique d'affichage plein écran pour tous les messages
                function showFullscreenMessage(message, duration = 2000) {
                    const overlay = document.createElement('div');
                    overlay.className = 'fullscreen-message-overlay';
                    Object.assign(overlay.style, {
                        position: 'fixed',
                        top: '0',
                        left: '0',
                        width: '100vw',
                        height: '100vh',
                        background: 'rgba(0,0,0,0.95)',
                        color: '#fff',
                        display: 'flex',
                        alignItems: 'center',
                        justifyContent: 'center',
                        zIndex: '3000',
                        fontSize: '2.5rem',
                        fontWeight: 'bold',
                        textAlign: 'center',
                        padding: '2rem',
                        userSelect: 'none',
                        transition: 'opacity 0.3s',
                        opacity: '1',
                    });
                    overlay.textContent = message;
                    document.body.appendChild(overlay);
                    setTimeout(() => {
                        overlay.style.opacity = '0';
                        setTimeout(() => overlay.remove(), 300);
                    }, duration);
                }
        try {
            localStorage.setItem('eggnigmaRulesVisited', '1');
        } catch (error) {
            console.warn('Impossible d\'enregistrer la visite des règles', error);
        }

        var downloadBtn = document.getElementById('download-rules-btn');
        var passwordInput = document.getElementById('organizer-password');
        var feedback = document.getElementById('organizer-password-feedback');
        var correctPassword = '3gGn1gm4';

        if (downloadBtn && passwordInput) {
            downloadBtn.addEventListener('click', function () {
                if (passwordInput.value === correctPassword) {
                    feedback.classList.add('d-none');
                    var link = document.createElement('a');
                    link.href = '{{ asset("files/eggnigma-rules.pdf") }}';
                    link.setAttribute('download', 'eggnigma-rules.pdf');
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    feedback.classList.remove('d-none');
                }
            });
        }

        const joinForm = document.querySelector('form[action="{{ route('session.join') }}"]');
        if (joinForm) {
            joinForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const sessionKey = document.getElementById('session_key').value.trim().toUpperCase();
                if (!sessionKey) return;
                fetch(`/session/join?session_key=${sessionKey}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            showFullscreenMessage('Session introuvable.', 2000);
                            return;
                        }
                        // Écrase toujours la session précédente
                        localStorage.setItem('eggHuntSession', JSON.stringify(data));
                        window.location.href = '/';
                    })
                    .catch(() => showFullscreenMessage('Erreur lors de la recherche de la session.', 2000));
            });
        }
    });
</script>
@endpush