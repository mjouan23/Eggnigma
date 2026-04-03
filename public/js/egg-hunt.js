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
    return localStorage.getItem('eggHuntSessionElapsed') === '1';
}

function addFoundEgg(egg) {
    if (isSessionElapsed()) {
        // alert('La chasse est terminée, tu ne peux plus scanner de nouveaux œufs.');
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
        // alert('La chasse est terminée, tu ne peux plus répondre aux énigmes.');
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
