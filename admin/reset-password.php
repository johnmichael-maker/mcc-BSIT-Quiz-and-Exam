<?php require __DIR__ . '/./partials/header.php'; ?>

<div class="h-100-vh d-flex align-items-center justify-content-center" style="background-image: url('../assets/img/image-22.png'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <form name="reset-pass" class="m-auto" id="signup-card">
            <div class="card">
                <div class="card-body">
                    <a href="login.php" class="btn btn-secondary mb-3"><i class="bx bx-arrow-back"></i></a>
                    <h5 class="mb-3 text-center">Reset Password</h5>

                    <!-- Success/Error Alerts -->
                    <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to login page....</p>
                    <p class="alert alert-danger py-2 d-none" id="alert-error"></p>

                    <!-- Email Field -->
                    <label for="email">Email</label>
                    <input type="email" class="form-control my-2" placeholder="Enter email" name="email" id="email" required>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <!-- Verification Code Field -->
                    <label for="verification">Verification Code</label>
                    <input type="text" class="form-control my-2" placeholder="Enter verification code" name="verification" id="verification" required>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <!-- New Password Field -->
                    <label for="new_pass">New Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control my-2" placeholder="Enter new password" name="new_pass" id="new_pass"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$%^&*()_+={}\[\]:;,.?/~<>|\\/-])[A-Za-z\d!$%^&*()_+={}\[\]:;,.?/~<>|\\/-]{8,}$" 
                        title="Password must be at least 8 characters long and contain at least one letter, one number, and one special character." required>
                        <i class="bx bx-show fs-4 position-absolute top-0 end-0 mt-2 me-2" style="cursor: pointer;" id="show-pass1"></i>
                    </div>
                    <p class="errors d-none alert alert-danger py-1"></p>
                    <div id="password-strength" class="d-none">
                        <p class="text-muted" id="strength-text"></p>
                        <div class="progress" style="height: 5px;">
                            <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <!-- Confirm Password Field -->
                    <label for="confirm">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control my-2" placeholder="Re-enter new password" name="confirm" id="confirm" required>
                        <i class="bx bx-show fs-4 position-absolute top-0 end-0 mt-2 me-2" style="cursor: pointer;" id="show-pass2"></i>
                    </div>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <!-- Submit Button -->
                    <button type="submit" name="button" class="w-100 btn mt-3 mb-2" id="submit-btn" style="background-color: #EF0107; color:white;" disabled>Submit</button>

                    <!-- Loading Spinner -->
                    <div class="text-center d-none" id="loading-signup">
                        <div class="spinner-border mt-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Regular expression for password strength validation
const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!$%^&*()_+={}\[\]:;,.?/~<>|\\/-])[A-Za-z\d!$%^&*()_+={}\[\]:;,.?/~<>|\\/-]{8,}$/;

document.getElementById('new_pass').addEventListener('input', function() {
    const password = this.value;
    const strengthText = document.getElementById('strength-text');
    const strengthBar = document.getElementById('strength-bar');
    const strengthIndicator = document.getElementById('password-strength');
    const submitBtn = document.getElementById('submit-btn');
    
    // Show password strength indicator
    strengthIndicator.classList.remove('d-none');
    
    // Check password strength
    const strength = checkPasswordStrength(password);

    // Update the strength bar and text based on the strength level
    strengthBar.style.width = `${strength.percentage}%`;
    strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
    strengthBar.classList.add(strength.color);

    // Update the strength text
    strengthText.textContent = strength.message;

    // Enable the submit button only if the password is strong
    if (strength.percentage === 100) {
        submitBtn.disabled = false; // Enable Submit button when password is strong
    } else {
        submitBtn.disabled = true; // Disable Submit button when password is not strong
    }
});

// Function to check password strength
const checkPasswordStrength = (password) => {
    let strength = {
        message: "Weak password.",
        percentage: 25,
        color: "bg-danger"
    };

    if (password.length >= 8 && strongPasswordPattern.test(password)) {
        strength.message = "Strong password!";
        strength.percentage = 100;
        strength.color = "bg-success";
    } else if (password.length >= 6) {
        strength.message = "Medium strength password.";
        strength.percentage = 50;
        strength.color = "bg-warning";
    }

    return strength;
};

// Sanitize input to prevent XSS (Cross-Site Scripting) attacks
const sanitizeInput = (input) => {
    return input.replace(/<[^>]*>/g, ''); // Remove HTML tags (including script tags)
};

const resetPasswordForm = document.forms["reset-pass"];

// Submit handler for the reset password form
resetPasswordForm.onsubmit = async (e) => {
    e.preventDefault();

    // Get all input fields and error messages
    let email = resetPasswordForm["email"].value;
    let verification = resetPasswordForm["verification"].value;
    let new_pass = resetPasswordForm["new_pass"].value;
    let confirm = resetPasswordForm["confirm"].value;
    const errors = document.querySelectorAll(".errors");
    const loadingSignup = document.getElementById("loading-signup");

    // Sanitize input values to prevent XSS
    email = sanitizeInput(email);
    verification = sanitizeInput(verification);
    new_pass = sanitizeInput(new_pass);
    confirm = sanitizeInput(confirm);

    // Validate form fields
    let valid = validateFields(email, verification, new_pass, confirm, errors);
    
    // If validation passes, proceed with the form submission
    if (valid) {
        const data = {
            email,
            verification,
            new_pass,
            confirm,
            reset_password: true
        };

        // Call the login function to send data to the server
        try {
            // Show loading spinner
            loadingSignup.classList.remove("d-none");

            // Submit form data to the server
            const response = await fetch("../function/Process.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                },
                body: JSON.stringify(data),
            });

            const dataResponse = await response.text();
            handleServerResponse(dataResponse);

        } catch (error) {
            console.error("Error during the password reset process:", error);
        } finally {
            // Hide loading spinner after the process
            loadingSignup.classList.add("d-none");
        }
    }
};

// Function to validate the form fields
const validateFields = (email, verification, new_pass, confirm, errors) => {
    let isValid = true;

    // Clear previous error messages
    errors.forEach(error => hideError(error));

    // Validate email field
    if (!email) {
        showError(errors[0], "Please fill in your email.");
        isValid = false;
    }

    // Validate verification code field
    if (!verification) {
        showError(errors[1], "Please fill in your verification code.");
        isValid = false;
    }

    // Validate password field
    if (!new_pass) {
        showError(errors[2], "Please fill in a new password.");
        isValid = false;
    } else if (new_pass !== confirm) {
        showError(errors[2], "Passwords do not match.");
        isValid = false;
    }

    // Validate confirm password field
    if (!confirm) {
        showError(errors[3], "Please confirm your new password.");
        isValid = false;
    }

    return isValid;
};

// Function to show an error message
const showError = (errorElement, message) => {
    errorElement.classList.remove("d-none");
    errorElement.innerHTML = message;
};

// Function to hide an error message
const hideError = (errorElement) => {
    errorElement.classList.add("d-none");
};

// Function to handle server response
const handleServerResponse = (response) => {
    const alertSuccess = document.getElementById("alert-success");
    const alertError = document.getElementById("alert-error");

    // Handle response from the server
    if (response === "success") {
        alertSuccess.classList.remove("d-none");
        setTimeout(() => {
            window.location.href = "login.php";
        }, 3000);
    } else {
        alertError.classList.remove("d-none");
        alertError.textContent = getErrorMessage(response);
    }
};

// Function to map server response to error messages
const getErrorMessage = (responseCode) => {
    switch (responseCode) {
        case 'error':
            return "Error: Account doesn't exist.";
        case 'error_confirm':
            return "Error: Passwords don't match.";
        case 'error_verification':
            return "Error: Incorrect verification code.";
        default:
            return "An unexpected error occurred.";
    }
};

// Toggle password visibility
document.getElementById('show-pass1').onclick = () => togglePasswordVisibility('new_pass', 'show-pass1');
document.getElementById('show-pass2').onclick = () => togglePasswordVisibility('confirm', 'show-pass2');

// Function to toggle password visibility
const togglePasswordVisibility = (inputName, iconId) => {
    const input = document.forms['reset-pass'][inputName];
    const icon = document.getElementById(iconId);

    if (input.getAttribute('type') === 'password') {
        icon.classList.replace('bx-show', 'bx-low-vision');
        input.setAttribute('type', 'text');
    } else {
        icon.classList.replace('bx-low-vision', 'bx-show');
        input.setAttribute('type', 'password');
    }
};
</script>

<?php require __DIR__ . '/./partials/footer.php'; ?>
