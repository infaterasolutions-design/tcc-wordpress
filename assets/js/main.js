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
});
