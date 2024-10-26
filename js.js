function showModal() {
    document.getElementById('logoutPrompt').style.display = 'block';
}

function closeModal() {
    document.getElementById('logoutPrompt').style.display = 'none';
}

function logout() {
    // Perform logout action here, e.g., redirect to logout URL
    alert('Logging out...');
    // Redirect or call your logout function
    window.location.href = 'Admin_logout.php'; // Example logout URL
}
