@extends('layouts.app')

@section('title', 'Règles - Chasse aux œufs')

@section('content')
<div class="text-center">
    <img src="{{ asset('images/logo.png') }}" alt="Eggnigma" height="100">
    <h1 class="mt-2">Règles du jeu</h1>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h2 class="h5">Comment jouer ?</h2>
        <ul class="list-unstyled mt-3">
            <li class="mb-1"><strong>1.</strong> Trouve les œufs dans le jardin ou la maison.</li>
            <li class="mb-1"><strong>2.</strong> Scanne le QR Code sur l'œuf.</li>
            <li class="mb-1"><strong>3.</strong> Réponds à l'énigme affichée dans l'application.</li>
            <li class="mb-1"><strong>4.</strong> Si la réponse est correcte, l'énigme est marquée comme résolue.</li>
        </ul>

        <h2 class="h5 mt-2">Conseils</h2>
        <p>Les énigmes peuvent contenir des indices optionnels. Clique sur <strong>Afficher l'indice</strong> si tu en as besoin.</p>

        <h2 class="h5 mt-2">À noter</h2>
        <p>Les énigmes trouvées sont listées sur la page d'accueil. Seules les énigmes résolues seront marquées comme <span class="badge bg-success">Résolu</span>.</p>
    </div>
    <div class="text-center mb-3">
        <a href="{{ route('home') }}" class="btn btn-secondary btn-lg">C'est parti !</a>
    </div>
</div>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h2 class="h5">Pour l'organisateur</h2>
        <p>Entre le mot de passe pour télécharger le fichier des règles organisateur.</p>
        <div class="mb-3">
            <label for="organizer-password" class="form-label">Mot de passe</label>
            <input id="organizer-password" type="password" class="form-control" placeholder="Mot de passe organisateur">
            <div id="organizer-password-feedback" class="form-text text-danger d-none">Mot de passe incorrect.</div>
        </div>
        <button id="download-rules-btn" type="button" class="btn btn-secondary">Télécharger le PDF</button>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
    });
</script>
@endpush