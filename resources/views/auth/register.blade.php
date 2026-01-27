<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Register</title>

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

        .register-container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            background-color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .register-left {
            flex: 1;
            background: linear-gradient(to bottom right, var(--dark-color), var(--primary-dark));
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-left h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .register-left p {
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

        .register-right {
            flex: 1.2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: var(--light-gray);
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
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

        .register-form {
            width: 100%;
        }

        .register-form h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .register-form p {
            color: var(--gray-color);
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        .required::after {
            content: " *";
            color: var(--danger-color);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            font-size: 0.95rem;
        }

        .input-with-icon input, .input-with-icon select {
            width: 100%;
            padding: 11px 11px 11px 40px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s;
            background-color: white;
        }

        .input-with-icon select {
            appearance: none;
            -webkit-appearance: none;
            padding-right: 35px;
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            pointer-events: none;
            font-size: 0.9rem;
        }

        .input-with-icon input:focus, .input-with-icon select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            cursor: pointer;
            background: none;
            border: none;
            font-size: 0.95rem;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-row {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .terms-agreement {
            margin: 15px 0 20px;
            padding: 12px;
            background-color: rgba(52, 152, 219, 0.05);
            border-radius: var(--border-radius);
            border-left: 4px solid var(--primary-color);
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .terms-checkbox input {
            margin-top: 3px;
            accent-color: var(--primary-color);
        }

        .terms-checkbox label {
            font-size: 0.85rem;
            color: var(--dark-color);
            line-height: 1.4;
        }

        .terms-checkbox a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .terms-checkbox a:hover {
            text-decoration: underline;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .validation-errors {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            animation: fadeIn 0.3s ease-in;
        }

        .validation-errors ul {
            list-style: none;
            padding-left: 5px;
        }

        .validation-errors li {
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .validation-errors i {
            font-size: 0.85rem;
        }

        .success-message {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--secondary-color);
            padding: 12px;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
            animation: fadeIn 0.3s ease-in;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .success-message i {
            font-size: 1rem;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--gray-color);
            font-size: 0.9rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-strength {
            margin-top: 5px;
            height: 3px;
            border-radius: 2px;
            background-color: #eee;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-weak {
            background-color: var(--danger-color);
            width: 25%;
        }

        .strength-fair {
            background-color: var(--warning-color);
            width: 50%;
        }

        .strength-good {
            background-color: #f1c40f;
            width: 75%;
        }

        .strength-strong {
            background-color: var(--secondary-color);
            width: 100%;
        }

        .strength-text {
            font-size: 0.75rem;
            margin-top: 3px;
            text-align: right;
            color: var(--gray-color);
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
            .register-container {
                flex-direction: column;
                max-width: 500px;
            }

            .register-left, .register-right {
                padding: 30px;
            }

            .register-left {
                order: 2;
            }

            .register-right {
                order: 1;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 0;
                border-radius: 0;
            }

            .register-left, .register-right {
                padding: 20px 15px;
            }

            .logo-text {
                font-size: 1.5rem;
            }

            .register-left h1 {
                font-size: 1.8rem;
            }

            .register-form h2 {
                font-size: 1.6rem;
            }

            .features-list li {
                font-size: 0.9rem;
            }

            .features-list i {
                width: 30px;
                height: 30px;
                font-size: 0.9rem;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Left Panel with Information -->
        <div class="register-left">
            <h1>Join Vehicle Management System</h1>
            <p>Create your account to start managing your fleet efficiently and effectively.</p>

            <ul class="features-list">
                <li><i class="fas fa-shield-alt"></i> Secure account with role-based access</li>
                <li><i class="fas fa-car"></i> Track unlimited vehicles in your fleet</li>
                <li><i class="fas fa-chart-pie"></i> Access detailed analytics and reports</li>
                <li><i class="fas fa-bell"></i> Get automated maintenance reminders</li>
            </ul>

            <div class="testimonial" style="margin-top: 30px; font-style: italic; opacity: 0.8; font-size: 0.9rem;">
                <p>"Since joining VMS, we've reduced vehicle downtime by 40% and improved fleet efficiency."</p>
                <p style="margin-top: 8px; font-weight: 500;">- Sarah Johnson, Logistics Manager</p>
            </div>
        </div>

        <!-- Right Panel with Registration Form -->
        <div class="register-right">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="logo-text">{{ config('app.name', 'VMS Dashboard') }}</div>
            </div>

            <div class="register-form">
                <h2>Create Account</h2>
                <p>Fill in your details to create a new account</p>

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

                <!-- Success Message -->
                @if (session('status'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name" class="required">First Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus
                                       placeholder="First name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="required">Last Name</label>
                            <div class="input-with-icon">
                                <i class="fas fa-user"></i>
                                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required
                                       placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="required">Email Address</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                   placeholder="Email address">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" name="password" required
                                   placeholder="Create a password">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="required">Confirm Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                   placeholder="Confirm password">
                            <button type="button" class="password-toggle" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-match" id="passwordMatch" style="font-size: 0.8rem; margin-top: 3px;"></div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="terms-agreement">
                        <div class="terms-checkbox">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">
                                I agree to the <a href="#" target="_blank">Terms</a> and <a href="#" target="_blank">Privacy Policy</a>.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="registerBtn">
                        <i class="fas fa-user-plus"></i>
                        <span>Create Account</span>
                        <i class="fas fa-spinner fa-spin" id="btnSpinner" style="display: none;"></i>
                    </button>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');
            const registerBtn = document.getElementById('registerBtn');
            const btnSpinner = document.getElementById('btnSpinner');
            const btnText = registerBtn.querySelector('span');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const toggleConfirmPasswordBtn = document.getElementById('toggleConfirmPassword');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            const passwordMatch = document.getElementById('passwordMatch');

            // Password visibility toggle
            togglePasswordBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });

            toggleConfirmPasswordBtn.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;

                if (password.length < 6) {
                    // Password too short
                } else if (password.length >= 8) {
                    strength += 1;
                }

                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
                    strength += 1;
                }

                if (password.match(/\d/)) {
                    strength += 1;
                }

                if (password.match(/[^a-zA-Z\d]/)) {
                    strength += 1;
                }

                // Update strength bar
                strengthBar.className = 'strength-bar';

                if (password.length === 0) {
                    strengthBar.style.width = '0';
                    strengthText.textContent = 'Password strength';
                    strengthText.style.color = 'var(--gray-color)';
                } else if (strength <= 1) {
                    strengthBar.className += ' strength-weak';
                    strengthText.textContent = 'Weak';
                    strengthText.style.color = 'var(--danger-color)';
                } else if (strength === 2) {
                    strengthBar.className += ' strength-fair';
                    strengthText.textContent = 'Fair';
                    strengthText.style.color = 'var(--warning-color)';
                } else if (strength === 3) {
                    strengthBar.className += ' strength-good';
                    strengthText.textContent = 'Good';
                    strengthText.style.color = '#f1c40f';
                } else {
                    strengthBar.className += ' strength-strong';
                    strengthText.textContent = 'Strong';
                    strengthText.style.color = 'var(--secondary-color)';
                }
            }

            // Password match checker
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.length === 0) {
                    passwordMatch.textContent = '';
                    passwordMatch.style.color = '';
                } else if (password === confirmPassword) {
                    passwordMatch.textContent = '✓ Passwords match';
                    passwordMatch.style.color = 'var(--secondary-color)';
                } else {
                    passwordMatch.textContent = '✗ Passwords do not match';
                    passwordMatch.style.color = 'var(--danger-color)';
                }
            }

            // Real-time password validation
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
            });

            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form submission
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    const password = passwordInput.value;
                    const confirmPassword = confirmPasswordInput.value;
                    const terms = document.getElementById('terms').checked;

                    // Basic client-side validation
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        passwordMatch.textContent = '✗ Passwords must match';
                        passwordMatch.style.color = 'var(--danger-color)';
                        confirmPasswordInput.focus();
                        registerBtn.classList.add('shake');
                        setTimeout(() => {
                            registerBtn.classList.remove('shake');
                        }, 500);
                        return;
                    }

                    if (!terms) {
                        e.preventDefault();
                        alert('Please agree to the Terms of Service and Privacy Policy');
                        document.getElementById('terms').focus();
                        registerBtn.classList.add('shake');
                        setTimeout(() => {
                            registerBtn.classList.remove('shake');
                        }, 500);
                        return;
                    }

                    // Show loading state
                    btnText.textContent = 'Creating Account...';
                    btnSpinner.style.display = 'inline-block';
                    registerBtn.disabled = true;

                    // If there are validation errors, re-enable button
                    setTimeout(() => {
                        if (document.querySelector('.validation-errors')) {
                            btnText.textContent = 'Create Account';
                            btnSpinner.style.display = 'none';
                            registerBtn.disabled = false;

                            // Add shake animation to indicate error
                            registerBtn.classList.add('shake');
                            setTimeout(() => {
                                registerBtn.classList.remove('shake');
                            }, 500);
                        }
                    }, 1500);
                });
            }

            // Auto-focus on first name field if there are no errors
            if (!document.querySelector('.validation-errors')) {
                const firstNameField = document.getElementById('first_name');
                if (firstNameField) {
                    firstNameField.focus();
                }
            }

            // Add visual feedback for form inputs
            const formInputs = document.querySelectorAll('.input-with-icon input, .input-with-icon select');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Auto-hide success messages after 5 seconds
            const successMessages = document.querySelectorAll('.success-message');
            successMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s';
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>
