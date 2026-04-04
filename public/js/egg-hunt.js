// Force le rechargement sur tous les onglets à la fin de la session
window.addEventListener('storage', function(e) {
    if (e.key === 'eggHuntForceReload') {
        window.location.reload();
    }
});
// Redirection automatique vers /rules si aucune session n'est en cours
if (
    !localStorage.getItem('eggHuntSession') &&
    window.location.pathname !== '/rules' &&
    window.location.pathname !== '/organizer/show'
) {
    window.location.href = '/rules';
}
// Synchronisation en temps réel du blocage de session sur tous les onglets
window.addEventListener('storage', function(e) {
    if (e.key === 'eggHuntSessionElapsed' && e.newValue === '1') {
        // Désactive tous les formulaires de réponse
        document.querySelectorAll('#answer-form').forEach(form => {
            form.querySelectorAll('input, button').forEach(el => el.disabled = true);
            let msg = form.parentNode.querySelector('.alert.alert-warning.mt-3');
            if (!msg) {
                msg = document.createElement('div');
                msg.className = 'alert alert-warning mt-3';
                msg.textContent = 'La chasse est terminée, tu ne peux plus répondre à cette énigme.';
                form.parentNode.insertBefore(msg, form.nextSibling);
            }
        });
        // Désactive le bouton scan QR si présent
        var scanBtn = document.getElementById('scanQRCodeButton');
        if (scanBtn) {
            scanBtn.disabled = true;
            var scanMsg = document.getElementById('scanEndMessage');
            if (!scanMsg) {
                scanMsg = document.createElement('div');
                scanMsg.id = 'scanEndMessage';
                scanMsg.className = 'alert alert-warning text-center mt-2';
                scanMsg.textContent = 'La chasse est terminée, tu ne peux plus scanner de nouveaux œufs.';
                scanBtn.parentNode.insertBefore(scanMsg, scanBtn.nextSibling);
            }
        }
        // Affiche un message plein écran
        if (typeof showFullscreenMessage === 'function') {
            showFullscreenMessage('La chasse est terminée !', 2000);
        }
    }
});
function getFoundEggs() {
    const stored = localStorage.getItem('eggHuntFoundEggs');
    if (!stored) {
        return [];
    }

    try {
        return JSON.parse(stored) || [];
    } catch (error) {
        console.warn('Impossible de lire les œufs trouvés', error);
        return [];
    }
}

function saveFoundEggs(eggs) {
    localStorage.setItem('eggHuntFoundEggs', JSON.stringify(eggs));
}

function isSessionElapsed() {
    // Si aucune session, ou session terminée, on bloque
    const session = localStorage.getItem('eggHuntSession');
    if (!session) return true;
    return localStorage.getItem('eggHuntSessionElapsed') === '1';
}

function addFoundEgg(egg) {
    if (isSessionElapsed()) {
        showFullscreenMessage('La chasse est terminée !', 2000);
        return;
    }

    if (!egg || !egg.code) {
        return;
    }

    const normalizedCode = egg.code.toUpperCase();
    const items = getFoundEggs();
    const existingIndex = items.findIndex(item => item.code === normalizedCode);
    const solved = egg.solved === true;
    const now = new Date().toISOString();

    const newEgg = {
        code: normalizedCode,
        title: egg.title || 'Énigme trouvée',
        url: egg.url || '/enigme/' + normalizedCode,
        found_at: existingIndex >= 0 ? items[existingIndex].found_at : now,
        solved: solved || (existingIndex >= 0 && items[existingIndex].solved === true),
    };

    if (existingIndex >= 0) {
        items[existingIndex] = newEgg;
    } else {
        items.unshift(newEgg);
    }

    saveFoundEggs(items);
}

function markEggSolved(code) {
    if (isSessionElapsed()) {
        showFullscreenMessage('La chasse est terminée !', 2000);
        return;
    }

    if (!code) {
        return;
    }

    const normalizedCode = code.toUpperCase();
    const items = getFoundEggs();
    const updated = items.map(item => {
        if (item.code === normalizedCode) {
            return {
                ...item,
                solved: true
            };
        }
        return item;
    });

    saveFoundEggs(updated);
}

function updateFoundEggCount(count) {
    const countEl = document.getElementById('foundEggCount');
    if (countEl) {
        countEl.textContent = count;
    }
}

function renderFoundEggs() {
    const list = document.getElementById('foundEggs');
    const noEggs = document.getElementById('noEggs');
    if (!list || !noEggs) {
        return;
    }

    const eggs = getFoundEggs();
    updateFoundEggCount(eggs.length);
    list.innerHTML = '';

    if (eggs.length === 0) {
        noEggs.style.display = 'block';
        return;
    }

    noEggs.style.display = 'none';

    eggs.forEach(egg => {
        const item = document.createElement('a');
        item.href = egg.url;
        item.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
        if (egg.solved) {
            item.classList.add('list-group-item-success');
        }

        const statusBadge = egg.solved
            ? '<span class="badge bg-success rounded-pill">Résolu</span>'
            : '';

        item.innerHTML = `<span><strong>${egg.title}</strong><br><small>${egg.code}</small></span><span class="d-flex align-items-center gap-2">${statusBadge}<span class="badge bg-primary rounded-pill">Voir</span></span>`;
        list.appendChild(item);
    });
}

function clearFoundEggs() {
    localStorage.removeItem('eggHuntFoundEggs');
    renderFoundEggs();
}

function initHomePage() {
    renderFoundEggs();
    const clearButton = document.getElementById('clearFoundEggs');
    if (clearButton) {
        clearButton.addEventListener('click', function () {
            clearFoundEggs();
        });
    }
}

window.addFoundEgg = addFoundEgg;
window.initHomePage = initHomePage;
