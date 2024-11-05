document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevents the form from actually submitting
    
    // Get the values from the input fields
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    // Show alert with the entered email
    alert(`Login attempt with email: ${email}`);
    console.log(email, password);
}); 