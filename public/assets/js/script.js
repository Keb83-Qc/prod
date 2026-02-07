/* assets/js/script.js - VERSION FINALE */

document.addEventListener("DOMContentLoaded", () => {

    // ==========================================
    // 1. GESTION DES CLICS MENU (Desktop)
    // ==========================================
    // Sur Desktop, le CSS gère l'ouverture au survol.
    // Ce script force le clic à suivre le lien au lieu d'ouvrir le menu.

    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            // Uniquement si écran large (Desktop > 992px)
            if (window.innerWidth >= 992) {
                const href = this.getAttribute('href');
                // Si le lien est valide (pas #), on y va
                if (href && href !== '#' && href !== 'javascript:void(0)') {
                    window.location.href = href;
                }
            }
        });
    });

    // ==========================================
    // 2. ANIMATION DES COMPTEURS (Stats)
    // ==========================================
    const statsSection = document.querySelector('#stats-section');
    if (statsSection) {
        const counters = document.querySelectorAll('.counter');
        const speed = 200;

        const animate = () => {
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        };

        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animate();
                observer.disconnect();
            }
        });
        observer.observe(statsSection);
    }

});