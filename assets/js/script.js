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

    // ========================================
    // 3D CARD TILT + GLARE - Desktop only
    // ========================================
    const isDesktop = window.matchMedia('(min-width: 1024px) and (hover: hover) and (pointer: fine)').matches;
    
    if (!isDesktop) {
        console.log("Tilt effect disabled on mobile/tablet");
        return;
    }

    console.log("Initializing juicy 3D card tilt...");

    const cards = document.querySelectorAll('.projects-figure');
    
    cards.forEach(card => {
        let isHovering = false;
        let currentX = 0;
        let currentY = 0;
        let targetX = 0;
        let targetY = 0;
        let rafId = null;
        
        // Smooth interpolation for buttery feel
        const lerp = (start, end, factor) => start + (end - start) * factor;
        
        const updateTilt = () => {
            if (!isHovering) {
                // Ease back to center when not hovering
                currentX = lerp(currentX, 0, 0.1);
                currentY = lerp(currentY, 0, 0.1);
                
                if (Math.abs(currentX) < 0.01 && Math.abs(currentY) < 0.01) {
                    currentX = 0;
                    currentY = 0;
                    card.style.setProperty('--tilt-x', '0deg');
                    card.style.setProperty('--tilt-y', '0deg');
                    card.style.setProperty('--shadow-x', '0px');
                    card.style.setProperty('--shadow-y', '15px');
                    card.style.setProperty('--glare-opacity', '0');
                    rafId = null;
                    return;
                }
            } else {
                // Smooth follow with spring-like feel
                currentX = lerp(currentX, targetX, 0.15);
                currentY = lerp(currentY, targetY, 0.15);
            }
            
            // Apply tilt (max 12 degrees for more drama)
            const tiltY = currentX * 12;
            const tiltX = currentY * -12;
            
            // Dynamic shadow moves opposite
            const shadowX = currentX * -20;
            const shadowY = 15 + (currentY * -12);
            
            // Glare position follows mouse
            const glareX = 50 + (currentX * 30);
            const glareY = 50 + (currentY * 30);
            
            card.style.setProperty('--tilt-x', `${tiltX}deg`);
            card.style.setProperty('--tilt-y', `${tiltY}deg`);
            card.style.setProperty('--shadow-x', `${shadowX}px`);
            card.style.setProperty('--shadow-y', `${shadowY}px`);
            card.style.setProperty('--glare-x', `${glareX}%`);
            card.style.setProperty('--glare-y', `${glareY}%`);
            
            rafId = requestAnimationFrame(updateTilt);
        };
        
        card.addEventListener('mouseenter', () => {
            isHovering = true;
            card.style.setProperty('--glare-opacity', '1');
            if (!rafId) {
                rafId = requestAnimationFrame(updateTilt);
            }
        });
        
        card.addEventListener('mousemove', (e) => {
            if (!isHovering) return;
            
            const rect = card.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            // Normalize to -1 to 1
            targetX = (e.clientX - centerX) / (rect.width / 2);
            targetY = (e.clientY - centerY) / (rect.height / 2);
            
            // Clamp
            targetX = Math.max(-1, Math.min(1, targetX));
            targetY = Math.max(-1, Math.min(1, targetY));
        });
        
        card.addEventListener('mouseleave', () => {
            isHovering = false;
            targetX = 0;
            targetY = 0;
            // Keep animation running to ease back
            if (!rafId) {
                rafId = requestAnimationFrame(updateTilt);
            }
        });
    });
    
    console.log(`Juicy tilt applied to ${cards.length} cards!`);
});