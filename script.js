document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.testimonials-slider');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth + 30; // Include margin
    const totalCards = cards.length;
    const visibleCards = 3; // Number of cards visible at once
    const maxIndex = totalCards - visibleCards;

    // Clone first and last cards for infinite loop effect
    const firstClone = cards[0].cloneNode(true);
    const lastClone = cards[totalCards - 1].cloneNode(true);
    slider.appendChild(firstClone);
    slider.insertBefore(lastClone, cards[0]);

    // Update slider position
    const updateSlider = () => {
        slider.style.transition = 'transform 0.5s ease-in-out';
        slider.style.transform = `translateX(-${(currentIndex + 1) * cardWidth}px)`;
    };

    // Move to next slide
    const moveNext = () => {
        if (currentIndex >= maxIndex) {
            currentIndex = 0;
            slider.style.transition = 'none';
            slider.style.transform = `translateX(-${cardWidth}px)`;
            setTimeout(() => {
                slider.style.transition = 'transform 0.5s ease-in-out';
                updateSlider();
            }, 50);
        } else {
            currentIndex++;
            updateSlider();
        }
    };

    // Move to previous slide
    const movePrev = () => {
        if (currentIndex <= 0) {
            currentIndex = maxIndex;
            slider.style.transition = 'none';
            slider.style.transform = `translateX(-${(maxIndex + 1) * cardWidth}px)`;
            setTimeout(() => {
                slider.style.transition = 'transform 0.5s ease-in-out';
                updateSlider();
            }, 50);
        } else {
            currentIndex--;
            updateSlider();
        }
    };

    // Auto-slide every 5 seconds
    let autoSlide = setInterval(moveNext, 5000);

    // Pause on hover
    slider.parentElement.addEventListener('mouseenter', () => clearInterval(autoSlide));
    slider.parentElement.addEventListener('mouseleave', () => autoSlide = setInterval(moveNext, 5000));

    // Button controls
    nextBtn.addEventListener('click', () => {
        clearInterval(autoSlide);
        moveNext();
        autoSlide = setInterval(moveNext, 5000);
    });

    prevBtn.addEventListener('click', () => {
        clearInterval(autoSlide);
        movePrev();
        autoSlide = setInterval(moveNext, 5000);
    });

    // Initial position
    slider.style.transform = `translateX(-${cardWidth}px)`;
});