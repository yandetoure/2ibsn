import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileNav = document.getElementById('mobile-nav');
    const menuSpans = menuToggle?.querySelectorAll('span');

    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', () => {
            const isOpen = mobileNav.classList.contains('translate-y-0');
            
            if (isOpen) {
                mobileNav.classList.remove('translate-y-0');
                mobileNav.classList.add('translate-y-[-100%]');
                document.body.style.overflow = '';
                // Animate burger icon back
                if (menuSpans) {
                    menuSpans[0].classList.remove('rotate-45', 'translate-y-[8px]');
                    menuSpans[1].classList.remove('opacity-0');
                    menuSpans[2].classList.remove('-rotate-45', '-translate-y-[8px]');
                }
            } else {
                mobileNav.classList.remove('translate-y-[-100%]');
                mobileNav.classList.add('translate-y-0');
                document.body.style.overflow = 'hidden';
                // Animate burger icon to X
                if (menuSpans) {
                    menuSpans[0].classList.add('rotate-45', 'translate-y-[8px]');
                    menuSpans[1].classList.add('opacity-0');
                    menuSpans[2].classList.add('-rotate-45', '-translate-y-[8px]');
                }
            }
        });
    }

    // Hero Carousel Logic
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');

    if (slides.length > 0) {
        let currentSlide = 0;
        const totalSlides = slides.length;
        const intervalTime = 5000;
        let slideInterval;

        const goToSlide = (index) => {
            slides[currentSlide].classList.remove('active');
            if (indicators[currentSlide]) {
                indicators[currentSlide].classList.remove('active', '!bg-secondary');
                indicators[currentSlide].classList.add('bg-white/50');
            }

            currentSlide = index;

            slides[currentSlide].classList.add('active');
            if (indicators[currentSlide]) {
                indicators[currentSlide].classList.add('active', '!bg-secondary');
                indicators[currentSlide].classList.remove('bg-white/50');
            }
        };

        const nextSlide = () => {
            goToSlide((currentSlide + 1) % totalSlides);
        };

        slideInterval = setInterval(nextSlide, intervalTime);

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                clearInterval(slideInterval);
                goToSlide(index);
                slideInterval = setInterval(nextSlide, intervalTime);
            });
        });
    }

    // Scroll Animation Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });

    // Sticky Header Effect
    const header = document.querySelector('.main-header');
    const handleScroll = () => {
        if (window.scrollY > 50) {
            header?.classList.add('scrolled', 'h-[70px]');
            header?.querySelector('.container')?.classList.add('h-[70px]');
            header?.querySelector('.container')?.classList.remove('h-[90px]');
        } else {
            header?.classList.remove('scrolled', 'h-[70px]');
            header?.querySelector('.container')?.classList.remove('h-[70px]');
            header?.querySelector('.container')?.classList.add('h-[90px]');
        }
    };

    window.addEventListener('scroll', handleScroll);
    handleScroll(); 
});
