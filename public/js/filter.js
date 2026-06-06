document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filterForm');
    if (!filterForm) return;

    const searchInput = document.getElementById('search');
    const genreSelect = document.getElementById('genre');
    let searchTimeout = null;

    // Auto-submit on typing (with 500ms delay to avoid too many requests)
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500);
        });
    }

    // Auto-submit immediately on dropdown change
    if (genreSelect) {
        genreSelect.addEventListener('change', function () {
            filterForm.submit();
        });
    }
});