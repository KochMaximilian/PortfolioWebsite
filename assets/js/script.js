document.addEventListener('DOMContentLoaded', () => {
    console.log("Script loaded! Checking for background elements...");

    const background1 = document.getElementById('background1');
    const background2 = document.getElementById('background2');

    if (!background1 || !background2) {
        console.error("Background elements not found! Check your HTML.");
        return;
    }

    console.log("Background elements found. Preloading background images...");

    // Preload the images using a new Image object
    const image = new Image();
    image.src = "/assets/img/pattern.png";  // Replace with the correct image path

    image.onload = () => {
        console.log("Background images loaded successfully. Applying animation...");

        // Apply animation class dynamically once the image is loaded
        background1.classList.add('animated-bg');
        background2.classList.add('animated-bg');

        console.log("Animation applied successfully.");
    };

    image.onerror = () => {
        console.error("Error loading background images.");
    };
});