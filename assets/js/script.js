document.addEventListener('DOMContentLoaded', () => {

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


    // 3D CARD TILT + GLARE + HOLO - Desktop only

    const isDesktop = window.matchMedia('(min-width: 1024px) and (hover: hover) and (pointer: fine)').matches;

    // Math helpers from pokemon-cards-css Math.js
    const round = (value, precision = 3) => parseFloat(value.toFixed(precision));
    const clamp = (value, min = 0, max = 1) => Math.min(Math.max(value, min), max);
    const adjust = (value, fromMin, fromMax, toMin, toMax) => {
        return round(toMin + (toMax - toMin) * (value - fromMin) / (fromMax - fromMin));
    };
    const lerp = (start, end, factor) => start + (end - start) * factor;

    const cards = document.querySelectorAll('.projects-figure');

    if (isDesktop) cards.forEach(card => {
        let isHovering = false;
        let currentX = 0;
        let currentY = 0;
        let targetX = 0;
        let targetY = 0;
        let currentScale = 1;
        let targetScale = 1;
        let currentGlare = 0;
        let targetGlare = 0;
        let rafId = null;

        // Lerp speeds - fast in, slow out
        const lerpTiltIn = 0.15;
        const lerpTiltOut = 0.045;
        const lerpScaleIn = 0.12;
        const lerpScaleOut = 0.04;
        
        const updateTilt = () => {
            const tiltLerp = isHovering ? lerpTiltIn : lerpTiltOut;
            const scaleLerp = isHovering ? lerpScaleIn : lerpScaleOut;
            
            // Smooth tilt
            currentX = lerp(currentX, targetX, tiltLerp);
            currentY = lerp(currentY, targetY, tiltLerp);
            
            // Smooth scale
            currentScale = lerp(currentScale, targetScale, scaleLerp);
            
            // Smooth glare
            currentGlare = lerp(currentGlare, targetGlare, scaleLerp);
            
            // Check if close enough to stop
            const tiltDone = Math.abs(currentX - targetX) < 0.001 && Math.abs(currentY - targetY) < 0.001;
            const scaleDone = Math.abs(currentScale - targetScale) < 0.001;
            
            if (!isHovering && tiltDone && scaleDone) {
                currentX = 0;
                currentY = 0;
                currentScale = 1;
                currentGlare = 0;
                card.style.setProperty('--tilt-x', '0deg');
                card.style.setProperty('--tilt-y', '0deg');
                card.style.setProperty('--shadow-x', '0px');
                card.style.setProperty('--shadow-y', '15px');
                card.style.setProperty('--glare-opacity', '0');
                card.style.setProperty('--card-scale', '1');
                // Reset holo properties
                card.style.setProperty('--card-opacity', '0');
                card.style.setProperty('--pointer-x', '50%');
                card.style.setProperty('--pointer-y', '50%');
                card.style.setProperty('--background-x', '50%');
                card.style.setProperty('--background-y', '50%');
                card.style.setProperty('--pointer-from-center', '0');
                card.style.setProperty('--pointer-from-top', '0.5');
                card.style.setProperty('--pointer-from-left', '0.5');
                rafId = null;
                return;
            }
            
            // Apply tilt (max 12 degrees)
            const tiltY = currentX * 12;
            const tiltX = currentY * -12;
            
            // Dynamic shadow
            const shadowX = currentX * -20;
            const shadowY = 15 + (currentY * -12);
            
            // Glare position
            const glareX = 50 + (currentX * 30);
            const glareY = 50 + (currentY * 30);
            
            card.style.setProperty('--tilt-x', `${tiltX}deg`);
            card.style.setProperty('--tilt-y', `${tiltY}deg`);
            card.style.setProperty('--shadow-x', `${shadowX}px`);
            card.style.setProperty('--shadow-y', `${shadowY}px`);
            card.style.setProperty('--glare-x', `${glareX}%`);
            card.style.setProperty('--glare-y', `${glareY}%`);
            card.style.setProperty('--glare-opacity', currentGlare.toString());
            card.style.setProperty('--card-scale', currentScale.toString());
            
            rafId = requestAnimationFrame(updateTilt);
        };
        
        card.addEventListener('mouseenter', () => {
            isHovering = true;
            targetScale = 1.08;
            targetGlare = 1;
            
            // Activate holo effect
            card.style.setProperty('--card-opacity', '1');
            
            if (!rafId) {
                rafId = requestAnimationFrame(updateTilt);
            }
        });
        
        card.addEventListener('mousemove', (e) => {
            if (!isHovering) return;
            
            const rect = card.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            // Normalize to -1 to 1 (for tilt)
            targetX = (e.clientX - centerX) / (rect.width / 2);
            targetY = (e.clientY - centerY) / (rect.height / 2);
            
            // Clamp
            targetX = Math.max(-1, Math.min(1, targetX));
            targetY = Math.max(-1, Math.min(1, targetY));

            // Pokemon V holo properties (0-1 range from top-left)
            const px = clamp((e.clientX - rect.left) / rect.width);
            const py = clamp((e.clientY - rect.top) / rect.height);

            // Pointer position as percentage (0-100%)
            card.style.setProperty('--pointer-x', round(px * 100) + '%');
            card.style.setProperty('--pointer-y', round(py * 100) + '%');

            // Background position (mapped to narrow range for subtle movement)
            card.style.setProperty('--background-x', adjust(px, 0, 1, 37, 63) + '%');
            card.style.setProperty('--background-y', adjust(py, 0, 1, 33, 67) + '%');

            // Distance from center (0 = center, 1 = edge)
            const dx = px - 0.5;
            const dy = py - 0.5;
            const fromCenter = clamp(Math.sqrt(dx * dx + dy * dy) / 0.5);
            card.style.setProperty('--pointer-from-center', round(fromCenter).toString());

            // Normalized position (0-1)
            card.style.setProperty('--pointer-from-top', round(py).toString());
            card.style.setProperty('--pointer-from-left', round(px).toString());
        });
        
        card.addEventListener('mouseleave', () => {
            isHovering = false;
            targetX = 0;
            targetY = 0;
            targetScale = 1;
            targetGlare = 0;
            
            // Fade out holo
            card.style.setProperty('--card-opacity', '0');
            
            if (!rafId) {
                rafId = requestAnimationFrame(updateTilt);
            }
        });
    });

    // About card 3D tilt (simplified - no holo)
    const aboutCard = document.querySelector('.about-image');
    if (aboutCard && isDesktop) {
        let abIsHovering = false;
        let abCurrentX = 0, abCurrentY = 0, abTargetX = 0, abTargetY = 0;
        let abCurrentScale = 1, abTargetScale = 1;
        let abRafId = null;

        const abUpdateTilt = () => {
            const tiltLerp = abIsHovering ? 0.15 : 0.045;
            const scaleLerp = abIsHovering ? 0.12 : 0.04;

            abCurrentX = lerp(abCurrentX, abTargetX, tiltLerp);
            abCurrentY = lerp(abCurrentY, abTargetY, tiltLerp);
            abCurrentScale = lerp(abCurrentScale, abTargetScale, scaleLerp);

            const done = !abIsHovering &&
                Math.abs(abCurrentX - abTargetX) < 0.001 &&
                Math.abs(abCurrentY - abTargetY) < 0.001 &&
                Math.abs(abCurrentScale - abTargetScale) < 0.001;

            if (done) {
                abCurrentX = 0; abCurrentY = 0; abCurrentScale = 1;
                aboutCard.style.setProperty('--tilt-x', '0deg');
                aboutCard.style.setProperty('--tilt-y', '0deg');
                aboutCard.style.setProperty('--card-scale', '1');
                aboutCard.style.setProperty('--shadow-x', '0px');
                aboutCard.style.setProperty('--shadow-y', '8px');
                aboutCard.style.setProperty('--pointer-x', '50%');
                aboutCard.style.setProperty('--pointer-y', '50%');
                abRafId = null;
                return;
            }

            const tiltY = abCurrentX * 10;
            const tiltX = abCurrentY * -10;
            const shadowX = abCurrentX * -15;
            const shadowY = 8 + (abCurrentY * -10);

            aboutCard.style.setProperty('--tilt-x', `${tiltX}deg`);
            aboutCard.style.setProperty('--tilt-y', `${tiltY}deg`);
            aboutCard.style.setProperty('--card-scale', abCurrentScale.toString());
            aboutCard.style.setProperty('--shadow-x', `${shadowX}px`);
            aboutCard.style.setProperty('--shadow-y', `${shadowY}px`);

            abRafId = requestAnimationFrame(abUpdateTilt);
        };

        aboutCard.addEventListener('mouseenter', () => {
            abIsHovering = true;
            abTargetScale = 1.05;
            aboutCard.style.setProperty('--card-opacity', '1');
            if (!abRafId) abRafId = requestAnimationFrame(abUpdateTilt);
        });

        aboutCard.addEventListener('mousemove', (e) => {
            if (!abIsHovering) return;
            const rect = aboutCard.getBoundingClientRect();
            abTargetX = clamp((e.clientX - rect.left - rect.width / 2) / (rect.width / 2), -1, 1);
            abTargetY = clamp((e.clientY - rect.top - rect.height / 2) / (rect.height / 2), -1, 1);

            const px = round((e.clientX - rect.left) / rect.width * 100);
            const py = round((e.clientY - rect.top) / rect.height * 100);
            aboutCard.style.setProperty('--pointer-x', px + '%');
            aboutCard.style.setProperty('--pointer-y', py + '%');
        });

        aboutCard.addEventListener('mouseleave', () => {
            abIsHovering = false;
            abTargetX = 0; abTargetY = 0; abTargetScale = 1;
            aboutCard.style.setProperty('--card-opacity', '0');
            if (!abRafId) abRafId = requestAnimationFrame(abUpdateTilt);
        });
    }

    // Now Playing tag toggle
    const nowPlayingTag = document.querySelector('.now-playing-tag');
    if (nowPlayingTag) {
        const textEl = nowPlayingTag.querySelector('.now-playing-text');
        let naturalWidth = 0;

        // Measure the natural width once
        if (textEl) {
            textEl.style.transition = 'none';
            textEl.style.width = 'auto';
            textEl.style.padding = '0.15rem 0.5rem 0.15rem 0.6rem';
            naturalWidth = textEl.scrollWidth;
            textEl.style.width = '0';
            textEl.style.padding = '0';
            textEl.offsetHeight; // force reflow
            textEl.style.transition = '';
        }

        nowPlayingTag.addEventListener('click', () => {
            const isOpen = nowPlayingTag.classList.toggle('is-open');
            if (textEl) {
                textEl.style.width = isOpen ? naturalWidth + 'px' : '0';
            }
        });
    }

    // Randomize idle shimmer delays so cards glint organically
    document.querySelectorAll('.card-frame').forEach(frame => {
        const delay = -(Math.random() * 10).toFixed(2);
        frame.style.setProperty('--shimmer-delay', delay + 's');
    });
});