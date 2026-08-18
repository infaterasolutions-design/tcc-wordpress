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

    // Function to open lightbox
    function openLightbox(src) {
        overlayImg.src = src;
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Function to close lightbox
    function closeLightbox() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
        setTimeout(() => { overlayImg.src = ''; }, 300); // clear after transition
    }

    // Attach double click event to all images
    images.forEach(img => {
        img.style.cursor = 'zoom-in';
        
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

    // Close on click
    overlay.addEventListener('click', closeLightbox);
    
    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('active')) {
            closeLightbox();
        }
    });
});
