'use strict';

document.documentElement.classList.add('js-enabled');

document.addEventListener('DOMContentLoaded', () => {
    document.dispatchEvent(new CustomEvent('phpaml:ready'));
});

const liveReload = {
    version: null,
    interval: 1000,

    async check() {
        try {
            const response = await fetch('/_aml/live-reload', {
                cache: 'no-store',
                headers: { Accept: 'application/json' },
            });

            if (!response.ok) {
                return;
            }

            const state = await response.json();

            if (this.version !== null && this.version !== state.version) {
                window.location.reload();
                return;
            }

            this.version = state.version;
        } catch {
            // Le serveur peut être momentanément indisponible pendant un redémarrage.
        }
    },

    start() {
        this.check();
        window.setInterval(() => this.check(), this.interval);
    },
};

liveReload.start();
