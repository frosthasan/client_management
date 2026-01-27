<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --secondary-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --gray-color: #95a5a6;
            --light-gray: #f8f9fa;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a2980, #26d0ce);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .login-left {
            flex: 1;
            background: linear-gradient(to bottom right, var(--dark-color), var(--primary-dark));
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .features-list {
            list-style: none;
            margin-top: 30px;
        }

        .features-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .features-list i {
            background-color: rgba(255, 255, 255, 0.2);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1rem;
        }

        .login-right {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--light-gray);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 1.5rem;
        }

        .logo-text {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .login-form {
            width: 100%;
        }

        .login-form h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .login-form p {
            color: var(--gray-color);
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }

        .input-with-icon input {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
        }

        .input-with-icon input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .remember-me label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn {
            padding: 14px 20px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .error-message {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in;
        }

        .error-message i {
            font-size: 1.1rem;
        }

        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--secondary-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in;
        }

        .validation-errors {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease-in;
        }

        .validation-errors ul {
            list-style: none;
            padding-left: 5px;
        }

        .validation-errors li {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .validation-errors i {
            font-size: 0.9rem;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: var(--gray-color);
        }

        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 500px;
                min-height: auto;
            }

            .login-left, .login-right {
                padding: 30px;
            }

            .login-left {
                order: 2;
            }

            .login-right {
                order: 1;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 0;
                border-radius: 0;
            }

            .login-left, .login-right {
                padding: 25px 20px;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .logo-text {
                font-size: 1.5rem;
            }

            .login-left h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Panel with Information -->
        <div class="login-left">
            <h1>Vehicle Management System</h1>
            <p>Manage your fleet efficiently with our comprehensive vehicle management solution.</p>

            <ul class="features-list">
                <li><i class="fas fa-car"></i> Track vehicle status and maintenance schedules</li>
                <li><i class="fas fa-chart-line"></i> Monitor fuel efficiency and costs</li>
                <li><i class="fas fa-bell"></i> Get reminders for important tasks</li>
                <li><i class="fas fa-file-contract"></i> Manage documentation and compliance</li>
            </ul>

            <div class="testimonial" style="margin-top: 40px; font-style: italic; opacity: 0.8;">
                <p>"This system has reduced our fleet management costs by 30% and improved vehicle uptime significantly."</p>
                <p style="margin-top: 10px; font-weight: 500;">- John Smith, Fleet Manager</p>
            </div>
        </div>

        <!-- Right Panel with Login Form -->
        <div class="login-right">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="logo-text">{{ config('app.name', 'VMS Dashboard') }}</div>
            </div>

            <div class="login-form">
                <h2>Welcome Back</h2>
                <p>Sign in to access your vehicle management dashboard</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="validation-errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                   placeholder="Enter your email address">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" name="password" required
                                   placeholder="Enter your password">
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="form-options">
                        <div class="remember-me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <label for="remember_me">Remember me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                        <i class="fas fa-spinner fa-spin" id="btnSpinner" style="display: none;"></i>
                    </button>
                </form>

                <!-- Register Link -->
                @if (Route::has('register'))
                    <div class="signup-link">
                        Don't have an account?
                        <a href="{{ route('register') }}">Register here</a>
                    </div>
                @else
                    <div class="signup-link">
                        Need access?
                        <a href="#">Contact administrator</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = loginBtn.querySelector('span');

            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    // Show loading state
                    btnText.textContent = 'Signing In...';
                    btnSpinner.style.display = 'inline-block';
                    loginBtn.disabled = true;

                    // If there are validation errors, re-enable button
                    setTimeout(() => {
                        if (document.querySelector('.validation-errors')) {
                            btnText.textContent = 'Sign In';
                            btnSpinner.style.display = 'none';
                            loginBtn.disabled = false;

                            // Add shake animation to indicate error
                            loginBtn.classList.add('shake');
                            setTimeout(() => {
                                loginBtn.classList.remove('shake');
                            }, 500);
                        }
                    }, 1500);
                });
            }

            // Auto-hide success messages after 5 seconds
            const successMessages = document.querySelectorAll('.alert-success');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s';
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 500);
                }, 5000);
            });

            // Auto-focus on email field if there are no errors
            if (!document.querySelector('.validation-errors')) {
                const emailField = document.getElementById('email');
                if (emailField) {
                    emailField.focus();
                }
            }

            // Add visual feedback for form inputs
            const formInputs = document.querySelectorAll('.input-with-icon input');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });

                // Add/remove filled class for styling
                input.addEventListener('input', function() {
                    if (this.value) {
                        this.classList.add('filled');
                    } else {
                        this.classList.remove('filled');
                    }
                });
            });
        });
    </script>
</body>
</html>
