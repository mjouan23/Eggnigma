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
<div class="container my-4">
    @yield('content')
</div>
<input type="file" id="qrCameraInput" accept="image/*" capture="environment" style="display:none">
<button id="scanQRCodeButton" type="button" aria-label="Scanner un QR Code">
    {!! file_get_contents(public_path('icons/qr-code.svg')) !!}
</button>
<div id="qrScannerOverlay" class="qr-scanner-overlay" style="display:none;">
    <div class="qr-scanner-card">
        <button id="qrScannerClose" type="button" class="qr-scanner-close" aria-label="Fermer le scan">×</button>
        <video id="qrScannerVideo" autoplay playsinline muted></video>
        <div class="qr-scanner-footer">
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
            message.textContent = 'QR Code détecté, mais le contenu n’est pas valide.';
        }

        async function startScan() {
            overlay.style.display = 'flex';
            message.textContent = 'Recherche d’un QR code...';

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
                message.textContent = 'Appareil photo activé, mais le navigateur ne supporte pas le scan automatique. Prends une photo du QR code.';
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
