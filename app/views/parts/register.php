<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Register</title>
    <link rel="stylesheet" href="/GudBuk/public/css/register.css">
</head>

<body>
    <div class="register-container">
        <div class="register-card">

            <form class="register-form" id="registerForm" method="POST" action="/GudBuk/register" novalidate>
                <!-- Email input field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" required autocomplete="email">
                        <label for="email">Email</label>
                    </div>
                    <span class="error-message" id="emailError"></span>
                </div>

                <!-- Full name input field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" required autocomplete="name">
                        <label for="name">Full Name</label>
                    </div>
                    <span class="error-message" id="nameError"></span>
                </div>

                <!-- Phone input field (optional) -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="tel" id="phone" name="phone" autocomplete="tel">
                        <label for="phone">Phone Number</label>
                    </div>
                </div>

                <!-- Address input field (optional) -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <textarea id="address" name="address"></textarea>
                        <label for="address">Address</label>
                    </div>
                </div>

                <!-- Password input field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <label for="password">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <!-- Password confirm field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password_confirm" name="password_confirm" required autocomplete="new-password">
                        <label for="password_confirm">Confirm Password</label>
                        <button type="button" class="password-toggle" id="passwordConfirmToggle" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                    <span class="error-message" id="password_confirmError"></span>
                </div>

                <!-- Terms and conditions checkbox -->
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms" class="checkbox-label">
                        <span class="checkmark"></span>
                        I agree to the <a href="#">Terms of Service</a>
                    </label>
                </div>
                <span class="checkbox-error" id="termsError"></span>

                <!-- Submit button -->
                <button type="submit" class="register-btn">
                    <span class="btn-text">Create Account</span>
                    <span class="btn-loader"></span>
                </button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="/GudBuk/login">Login</a></p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/GudBuk/public/js/register.js"></script>
</body>

</html>