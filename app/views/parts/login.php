<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Login Form</title>
    <link rel="stylesheet" href="/gudbuk/public/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Sign In</h2>
            </div>

            <form class="login-form" id="loginForm" method="POST" nonvalidate>
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" autocomplete="email">
                        <label for="email">Email Address</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" autocomplete="current-password">
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">
                    <span class="btn-text">Sign In</span>
                    <span class="btn-loader"></span>
                </button>
            </form>

            <div class="signup-link">
                <p>Don't have an account? <a href="/gudbuk/register">Create one</a></p>
            </div>
        </div>
    </div>
</body>

</html>