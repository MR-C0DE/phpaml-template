'use strict';

document.documentElement.classList.add('js-enabled');

document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('[data-language]');
    const translated = document.querySelectorAll('[data-en][data-fr]');

    const setLanguage = (language) => {
        document.documentElement.lang = language;
        translated.forEach((element) => {
            element.textContent = element.dataset[language];
        });
        buttons.forEach((button) => {
            button.classList.toggle('active', button.dataset.language === language);
        });
        window.localStorage.setItem('phpaml-language', language);
    };

    buttons.forEach((button) => {
        button.addEventListener('click', () => setLanguage(button.dataset.language));
    });

    const savedLanguage = window.localStorage.getItem('phpaml-language');
    setLanguage(savedLanguage === 'fr' ? 'fr' : 'en');
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
