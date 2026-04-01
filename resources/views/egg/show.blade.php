@extends('layouts.app')

@section('title', 'Énigme - ' . $egg->title)

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h1 class="h3">{{ $egg->title }}</h1>
        <p>QR Code trouvé : <strong>{{ $egg->code }}</strong></p>
    </div>
    <div class="card-body">
        @if ($egg->image)
            <div class="my-4 text-center">
                <img src="{{ asset($egg->image) }}" alt="{{ $egg->title }}" class="img-fluid rounded shadow-sm" />
            </div>
        @endif
        <h2 class="h5">Énigme</h2>
        <p class="fs-5">{{ $egg->clue }}</p>
        @if ($egg->hint)
            <div class="mt-4">
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#hintCollapse" aria-expanded="false" aria-controls="hintCollapse">
                    Afficher l'indice
                </button>
                <div class="collapse mt-3" id="hintCollapse">
                    <div class="card card-body bg-light border">
                        {{ $egg->hint }}
                    </div>
                </div>
            </div>
        @endif
        <div class="mt-4">
            <h3 class="h6">Réponse</h3>
            <form id="answer-form" class="row g-2">
                <div class="col-12">
                    <input type="text" id="answer-input" class="form-control" placeholder="Tape ta réponse ici" autocomplete="off" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Vérifier</button>
                </div>
            </form>
            <div id="answer-feedback" class="mt-3"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/egg-hunt.js') }}"></script>
@php
    $foundEggData = [
        'code' => $egg->code,
        'title' => $egg->title,
        'url' => route('egg.show', ['code' => $egg->code]),
    ];
    $expectedAnswer = $egg->answer;
@endphp
<script>
    document.addEventListener('DOMContentLoaded', function () {
        addFoundEgg(@json($foundEggData));

        const answerForm = document.getElementById('answer-form');
        const answerInput = document.getElementById('answer-input');
        const answerFeedback = document.getElementById('answer-feedback');
        const expectedAnswer = @json($expectedAnswer);

        function cleanString(value) {
            return value
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[^\w\s]/g, '')
                .trim()
                .toLowerCase();
        }

        function showOverlay(imageUrl) {
            const overlay = document.createElement('div');
            overlay.className = 'answer-overlay';
            Object.assign(overlay.style, {
                position: 'fixed',
                top: '0',
                left: '0',
                width: '100%',
                height: '100%',
                backgroundColor: 'rgba(0, 0, 0, 0.9)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                zIndex: '2000',
                padding: '0',
                margin: '0'
            });

            const img = document.createElement('img');
            img.src = imageUrl;
            img.alt = 'Réponse';
            Object.assign(img.style, {
                maxWidth: '100%',
                maxHeight: '100%',
                width: '100%',
                height: '100%',
                objectFit: 'contain'
            });

            overlay.appendChild(img);
            document.body.appendChild(overlay);

            return overlay;
        }

        function showGoodAnswerOverlay() {
            const overlay = showOverlay(@json(asset('images/good-answer.png')));
            setTimeout(function () {
                overlay.remove();
                window.location.href = @json(url('/'));
            }, 2000);
        }

        function showWrongAnswerOverlay() {
            const overlay = showOverlay(@json(asset('images/wrong-answer.png')));
            setTimeout(function () {
                overlay.remove();
            }, 2000);
        }

        answerForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const userAnswer = answerInput.value || '';
            const normalizedUserAnswer = cleanString(userAnswer);
            const normalizedExpectedAnswer = cleanString(expectedAnswer);

            if (!normalizedUserAnswer) {
                answerFeedback.innerHTML = '<div class="alert alert-warning">Merci de saisir une réponse.</div>';
                return;
            }

            if (normalizedUserAnswer === normalizedExpectedAnswer) {
                answerFeedback.innerHTML = '';
                if (typeof markEggSolved === 'function') {
                    markEggSolved(@json($egg->code));
                }
                showGoodAnswerOverlay();
            } else {
                answerFeedback.innerHTML = '';
                showWrongAnswerOverlay();
            }
        });
    });
</script>
@endpush
