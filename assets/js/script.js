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
    image.src = "/assets/img/pattern.png"; 

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



    document.getElementById('wobbleElement').addEventListener('click', function() {
        // Check if the animation is already running
        if (this.classList.contains('disabled')) {
            return; // Stop if animation is already in progress
        }
    
        // Disable clicking by adding a "disabled" class
        this.classList.add('disabled');
    
        // Add the animation class on click
        this.classList.add('wobble-hor-top');
    
        // After animation duration (800ms), remove animation class and enable clicking again
        setTimeout(() => {
            this.classList.remove('wobble-hor-top');
            this.classList.remove('disabled');
        }, 800); // Matches the duration of the animation (0.8s)
    });

});