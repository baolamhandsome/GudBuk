<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal Login Form</title>
    <link rel="stylesheet" href="/GudBuk/public/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Sign In</h2>
                <p>Enter your credentials to continue</p>
            </div>
            
            <form class="login-form" id="loginForm" method="POST" action="/GudBuk/login" novalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required autocomplete="username">
                        <label for="username">Username</label>
                    </div>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                        <label for="password">Password</label>
                        <button type="button" class="password-toggle" id="passwordToggle" aria-label="Toggle password visibility">
                            <span class="toggle-icon"></span>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-options">
                    <div class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" class="checkbox-label">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="/GudBuk/register">Create one</a></p>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">✓</div>
                <h3>Welcome back!</h3>
                <p>Redirecting to your dashboard...</p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="/GudBuk/public/js/login.js"></script>
</body>
</html>