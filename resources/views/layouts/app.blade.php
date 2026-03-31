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
    <!-- <img src="{{ asset('icons/qr-code.svg') }}" alt="Scanner un QR Code"> -->
    {!! file_get_contents(public_path('icons/qr-code.svg')) !!}
</button>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var scanButton = document.getElementById('scanQRCodeButton');
        var cameraInput = document.getElementById('qrCameraInput');

        if (scanButton && cameraInput) {
            scanButton.addEventListener('click', function () {
                cameraInput.click();
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
