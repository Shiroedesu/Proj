function show_Modal() {
    document.getElementById('delete').style.display = 'block';
}

function close_Modal() {
    document.getElementById('delete').style.display = 'none';
}

function confirm_Delete() {
    alert('Deleting...');
    // Redirect or call your logout function
    window.location.href = 'delete_event.php'; // Example logout URL
}
