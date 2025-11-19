function validateForm() {
    let firstName = document.getElementById("firstName").value.trim();
    let lastName = document.getElementById("lastName").value.trim();
    let address = document.getElementById("address").value.trim();
    let email = document.getElementById("email").value.trim();
    let number = document.getElementById("number").value.trim();
    let password = document.getElementById("password").value;
    let cpassword = document.getElementById("cpassword").value;

    // Name validation (only letters allowed)
    let nameRegex = /^[A-Za-z]+$/;
    if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
        alert("First Name and Last Name should contain only letters.");
        return false;
    }

    // Email validation
    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Contact number validation (10 digits)
    let numberRegex = /^[0-9]{10}$/;
    if (!numberRegex.test(number)) {
        alert("Contact number must be exactly 10 digits.");
        return false;
    }

    // Password validation (min 8 characters, at least one number and one letter)
    let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    if (!passwordRegex.test(password)) {
        alert("Password must be at least 8 characters long and include at least one letter and one number.");
        return false;
    }

    // Confirm password validation
    if (password !== cpassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}