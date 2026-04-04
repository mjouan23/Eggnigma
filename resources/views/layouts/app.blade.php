<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Eggnigma')</title>
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="theme-color" content="#F6D36B">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="@yield('body-class')">
<script>
    (function() {
        var RULES_KEY = 'eggnigmaRulesVisited';
        var rulesPath = '/rules';

        try {
            if (!localStorage.getItem(RULES_KEY) && window.location.pathname !== rulesPath) {
                window.location.href = rulesPath;
            }
        } catch (error) {
            console.warn('LocalStorage indisponible', error);
        }
    })();
</script>
@php
    $isRulesPage = request()->routeIs('rules');
@endphp
<div class="content container my-4">
    @yield('content')
</div>
@if(!$isRulesPage)
<nav class="bottom-nav" aria-label="Navigation inférieure">
    <div class="bottom-nav-group">
        <button type="button" class="bottom-nav-icon" aria-label="Compte à rebours de la session">
            <a href="{{ route('session.countdown') }}" class="bottom-nav-icon" aria-label="Compte à rebours de la session">
                <svg width="800px" height="800px" viewBox="-2 0 30 30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-519.000000, -360.000000)" fill="#FFF" fill-rule="evenodd">
                            <path d="M533,374.184 L533,369 C533,368.448 532.553,368 532,368 C531.447,368 531,368.448 531,369 L531,374.184 C529.838,374.597 529,375.695 529,377 C529,378.657 530.343,380 532,380 C533.657,380 535,378.657 535,377 C535,375.695 534.162,374.597 533,374.184 L533,374.184 Z M532,388 C525.925,388 521,383.075 521,377 C521,370.925 525.925,366 532,366 C538.075,366 543,370.925 543,377 C543,383.075 538.075,388 532,388 L532,388 Z M532.99,364.05 C532.991,364.032 533,364.018 533,364 L533,362 L537,362 C537.553,362 538,361.553 538,361 C538,360.447 537.553,360 537,360 L527,360 C526.447,360 526,360.447 526,361 C526,361.553 526.447,362 527,362 L531,362 L531,364 C531,364.018 531.009,364.032 531.01,364.05 C524.295,364.558 519,370.154 519,377 C519,384.18 524.82,390 532,390 C539.18,390 545,384.18 545,377 C545,370.154 539.705,364.558 532.99,364.05 L532.99,364.05 Z" id="timer" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </a>
        </button>
    </div>
    <div class="bottom-nav-group">
        <button type="button" class="bottom-nav-icon" aria-label="Liste des énigmes">
            <a href="{{ route('home') }}" class="bottom-nav-icon" aria-label="Liste des énigmes">
                <svg width="800px" height="800px" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 6L21 6.00078M8 12L21 12.0008M8 18L21 18.0007M3 6.5H4V5.5H3V6.5ZM3 12.5H4V11.5H3V12.5ZM3 18.5H4V17.5H3V18.5Z" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </button>
    </div>
</nav>
<input type="file" id="qrCameraInput" accept="image/*" capture="environment" style="display:none">
<button id="scanQRCodeButton" type="button" aria-label="Scanner un QR Code">
    {!! file_get_contents(public_path('icons/qr-code.svg')) !!}
</button>
<div id="qrScannerOverlay" class="qr-scanner-overlay" style="display:none;">
    <div class="qr-scanner-card">
        <button id="qrScannerClose" type="button" class="qr-scanner-close" aria-label="Fermer le scan">×</button>
        <video id="qrScannerVideo" autoplay playsinline muted></video>
        <div class="qr-scanner-footer text-center">
            <span id="qrScannerMessage">Positionne le QR code dans la fenêtre.</span>
        </div>
    </div>
</div>
@endif
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/egg-hunt.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
                // Désactive le bouton scan et affiche un message si la chasse est terminée
                try {
                    var scanBtn = document.getElementById('scanQRCodeButton');
                    var session = localStorage.getItem('eggHuntSession');
                    var elapsed = localStorage.getItem('eggHuntSessionElapsed');;
                    if (!session || elapsed === '1') {
                        scanBtn.disabled = true;
                    } else {
                        scanBtn.disabled = false;
                        if (scanMsg) scanMsg.remove();
                    }
                } catch (e) {}
        var scanButton = document.getElementById('scanQRCodeButton');
        var cameraInput = document.getElementById('qrCameraInput');
        var overlay = document.getElementById('qrScannerOverlay');
        var video = document.getElementById('qrScannerVideo');
        var closeButton = document.getElementById('qrScannerClose');
        var message = document.getElementById('qrScannerMessage');
        var stream = null;
        var detector = null;
        var scanTimer = null;

        function stopScanner() {
            if (scanTimer) {
                clearInterval(scanTimer);
                scanTimer = null;
            }
            if (stream) {
                stream.getTracks().forEach(function (track) {
                    track.stop();
                });
                stream = null;
            }
            video.srcObject = null;
        }

        function navigateToScannedValue(value) {
            if (!value) {
                return;
            }
            if (value.startsWith('http://') || value.startsWith('https://')) {
                window.location.href = value;
                return;
            }
            var codeMatch = value.match(/([A-Za-z0-9_-]{5,})$/);
            if (codeMatch) {
                window.location.href = '/enigme/' + codeMatch[1];
                return;
            }
            message.textContent = 'QR Code détecté, mais le contenu n\'est pas valide.';
        }

        async function startScan() {
            overlay.style.display = 'flex';
            message.textContent = 'Recherche d\'un QR code...';

            if (window.BarcodeDetector) {
                try {
                    detector = new BarcodeDetector({ formats: ['qr_code'] });
                } catch (error) {
                    detector = null;
                }
            }

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                cameraInput.click();
                return;
            }

            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
                await video.play();
            } catch (error) {
                cameraInput.click();
                return;
            }

            if (!detector) {
                message.textContent = 'Le navigateur ne supporte pas le scan automatique.';
                return;
            }

            scanTimer = setInterval(async function () {
                try {
                    var results = await detector.detect(video);
                    if (results && results.length > 0) {
                        stopScanner();
                        overlay.style.display = 'none';
                        navigateToScannedValue(results[0].rawValue);
                    }
                } catch (error) {
                    console.warn('QR scan failed', error);
                }
            }, 500);
        }

        if (scanButton) {
            scanButton.addEventListener('click', function () {
                startScan();
            });
        }

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                stopScanner();
                overlay.style.display = 'none';
            });
        }

        if (cameraInput) {
            cameraInput.addEventListener('change', function () {
                if (cameraInput.files && cameraInput.files.length > 0) {
                    message.textContent = 'Photo prise. Recharge la page pour continuer.';
                }
            });
        }
    });

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('{{ asset('sw.js') }}')
                .then(function (registration) {
                    console.log('ServiceWorker registered with scope:', registration.scope);

                    if (registration.waiting) {
                        registration.waiting.postMessage({ type: 'SKIP_WAITING' });
                    }

                    registration.addEventListener('updatefound', function () {
                        var newWorker = registration.installing;
                        if (newWorker) {
                            newWorker.addEventListener('statechange', function () {
                                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    newWorker.postMessage({ type: 'SKIP_WAITING' });
                                }
                            });
                        }
                    });
                })
                .catch(function (error) {
                    console.warn('ServiceWorker registration failed:', error);
                });

            navigator.serviceWorker.addEventListener('controllerchange', function () {
                window.location.reload();
            });
        });
    }
</script>
@stack('scripts')
</body>
</html>
