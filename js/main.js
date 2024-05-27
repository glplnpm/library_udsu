document.addEventListener('DOMContentLoaded', () => {
    const slider = document.querySelector('.events-wrapper');
    const events = document.querySelectorAll('.event');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    let currentIndex = 0;

    function showEvent(index) {
        const offset = -index * 100;
        slider.style.transform = `translateX(${offset}%)`;
    }

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = events.length - 1;
        }
        showEvent(currentIndex);
    });

    nextButton.addEventListener('click', () => {
        if (currentIndex < events.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        showEvent(currentIndex);
    });

    showEvent(currentIndex);
});
