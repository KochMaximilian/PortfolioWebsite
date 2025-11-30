document.addEventListener('DOMContentLoaded', () => {
    console.log("Script loaded!");

  
    // WOBBLE EASTER EGG

    let clickCount = 0;

    const wobbleElement = document.getElementById('wobbleElement');
    
    if (wobbleElement) {
        wobbleElement.addEventListener('click', function () {
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
    }

    // BALATRO CARD HOVER EFFECT

    
    // Set to false to disable Balatro effect
    const ENABLE_BALATRO_EFFECT = true;
    
    if (!ENABLE_BALATRO_EFFECT) {
        console.log("Balatro effect is DISABLED");
        return;
    }

    console.log("Initializing Balatro card hover effects...");

    /**
     * Balatro Card Hover Effect
     * Recreates the Balatro card hover with:
     * - Idle floating animation
     * - Mouse-following with rotation
     * - 3D perspective bulge effect
     */
    class BaltroCardHover {
        constructor(element) {
            this.card = element;
            this.isHovering = false;
            this.time = 0;
            this.mousePos = { x: 0, y: 0 };
            this.cardPos = { x: 0, y: 0 };
            this.velocity = { x: 0, y: 0 };
            this.rotation = 0;
            
            this.init();
        }
        
        init() {
            // Get card position
            this.updateCardPosition();
            
            // Start idle animation loop
            this.animate();
            
            // Mouse events
            this.card.addEventListener('mouseenter', () => this.onMouseEnter());
            this.card.addEventListener('mouseleave', () => this.onMouseLeave());
            this.card.addEventListener('mousemove', (e) => this.onMouseMove(e));
            
            // Update card position on resize
            window.addEventListener('resize', () => this.updateCardPosition());
        }
        
        updateCardPosition() {
            const rect = this.card.getBoundingClientRect();
            this.cardPos = {
                x: rect.left + rect.width / 2,
                y: rect.top + rect.height / 2
            };
        }
        
        onMouseEnter() {
            this.isHovering = true;
            this.card.style.setProperty('--hovering', '1');
        }
        
        onMouseLeave() {
            this.isHovering = false;
            this.card.style.setProperty('--hovering', '0');
            this.card.style.setProperty('--mouse-x', '0');
            this.card.style.setProperty('--mouse-y', '0');
            this.card.style.setProperty('--rotation', '0deg');
        }
        
        onMouseMove(e) {
            if (!this.isHovering) return;
            
            // Calculate mouse offset from card center
            const offsetX = e.clientX - this.cardPos.x;
            const offsetY = e.clientY - this.cardPos.y;
            
            // Normalize to -1 to 1 range
            const rect = this.card.getBoundingClientRect();
            const normalizedX = (offsetX / rect.width) * 2;
            const normalizedY = (offsetY / rect.height) * 2;
            
            // Calculate velocity (for rotation)
            this.velocity.x = (e.movementX || 0) * 0.5;
            this.velocity.y = (e.movementY || 0) * 0.5;
            
            // Update CSS custom properties for 3D transforms
            this.card.style.setProperty('--mouse-x', normalizedX);
            this.card.style.setProperty('--mouse-y', normalizedY);
            
            // Rotation based on velocity (damped)
            this.rotation += this.velocity.x * 0.05;
            this.rotation *= 0.8; // Damping
            this.card.style.setProperty('--rotation', `${this.rotation}deg`);
        }
        
        animate() {
            this.time += 0.016; // ~60fps
            
            if (!this.isHovering) {
                // Idle floating animation
                const floatX = Math.cos(this.time * 2 + 1.321) * 0.4;
                const floatY = Math.sin(this.time * 2 + 1.231) * 0.4;
                const wobble = Math.sin(this.time * 2 + 1.321) * 0.15;
                
                this.card.style.setProperty('--float-x', `${floatX}px`);
                this.card.style.setProperty('--float-y', `${floatY}px`);
                this.card.style.setProperty('--wobble', `${wobble}deg`);
            }
            
            requestAnimationFrame(() => this.animate());
        }
    }

    // Auto-initialize all project figures with Balatro effect
    const projectFigures = document.querySelectorAll('.projects-figure');
    
    if (projectFigures.length > 0) {
        console.log(`Found ${projectFigures.length} project cards. Applying Balatro hover...`);
        projectFigures.forEach(card => new BaltroCardHover(card));
        console.log("Balatro hover effects initialized successfully! 🎮");
    } else {
        console.log("No .projects-figure elements found. Balatro hover not initialized.");
    }
});