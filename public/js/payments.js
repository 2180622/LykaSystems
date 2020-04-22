// Tooltip
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
});

// Filters
var closeButton = document.getElementById('close-icon-div');
var filterButton = document.getElementById('filter-icon-div');

function showCloseIcon() {
    filterButton.style.display = "none";
    closeButton.style.display = "inline-block";
    closeButton.style.float = "right";
}

function showFunnelIcon() {
    filterButton.style.display = "inline-block";
    filterButton.style.float = "right";
    closeButton.style.display = "none";
}
