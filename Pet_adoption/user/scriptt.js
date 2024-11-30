document.getElementById('adoptButton').addEventListener('click', function() {
    // Check if user is logged in (this is a placeholder, implement your own logic)
    const isLoggedIn = true; // Replace with actual login check

    if (isLoggedIn) {
        document.getElementById('adoptionForm').style.display = 'block';
    } else {
        alert('You must be logged in to adopt a pet.');
        window.location.href = 'Login.php'; // Redirect to login page
    }
});