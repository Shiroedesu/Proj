function showModal() {
    document.getElementById('delete').style.display = 'block';
}

function closeModal() {
    document.getElementById('delete').style.display = 'none';
}

function logout() {
    alert('Deleting...');
    // Redirect or call your logout function
    window.location.href = 'delete.php'; // Example logout URL
}
