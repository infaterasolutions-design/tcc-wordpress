document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('tcc-load-more');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const button = this;
            const originalText = button.innerHTML;
            
            // Show loading state
            button.innerHTML = 'LOADING... <div class="load-more-line"></div>';
            button.style.pointerEvents = 'none';

            let currentPage = parseInt(button.getAttribute('data-page'));
            const maxPage = parseInt(button.getAttribute('data-max'));
            const category = button.getAttribute('data-category');

            const data = new FormData();
            data.append('action', 'tcc_load_more_posts');
            data.append('page', currentPage + 1);
            data.append('category', category);
            data.append('nonce', tcc_ajax.nonce);

            fetch(tcc_ajax.url, {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(html => {
                if (html.trim() !== '') {
                    // Append HTML to grid
                    const grid = document.querySelector('.bottom-grid');
                    grid.insertAdjacentHTML('beforeend', html);
                    
                    currentPage++;
                    button.setAttribute('data-page', currentPage);
                    
                    if (currentPage >= maxPage) {
                        button.style.display = 'none';
                    } else {
                        button.innerHTML = originalText;
                        button.style.pointerEvents = 'auto';
                    }
                } else {
                    button.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error loading posts:', error);
                button.innerHTML = originalText;
                button.style.pointerEvents = 'auto';
            });
        });
    }

    // Hamburger Menu
    const hamburgerBtn = document.getElementById('hamburger-icon');
    const closeBtn = document.getElementById('close-drawer');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const drawerOverlay = document.getElementById('mobile-drawer-overlay');

    if (hamburgerBtn && closeBtn && mobileDrawer && drawerOverlay) {
        function openDrawer() {
            mobileDrawer.style.transform = 'translateX(0)';
            drawerOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        function closeDrawer() {
            mobileDrawer.style.transform = 'translateX(-100%)';
            drawerOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }
        hamburgerBtn.addEventListener('click', openDrawer);
        closeBtn.addEventListener('click', closeDrawer);
        drawerOverlay.addEventListener('click', closeDrawer);
    }

    // Search Overlay
    const searchBtn = document.querySelector('.mobile-search-icon');
    const searchOverlay = document.getElementById('search-overlay');
    const closeSearch = document.getElementById('close-search');

    if (searchBtn && searchOverlay && closeSearch) {
        searchBtn.addEventListener('click', () => {
            searchOverlay.style.display = 'flex';
            setTimeout(() => {
                const searchInput = searchOverlay.querySelector('input[type="search"]');
                if (searchInput) searchInput.focus();
            }, 100);
        });
        closeSearch.addEventListener('click', () => {
            searchOverlay.style.display = 'none';
        });
    }

    // Back to top
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
