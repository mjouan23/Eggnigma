// Fonction utilitaire générique d'affichage plein écran pour tous les messages
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

// Pour usage global
window.showFullscreenMessage = showFullscreenMessage;
