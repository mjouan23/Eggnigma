@extends('layouts.app')
@section('content')
<div class="container py-4 text-center">
    <h1 class="mb-4">Espace Organisateur</h1>
    <p class="mb-3">Avant de commencer, veuillez télécharger le PDF ci-dessous et prendre connaissance de toutes les informations importantes pour l'organisation de la chasse aux œufs.</p>
    <a id="download-rules-btn" class="btn btn-secondary mb-4" href="{{ asset('files/eggnigma-rules.pdf') }}" download>Télécharger les règles</a>
    <p class="mb-3">Si toute la préparation est terminée et que les participants sont prêts, vous pouvez lancer une chasse en cliquant sur le bouton ci-dessous.</p>
    <form method="POST" action="{{ route('admin.session.create') }}">
        @csrf
        <button type="submit" class="btn btn-success">Lancer la chasse !</button>
    </form>
    @if(session('created_session_code') || isset($sessionCode))
        <div class="alert alert-info mt-4">
            <strong>Session créée !</strong><br>
            Code à communiquer aux participants : <span class="fw-bold">{{ session('created_session_code', $sessionCode ?? '') }}</span>
        </div>
    @endif
</div>
@endsection
