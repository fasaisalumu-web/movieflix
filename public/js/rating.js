document.addEventListener('DOMContentLoaded', function () {
    const ratingContainer = document.querySelector('.star-rating-container');
    if (!ratingContainer) return;

    const stars = ratingContainer.querySelectorAll('.star');
    const movieId = ratingContainer.getAttribute('data-movie-id');
    const messageEl = document.getElementById('rating-message');

    // Hover effects
    stars.forEach(star => {
        star.addEventListener('mouseenter', function () {
            highlightStars(this.getAttribute('data-value'));
        });

        star.addEventListener('mouseleave', function () {
            resetStars();
        });

        star.addEventListener('click', function () {
            const score = this.getAttribute('data-value');
            submitRating(movieId, score);
        });
    });

    function highlightStars(value) {
        stars.forEach(s => {
            if (s.getAttribute('data-value') <= value) {
                s.classList.add('hovered');
            } else {
                s.classList.remove('hovered');
            }
        });
    }

    function resetStars() {
        stars.forEach(s => s.classList.remove('hovered'));
    }

    function submitRating(id, score) {
        // 1. Get CSRF Token safely
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            messageEl.textContent = 'System Error: Missing CSRF token.';
            messageEl.className = 'mt-2 small text-danger';
            return;
        }
        const csrfToken = csrfMeta.getAttribute('content');

        // 2. Disable stars temporarily
        stars.forEach(s => s.style.pointerEvents = 'none');
        messageEl.textContent = 'Submitting...';
        messageEl.className = 'mt-2 small text-info';

        // 3. Send Fetch Request
        fetch(`/movies/${id}/rate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ score: parseInt(score) })
        })
        .then(response => {
            // Check if response is OK (200-299)
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error('Server Error: ' + text.substring(0, 100));
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update UI on success
                stars.forEach(s => {
                    s.classList.remove('active');
                    if (s.getAttribute('data-value') <= score) {
                        s.classList.add('active');
                    }
                });
                
                messageEl.textContent = `You rated this movie ${score} stars! (Avg: ${data.avg_rating})`;
                messageEl.className = 'mt-2 small text-success';
            }
        })
        .catch(error => {
            console.error('Rating Error:', error);
            messageEl.textContent = 'Error: ' + error.message;
            messageEl.className = 'mt-2 small text-danger';
        })
        .finally(() => {
            // Re-enable stars
            stars.forEach(s => s.style.pointerEvents = 'auto');
        });
    }
});