import '../css/app.css';
import.meta.glob(['../images/**']);

document.addEventListener('DOMContentLoaded', () => {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const selector = anchor.getAttribute('href');

            if (!selector) {
                return;
            }

            const target = document.querySelector(selector);

            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            }
        });
    });

    // Header background opacity on scroll
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            header?.classList.add('bg-white/95');
            header?.classList.remove('bg-white/80');
        } else {
            header?.classList.add('bg-white/80');
            header?.classList.remove('bg-white/95');
        }
    });
});
