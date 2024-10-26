let recordIdToDelete = null;

function showModal(recordId) {
    recordIdToDelete = recordId;
    document.getElementById('confirmDelete').style.display = 'block';
}

function closeModal() {
    document.getElementById('confirmDelete').style.display = 'none';
}

function confirmDelete() {
    if (recordIdToDelete !== null) {
        // Redirect to the PHP delete action with the record ID
        window.location.href = 'delete.php?id=' + recordIdToDelete;
    }
}