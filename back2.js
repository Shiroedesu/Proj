function show_Modal() {
    document.getElementById('backPromt').style.display = 'block';
}

function close_Modal() {
    document.getElementById('backPromt').style.display = 'none';
}

function back() {
    // Redirect or call your logout function
    window.location.href = 'user_Records.php'; // Example logout URL
}
