document.addEventListener('DOMContentLoaded', () => {
    console.log("Script loaded!");

    // Wobble easter egg
    let clickCount = 0;
    const wobbleElement = document.getElementById('wobbleElement');
    
    if (wobbleElement) {
        wobbleElement.addEventListener('click', function () {
            if (this.classList.contains('disabled')) {
                return;
            }

            this.classList.add('disabled');
            this.classList.add('wobble-hor-top');
            clickCount++;

            setTimeout(() => {
                this.classList.remove('wobble-hor-top');
                this.classList.remove('disabled');
            }, 800);

            if (clickCount >= 12) {
                window.location.href = 'https://youtu.be/dQw4w9WgXcQ?si=FFFqTRqJe3iTSmw3';
                clickCount = 0;
            }
        });
    }

    // Balatro card hover effect
    const ENABLE_BALATRO_EFFECT = true;
    const isDesktop = window.matchMedia('(min-width: 1024px) and (hover: hover) and (pointer: fine)').matches;
    
    if (!ENABLE_BALATRO_EFFECT) {
        console.log("Balatro effect is DISABLED");
        return;
    }
    
    if (!isDesktop) {
        console.log("Balatro effect DISABLED on mobile/tablet devices");
        return;
    }

    console.log("Initializing Balatro card hover effects...");

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
            this.updateCardPosition();
            this.animate();
            
            this.card.addEventListener('mouseenter', () => this.onMouseEnter());
            this.card.addEventListener('mouseleave', () => this.onMouseLeave());
            this.card.addEventListener('mousemove', (e) => this.onMouseMove(e));
            
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
            this.rotation = 0;
            this.velocity = { x: 0, y: 0 };
            
            this.card.style.setProperty('--hovering', '0');
            this.card.style.setProperty('--mouse-x', '0');
            this.card.style.setProperty('--mouse-y', '0');
            this.card.style.setProperty('--rotation', '0deg');
        }
        
        onMouseMove(e) {
            if (!this.isHovering) return;
            
            const offsetX = e.clientX - this.cardPos.x;
            const offsetY = e.clientY - this.cardPos.y;
            
            const rect = this.card.getBoundingClientRect();
            let normalizedX = (offsetX / rect.width) * 2;
            let normalizedY = (offsetY / rect.height) * 2;
            
            // Clamp to prevent extreme values during fast movements
            normalizedX = Math.max(-1.5, Math.min(1.5, normalizedX));
            normalizedY = Math.max(-1.5, Math.min(1.5, normalizedY));
            
            this.velocity.x = (e.movementX || 0) * 0.5;
            this.velocity.y = (e.movementY || 0) * 0.5;
            
            this.card.style.setProperty('--mouse-x', normalizedX);
            this.card.style.setProperty('--mouse-y', normalizedY);
            
            this.rotation += this.velocity.x * 0.05;
            this.rotation *= 0.8;
            
            // Clamp rotation to prevent extreme angles
            this.rotation = Math.max(-15, Math.min(15, this.rotation));
            
            this.card.style.setProperty('--rotation', `${this.rotation}deg`);
        }
        
        animate() {
            this.time += 0.016;
            
            if (!this.isHovering) {
                const floatX = Math.cos(this.time * 2 + 1.321) * 0.4;
                const floatY = Math.sin(this.time * 2 + 1.231) * 0.4;
                
                this.card.style.setProperty('--float-x', `${floatX}px`);
                this.card.style.setProperty('--float-y', `${floatY}px`);
                this.card.style.setProperty('--wobble', '0deg');
            }
            
            requestAnimationFrame(() => this.animate());
        }
    }

    const projectFigures = document.querySelectorAll('.projects-figure');
    
    if (projectFigures.length > 0) {
        console.log(`Found ${projectFigures.length} project cards. Applying Balatro hover...`);
        projectFigures.forEach(card => new BaltroCardHover(card));
        console.log("Balatro hover effects initialized successfully!");
    } else {
        console.log("No .projects-figure elements found. Balatro hover not initialized.");
    }
});