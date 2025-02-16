document.addEventListener('DOMContentLoaded', () => {
    console.log("Script loaded! Checking for background elements...");

    const background1 = document.getElementById('background1');
    const background2 = document.getElementById('background2');

    if (!background1 || !background2) {
        console.error("Background elements not found! Check your HTML.");
        return;
    }

    console.log("Background elements found. Preloading background images...");

    const image = new Image();
    image.src = "/assets/img/pattern.png";

    image.onload = () => {
        console.log("Background images loaded successfully. Applying animation...");

        background1.classList.add('animated-bg');
        background2.classList.add('animated-bg');

        console.log("Animation applied successfully.");
    };

    image.onerror = () => {
        console.error("Error loading background images.");
    };

    let clickCount = 0;

    document.getElementById('wobbleElement').addEventListener('click', function () {
        // Check if the animation is already running
        if (this.classList.contains('disabled')) {
            return;
        }

        this.classList.add('disabled');
        this.classList.add('wobble-hor-top');

        clickCount++;

        setTimeout(() => {
            this.classList.remove('wobble-hor-top');
            this.classList.remove('disabled');
        }, 800); // time of the animation

        if (clickCount >= 12) {
            window.location.href = 'https://youtu.be/dQw4w9WgXcQ?si=FFFqTRqJe3iTSmw3';
            clickCount = 0;
        }
    });
});
