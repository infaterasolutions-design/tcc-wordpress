document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('tcc-load-more');
    if (loadMoreBtn) {
        // Restore state if navigating back
        if (performance.navigation && performance.navigation.type === 2) {
            const savedHtml = sessionStorage.getItem('tcc_blog_html');
            const savedPage = sessionStorage.getItem('tcc_blog_page');
            const maxPage = parseInt(loadMoreBtn.getAttribute('data-max'));
            
            if (savedHtml && savedPage) {
                const grid = document.querySelector('.bottom-grid');
                if (grid) {
                    grid.innerHTML = savedHtml;
                    loadMoreBtn.setAttribute('data-page', savedPage);
                    if (parseInt(savedPage) >= maxPage) {
                        loadMoreBtn.style.display = 'none';
                    }
                }
            }
        } else {
            // Clear state on fresh visit
            sessionStorage.removeItem('tcc_blog_html');
            sessionStorage.removeItem('tcc_blog_page');
        }

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
                    
                    // Save to sessionStorage
                    sessionStorage.setItem('tcc_blog_html', grid.innerHTML);
                    sessionStorage.setItem('tcc_blog_page', currentPage);
                    
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
        const hamburgerSVG = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
        const crossSVG = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';

        function openDrawer() {
            mobileDrawer.style.transform = 'translateX(0)';
            drawerOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
            hamburgerBtn.innerHTML = crossSVG;
        }
        function closeDrawer() {
            mobileDrawer.style.transform = 'translateX(-100%)';
            drawerOverlay.style.display = 'none';
            document.body.style.overflow = '';
            hamburgerBtn.innerHTML = hamburgerSVG;
        }
        hamburgerBtn.addEventListener('click', function() {
            if (mobileDrawer.style.transform === 'translateX(0)' || mobileDrawer.style.transform === 'translateX(0px)') {
                closeDrawer();
            } else {
                openDrawer();
            }
        });
        closeBtn.addEventListener('click', closeDrawer);
        drawerOverlay.addEventListener('click', closeDrawer);
    }



    // Back to top
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Mega Menu Interactions
    const megaMenuParents = document.querySelectorAll('.tcc-mega-menu-parent');
    
    megaMenuParents.forEach(parent => {
        const toggle = parent.querySelector('.tcc-mega-toggle');
        const panel = parent.querySelector('.tcc-mega-panel');
        if (!toggle || !panel) return;
        
        const subcatLinks = panel.querySelectorAll('.tcc-mega-subcat-link');
        const postGroups = panel.querySelectorAll('.tcc-mega-posts-group');
        
        // Handle subcategory hover
        subcatLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                const targetId = this.getAttribute('data-target');
                
                // Update active link
                subcatLinks.forEach(l => l.classList.remove('tcc-mega-active'));
                this.classList.add('tcc-mega-active');
                
                // Update active posts group
                postGroups.forEach(group => {
                    if (group.id === targetId) {
                        group.classList.add('tcc-mega-active');
                    } else {
                        group.classList.remove('tcc-mega-active');
                    }
                });
            });
            
            // Keyboard focus support for subcats
            link.addEventListener('focus', function() {
                this.dispatchEvent(new Event('mouseenter'));
            });
        });
        
        // Accessibility and keyboard nav
        parent.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggle.setAttribute('aria-expanded', 'false');
                panel.classList.remove('is-open');
                toggle.focus();
            }
        });
        
        toggle.addEventListener('focus', function() {
            toggle.setAttribute('aria-expanded', 'true');
            panel.classList.add('is-open');
        });
        
        parent.addEventListener('focusout', function(e) {
            // Close if focus moves outside the parent
            if (!parent.contains(e.relatedTarget)) {
                toggle.setAttribute('aria-expanded', 'false');
                panel.classList.remove('is-open');
            }
        });
        
        parent.addEventListener('mouseenter', function() {
            toggle.setAttribute('aria-expanded', 'true');
        });
        
        parent.addEventListener('mouseleave', function() {
            toggle.setAttribute('aria-expanded', 'false');
        });
    });
});