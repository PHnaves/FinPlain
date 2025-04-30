import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // Adiciona a classe 'loaded' ao body quando a página terminar de carregar
    window.addEventListener('load', () => {
        document.body.classList.add('loaded');
    });
});
