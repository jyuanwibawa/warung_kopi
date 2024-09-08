

function showPopup(type) {
    var popupId = type === 'success' ? 'popup-success' : 'popup-error';
    document.getElementById(popupId).style.display = 'flex';
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Function to handle page load and query string parameters
window.onload = function() {
    var urlParams = new URLSearchParams(window.location.search);
    var status = urlParams.get('status');
    if (status === 'success') {
        showPopup('success');
    } else if (status === 'error') {
        showPopup('error');
    }
};
