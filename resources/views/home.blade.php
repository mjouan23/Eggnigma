@extends('layouts.app')

@section('title', 'Accueil - Chasse aux œufs')

@section('content')
<div class="text-center mb-4">
    <h1><img src="{{ asset('images/logo.png') }}" alt="Eggnigma" height="150"></h1>
    <p class="lead">Trouvez les œufs et scannez le QR Code pour découvrir l'énigme.</p>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h2 class="h5 mb-0">Œufs trouvés</h2>
                <!-- <small class="text-muted">Les liens sont enregistrés dans votre navigateur.</small> -->
            </div>
            <!-- <button id="clearFoundEggs" class="btn btn-outline-secondary btn-sm">Effacer la liste</button> -->
        </div>

        <div id="foundEggs" class="list-group"></div>
        <div id="noEggs" class="alert alert-info mt-3">Aucun œuf trouvé pour l'instant. Scannez un QR Code pour commencer.</div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/egg-hunt.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initHomePage();
    });
</script>
@endpush
