<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Chasse aux œufs')</title>
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="theme-color" content="#F6D36B">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
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
<div class="content container my-4">
    @yield('content')
</div>
<nav class="bottom-nav" aria-label="Navigation inférieure">
    <div class="bottom-nav-group">
        <button type="button" class="bottom-nav-icon" aria-label="Accueil">
            <a href="{{ route('rules') }}" class="bottom-nav-icon" aria-label="Liste des énigmes">
                <svg width="800px" height="800px" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 10C9 9.40666 9.17595 8.82664 9.50559 8.33329C9.83524 7.83994 10.3038 7.45543 10.852 7.22836C11.4001 7.0013 12.0033 6.94189 12.5853 7.05765C13.1672 7.1734 13.7018 7.45912 14.1213 7.87868C14.5409 8.29824 14.8266 8.83279 14.9424 9.41473C15.0581 9.99667 14.9987 10.5999 14.7716 11.1481C14.5446 11.6962 14.1601 12.1648 13.6667 12.4944C13.1734 12.8241 12.5933 13 12 13V14M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="17" r="1" fill="#FFF"/>
                </svg>
            </a>
        </button>
    </div>
    <div class="bottom-nav-group">
        <button type="button" class="bottom-nav-icon" aria-label="Infos">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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
