@extends('layouts.app')

@section('title', 'Liste des énigmes - Eggnigma')

@section('content')
<div class="text-center mb-4">
    <h1><img src="{{ asset('images/logo.png') }}" alt="Eggnigma" height="100" id="eggnigma-logo-home"></h1>
    <p class="lead">Trouvez les œufs et scannez le QR Code pour découvrir l'énigme.</p>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h5 mb-0">
                    <div class="ms-3">
                        <span class="eggCounter">
                            <span id="foundEggCount">0</span>/20
                        </span> œufs trouvés
                    </div>
                    <div class="ms-3">
                        <span class="solvedEggCounter">
                            <span id="solvedEggCount">0</span>/20
                        </span> énigmes résolues
                    </div>
                </h2>
                <!-- <small class="text-muted">Les liens sont enregistrés dans votre navigateur.</small> -->
            </div>
            <!-- <button id="clearFoundEggs" class="btn btn-outline-secondary btn-sm">Effacer la liste</button> -->
        </div>

        <div id="foundEggs" class="list-group"></div>
        <div id="noEggs" class="alert alert-info mt-3">Aucun œuf trouvé pour l'instant. Scannez un QR Code pour commencer.</div>
    </div>
</div>
<div id="quitSessionContainer" class="d-flex justify-content-end mt-4" style="display:none;">
    <button id="quitSessionBtn" class="btn btn-danger">Quitter la chasse</button>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/egg-hunt.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var logo = document.getElementById('eggnigma-logo-home');
        if (logo) {
            logo.style.cursor = 'pointer';
            logo.addEventListener('click', function(e) {
                e.preventDefault();
                showFullscreenMessage('Réponse à l\'énigme RDNOC : Cocotte', 2500);
            });
        }

        // Affiche le bouton Quitter la chasse seulement si une session est en cours
        var quitContainer = document.getElementById('quitSessionContainer');
        var quitBtn = document.getElementById('quitSessionBtn');
        if (localStorage.getItem('eggHuntSession')) {
            if (quitContainer) quitContainer.style.display = 'flex';
        } else {
            if (quitContainer) quitContainer.style.display = 'none';
        }
        if (quitBtn) {
            quitBtn.addEventListener('click', function() {
                if (confirm('Es-tu sûr de vouloir quitter la chasse ? Cette action effacera ta progression.')) {
                    localStorage.removeItem('eggHuntSession');
                    localStorage.removeItem('eggHuntSessionElapsed');
                    localStorage.removeItem('eggHuntFoundEggs');
                    window.location.reload();
                }
            });
        }
    });
    function updateSolvedEggCount(count) {
        const solvedEl = document.getElementById('solvedEggCount');
        if (solvedEl) {
            solvedEl.textContent = count;
        }
    }
    function countSolvedEggs() {
        const eggs = window.getFoundEggs ? window.getFoundEggs() : [];
        return eggs.filter(e => e.solved).length;
    }
    document.addEventListener('DOMContentLoaded', function () {
        initHomePage();
        updateSolvedEggCount(countSolvedEggs());
    });
</script>
@endpush
