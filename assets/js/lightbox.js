document.addEventListener('DOMContentLoaded', function() {
    // Select all images in the post content that are not already part of a lightbox
    const images = document.querySelectorAll('.article-content img, .article-body img, .centered-post-content img');

    if (images.length === 0) return;

    // Create the overlay container
    const overlay = document.createElement('div');
    overlay.className = 'tcc-lightbox-overlay';
    
    // Create the image element
    const overlayImg = document.createElement('img');
    overlayImg.className = 'tcc-lightbox-image';
    
    // Create close button
    const closeBtn = document.createElement('div');
    closeBtn.className = 'tcc-lightbox-close';
    closeBtn.innerHTML = '&times;';
    
    overlay.appendChild(overlayImg);
    overlay.appendChild(closeBtn);
    document.body.appendChild(overlay);

    let scale = 1;
    let panning = false;
    let pointX = 0;
    let pointY = 0;
    let startX = 0;
    let startY = 0;
    let initialDistance = 0;

    function setTransform() {
        overlayImg.style.transform = `translate(${pointX}px, ${pointY}px) scale(${scale})`;
    }

    // Function to open lightbox
    function openLightbox(src) {
        overlayImg.src = src;
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
        scale = 1; pointX = 0; pointY = 0;
        setTransform();
    }

    // Function to close lightbox
    function closeLightbox() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        setTimeout(() => { 
            overlayImg.src = ''; 
            scale = 1; pointX = 0; pointY = 0;
            overlayImg.style.transform = '';
            overlayImg.style.transition = '';
        }, 300); // clear after transition
    }

    // Attach double click event to all images
    images.forEach(img => {
        img.style.cursor = 'zoom-in';
        
        // Wrap image and add hint badge
        const wrapper = document.createElement('div');
        wrapper.className = 'tcc-image-zoom-wrapper';
        img.parentNode.insertBefore(wrapper, img);
        wrapper.appendChild(img);

        const hint = document.createElement('div');
        hint.className = 'tcc-image-zoom-hint';
        hint.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:-1px;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg> <span>Double tap to zoom</span>';
        wrapper.appendChild(hint);
        
        // Desktop double click
        img.addEventListener('dblclick', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const src = this.getAttribute('data-full-url') || this.src;
            openLightbox(src);
        });

        // Mobile double tap
        let lastTap = 0;
        img.addEventListener('touchend', function(e) {
            const currentTime = new Date().getTime();
            const tapLength = currentTime - lastTap;
            if (tapLength < 500 && tapLength > 0) {
                e.preventDefault();
                e.stopPropagation();
                const src = this.getAttribute('data-full-url') || this.src;
                openLightbox(src);
            }
            lastTap = currentTime;
        });
    });

    // Custom Pinch-to-Zoom and Pan for Mobile
    overlay.addEventListener('touchstart', function(e) {
        if (e.touches.length === 2) {
            e.preventDefault();
            initialDistance = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            overlayImg.style.transition = 'none';
        } else if (e.touches.length === 1 && scale > 1) {
            e.preventDefault();
            panning = true;
            startX = e.touches[0].clientX - pointX;
            startY = e.touches[0].clientY - pointY;
            overlayImg.style.transition = 'none';
        }
    }, {passive: false});

    overlay.addEventListener('touchmove', function(e) {
        if (e.touches.length === 2) {
            e.preventDefault();
            const currentDistance = Math.hypot(
                e.touches[0].clientX - e.touches[1].clientX,
                e.touches[0].clientY - e.touches[1].clientY
            );
            const delta = currentDistance - initialDistance;
            scale += delta * 0.015;
            if (scale < 1) scale = 1;
            if (scale > 5) scale = 5;
            initialDistance = currentDistance;
            setTransform();
        } else if (e.touches.length === 1 && panning) {
            e.preventDefault();
            pointX = e.touches[0].clientX - startX;
            pointY = e.touches[0].clientY - startY;
            setTransform();
        }
    }, {passive: false});

    overlay.addEventListener('touchend', function(e) {
        if (e.touches.length < 2) {
            initialDistance = 0;
        }
        if (e.touches.length === 0) {
            panning = false;
            overlayImg.style.transition = 'transform 0.3s cubic-bezier(0.25, 1, 0.5, 1)';
        }
    });

    // Close on click (only if clicking the overlay background or close button)
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay || e.target === closeBtn) {
            closeLightbox();
        }
    });
    
    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeLightbox();
        }
    });
});
