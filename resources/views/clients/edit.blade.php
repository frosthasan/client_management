<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System - Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Copy all the styles from your create.blade.php */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .page-header h1 {
            font-size: 24px;
            color: #2c3e50;
            margin: 0;
        }

        .page-actions {
            display: flex;
            gap: 10px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            font-size: 14px;
            color: #7f8c8d;
        }

        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #2980b9;
        }

        .breadcrumb .separator {
            color: #bdc3c7;
        }

        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .form-header h3 {
            margin: 0;
            font-size: 18px;
            color: #2c3e50;
        }

        .form-header h3 i {
            margin-right: 10px;
            color: #3498db;
        }

        .form-section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f1f1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #3498db;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group label .required {
            color: #e74c3c;
            margin-left: 4px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .form-control.success {
            border-color: #27ae60;
        }

        .form-help {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .password-option-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .password-option-group .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-option-group .form-check-input {
            margin: 0;
        }

        .password-option-group .form-check-label {
            margin: 0;
            cursor: pointer;
        }

        .password-input-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 14px;
        }

        .password-strength {
            height: 5px;
            background-color: #ecf0f1;
            border-radius: 3px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .strength-weak {
            background-color: #e74c3c;
        }

        .strength-medium {
            background-color: #f39c12;
        }

        .strength-strong {
            background-color: #27ae60;
        }

        .strength-very-strong {
            background-color: #2ecc71;
        }

        .password-requirements {
            list-style: none;
            padding: 0;
            margin: 10px 0 0 0;
            font-size: 12px;
        }

        .password-requirements li {
            margin-bottom: 4px;
            color: #95a5a6;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-requirements li.requirement-met {
            color: #27ae60;
        }

        .password-requirements li i {
            font-size: 10px;
        }

        .character-count {
            font-size: 12px;
            color: #95a5a6;
            text-align: right;
            margin-top: 5px;
        }

        .character-count.warning {
            color: #f39c12;
        }

        .character-count.error {
            color: #e74c3c;
        }

        .form-footer {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        .form-footer p {
            margin: 0;
            font-size: 13px;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-footer i {
            color: #3498db;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 30px;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 120px;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.2);
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Include Sidebar -->
    @include('layouts.inc.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Include Header -->
        @include('layouts.inc.header')

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('users') }}"><i class="fas fa-users"></i> User List</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span><i class="fas fa-user-edit"></i> Edit User</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-user-edit me-2"></i>Edit User: {{ $user->first_name }} {{ $user->last_name }}</h1>
                <div class="page-actions">
                    <a href="{{ route('users') }}">
                        <button class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </button>
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h3><i class="fas fa-user-circle"></i>Edit User Information</h3>
                    <div class="user-id-badge">
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-id-card me-1"></i> ID: US{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="alert alert-success"
                    style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 20px;">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger"
                    style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; border: 1px solid #f5c6cb; margin-bottom: 20px;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 8px 0 0 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="editUserForm" action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-id-card"></i>
                            <span>Client Basic Information</span>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="required">*</span></label>
                                <input type="text" id="first_name" name="first_name"
                                    class="form-control @error('first_name') error @enderror"
                                    placeholder="Enter first name" value="{{ old('first_name', $user->first_name) }}"
                                    required>
                                @error('first_name')
                                <div class="error-message" id="firstNameError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name <span class="required">*</span></label>
                                <input type="text" id="last_name" name="last_name"
                                    class="form-control @error('last_name') error @enderror"
                                    placeholder="Enter last name" value="{{ old('last_name', $user->last_name) }}"
                                    required>
                                @error('last_name')
                                <div class="error-message" id="lastNameError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control @error('company_name') error @enderror"
                                    placeholder="Enter company name"
                                    value="{{ old('company_name', $user->company_name) }}">
                                @error('company_name')
                                <div class="error-message" id="companyNameError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') error @enderror" placeholder="user@company.com"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                <div class="error-message" id="emailError">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label for="username">Username <span class="required">*</span></label>
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') error @enderror"
                                    placeholder="Choose a username" value="{{ old('username', $user->username) }}"
                                    required>
                                @error('username')
                                <div class="error-message" id="usernameError">{{ $message }}</div>
                                @enderror
                                <div class="character-count" id="usernameCount">
                                    {{ strlen($user->username) }}/20 characters
                                </div>
                            </div>--}}

                            <!-- Password Change Option -->
                            <div class="form-group">
                                <label for="change_password">Password Option</label>
                                <div class="password-option-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="password_option"
                                            id="keepPassword" value="keep" checked onchange="togglePasswordOption()">
                                        <label class="form-check-label" for="keepPassword">
                                            Keep Current Password
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="password_option"
                                            id="changePassword" value="change" onchange="togglePasswordOption()">
                                        <label class="form-check-label" for="changePassword">
                                            Change Password
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group password-input-wrapper" id="newPasswordField" style="display: none;">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') error @enderror"
                                    placeholder="Enter new password (leave blank to keep current)">
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="password-strength">
                                    <div class="strength-meter" id="passwordStrength"></div>
                                </div>
                                <ul class="password-requirements">
                                    <li id="reqLength"><i class="fas fa-times"></i> At least 8 characters</li>
                                    <li id="reqUppercase"><i class="fas fa-times"></i> One uppercase letter</li>
                                    <li id="reqLowercase"><i class="fas fa-times"></i> One lowercase letter</li>
                                    <li id="reqNumber"><i class="fas fa-times"></i> One number</li>
                                    <li id="reqSpecial"><i class="fas fa-times"></i> One special character</li>
                                </ul>
                                @error('password')
                                <div class="error-message" id="passwordError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group password-input-wrapper" id="confirmPasswordField"
                                style="display: none;">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" placeholder="Confirm new password">
                                <button type="button" class="toggle-password" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>📍 Address Information</span>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="address_line_1">Address Line 1 <span class="required">*</span></label>
                                <input type="text" id="address_line_1" name="address_line_1"
                                    class="form-control @error('address_line_1') error @enderror"
                                    placeholder="Enter address line 1"
                                    value="{{ old('address_line_1', $user->address_line_1) }}" required>
                                @error('address_line_1')
                                <div class="error-message" id="addressLine1Error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address_line_2">Address Line 2</label>
                                <input type="text" id="address_line_2" name="address_line_2"
                                    class="form-control @error('address_line_2') error @enderror"
                                    placeholder="Enter address line 2 (optional)"
                                    value="{{ old('address_line_2', $user->address_line_2) }}">
                                @error('address_line_2')
                                <div class="error-message" id="addressLine2Error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="city">City <span class="required">*</span></label>
                                <input type="text" id="city" name="city"
                                    class="form-control @error('city') error @enderror" placeholder="Enter city"
                                    value="{{ old('city', $user->city) }}" required>
                                @error('city')
                                <div class="error-message" id="cityError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="state">State / Region <span class="required">*</span></label>
                                <input type="text" id="state" name="state"
                                    class="form-control @error('state') error @enderror"
                                    placeholder="Enter state or region" value="{{ old('state', $user->state) }}"
                                    required>
                                @error('state')
                                <div class="error-message" id="stateError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="postcode">Postcode <span class="required">*</span></label>
                                <input type="text" id="postcode" name="postcode"
                                    class="form-control @error('postcode') error @enderror" placeholder="Enter postcode"
                                    value="{{ old('postcode', $user->postcode) }}" required>
                                @error('postcode')
                                <div class="error-message" id="postcodeError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="country">Country <span class="required">*</span></label>
                                <select id="country" name="country"
                                    class="form-control @error('country') error @enderror" required>
                                    <option value="">Select Country</option>
                                    <option value="Bangladesh" {{ old('country', $user->country) == 'Bangladesh' ?
                                        'selected' : '' }}>Bangladesh</option>
                                    <option value="USA" {{ old('country', $user->country) == 'USA' ? 'selected' : ''
                                        }}>United States</option>
                                    <option value="UK" {{ old('country', $user->country) == 'UK' ? 'selected' : ''
                                        }}>United Kingdom</option>
                                    <option value="Canada" {{ old('country', $user->country) == 'Canada' ? 'selected' :
                                        '' }}>Canada</option>
                                    <option value="Australia" {{ old('country', $user->country) == 'Australia' ?
                                        'selected' : '' }}>Australia</option>
                                    <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : ''
                                        }}>India</option>
                                </select>
                                @error('country')
                                <div class="error-message" id="countryError">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-phone-alt"></i>
                            <span>📞 Contact Information</span>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone"
                                    class="form-control @error('phone') error @enderror" placeholder="+1 (555) 123-4567"
                                    value="{{ old('phone', $user->phone) }}" required>
                                @error('phone')
                                <div class="error-message" id="phoneError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="language">Language</label>
                                <select id="language" name="language"
                                    class="form-control @error('language') error @enderror">
                                    <option value="">Select Language</option>
                                    <option value="en" {{ old('language', $user->language) == 'en' ? 'selected' : ''
                                        }}>English</option>
                                    <option value="bn" {{ old('language', $user->language) == 'bn' ? 'selected' : ''
                                        }}>Bengali</option>
                                    <option value="es" {{ old('language', $user->language) == 'es' ? 'selected' : ''
                                        }}>Spanish</option>
                                    <option value="fr" {{ old('language', $user->language) == 'fr' ? 'selected' : ''
                                        }}>French</option>
                                    <option value="de" {{ old('language', $user->language) == 'de' ? 'selected' : ''
                                        }}>German</option>
                                </select>
                                @error('language')
                                <div class="error-message" id="languageError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="currency">Currency <span class="required">*</span></label>
                                <select id="currency" name="currency"
                                    class="form-control @error('currency') error @enderror" required>
                                    <option value="">Select Currency</option>
                                    <option value="BDT" {{ old('currency', $user->currency) == 'BDT' ? 'selected' : ''
                                        }}>BDT - Bangladeshi Taka</option>
                                    <option value="USD" {{ old('currency', $user->currency) == 'USD' ? 'selected' : ''
                                        }}>USD - US Dollar</option>
                                    <option value="EUR" {{ old('currency', $user->currency) == 'EUR' ? 'selected' : ''
                                        }}>EUR - Euro</option>
                                    <option value="GBP" {{ old('currency', $user->currency) == 'GBP' ? 'selected' : ''
                                        }}>GBP - British Pound</option>
                                </select>
                                @error('currency')
                                <div class="error-message" id="currencyError">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Account Control Section -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-user-cog"></i>
                            <span>👤 Account Control</span>
                        </div>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="status">Client Status <span class="required">*</span></label>
                                <select id="status" name="status" class="form-control @error('status') error @enderror"
                                    required>
                                    <option value="1" {{ old('status', $user->status) == '1' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ old('status', $user->status) == '0' ? 'selected' : ''
                                        }}>Inactive</option>
                                    <option value="2" {{ old('status', $user->status) == '2' ? 'selected' : ''
                                        }}>Suspended</option>
                                </select>
                                @error('status')
                                <div class="error-message" id="statusError">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="client_group">Client Group <span class="required">*</span></label>
                                <select id="client_group" name="client_group"
                                    class="form-control @error('client_group') error @enderror" required>
                                    <option value="">Select Client Group</option>
                                    <option value="retail" {{ old('client_group', $user->client_group) == 'retail' ?
                                        'selected' : '' }}>Retail</option>
                                    <option value="reseller" {{ old('client_group', $user->client_group) == 'reseller' ?
                                        'selected' : '' }}>Reseller</option>
                                    <option value="corporate" {{ old('client_group', $user->client_group) == 'corporate'
                                        ? 'selected' : '' }}>Corporate</option>
                                    <option value="wholesale" {{ old('client_group', $user->client_group) == 'wholesale'
                                        ? 'selected' : '' }}>Wholesale</option>
                                </select>
                                @error('client_group')
                                <div class="error-message" id="clientGroupError">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="form-footer">
                        <p><i class="fas fa-info-circle"></i> Fields marked with <span class="required">*</span> are
                            required.
                            <span class="text-muted">Last updated: {{ $user->updated_at->format('Y-m-d H:i:s') }}</span>
                        </p>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('users') }}" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>Update User
                        </button>
                    </div>
                </form>

                <script>
                    function togglePasswordOption() {
    console.log('togglePasswordOption called');
    const keepPassword = document.getElementById('keepPassword');
    const newPasswordField = document.getElementById('newPasswordField');
    const confirmPasswordField = document.getElementById('confirmPasswordField');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    if (keepPassword.checked) {
        newPasswordField.style.display = 'none';
        confirmPasswordField.style.display = 'none';

        if (passwordInput) {
            passwordInput.removeAttribute('required');
            passwordInput.value = '';
            passwordInput.disabled = true; // Disable the field
            passwordInput.setAttribute('data-original-name', 'password'); // Store original name
            passwordInput.removeAttribute('name'); // Remove name so it won't be submitted
        }
        if (confirmPasswordInput) {
            confirmPasswordInput.removeAttribute('required');
            confirmPasswordInput.value = '';
            confirmPasswordInput.disabled = true; // Disable the field
            confirmPasswordInput.setAttribute('data-original-name', 'password_confirmation'); // Store original name
            confirmPasswordInput.removeAttribute('name'); // Remove name so it won't be submitted
        }
    } else {
        newPasswordField.style.display = 'block';
        confirmPasswordField.style.display = 'block';

        if (passwordInput) {
            passwordInput.disabled = false; // Enable the field
            const originalName = passwordInput.getAttribute('data-original-name') || 'password';
            passwordInput.setAttribute('name', originalName); // Restore name attribute
            passwordInput.setAttribute('required', 'required');
        }
        if (confirmPasswordInput) {
            confirmPasswordInput.disabled = false; // Enable the field
            const originalName = confirmPasswordInput.getAttribute('data-original-name') || 'password_confirmation';
            confirmPasswordInput.setAttribute('name', originalName); // Restore name attribute
            confirmPasswordInput.setAttribute('required', 'required');
        }
    }
}

                    // Initialize on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        console.log('DOM loaded');
                        togglePasswordOption();

                        // Add event listeners for radio buttons
                        document.getElementById('keepPassword').addEventListener('change', togglePasswordOption);
                        document.getElementById('changePassword').addEventListener('change', togglePasswordOption);

                        // Initialize password toggle functionality
                        initializePasswordToggles();

                        // Initialize character counter for username
                        initializeUsernameCounter();
                    });

                    function initializePasswordToggles() {
                        // Toggle password visibility
                        const togglePassword = document.getElementById('togglePassword');
                        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                        const passwordInput = document.getElementById('password');
                        const confirmPasswordInput = document.getElementById('password_confirmation');

                        if (togglePassword && passwordInput) {
                            togglePassword.addEventListener('click', function() {
                                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                passwordInput.setAttribute('type', type);
                                this.querySelector('i').classList.toggle('fa-eye');
                                this.querySelector('i').classList.toggle('fa-eye-slash');
                            });
                        }

                        if (toggleConfirmPassword && confirmPasswordInput) {
                            toggleConfirmPassword.addEventListener('click', function() {
                                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                                confirmPasswordInput.setAttribute('type', type);
                                this.querySelector('i').classList.toggle('fa-eye');
                                this.querySelector('i').classList.toggle('fa-eye-slash');
                            });
                        }

                        // Password strength checker
                        if (passwordInput) {
                            passwordInput.addEventListener('input', function() {
                                checkPasswordStrength(this.value);
                            });
                        }
                    }

                    function checkPasswordStrength(password) {
                        let strength = 0;
                        const requirements = {
                            length: password.length >= 8,
                            uppercase: /[A-Z]/.test(password),
                            lowercase: /[a-z]/.test(password),
                            number: /[0-9]/.test(password),
                            special: /[^A-Za-z0-9]/.test(password)
                        };

                        // Update requirement indicators
                        Object.keys(requirements).forEach((key) => {
                            const requirementId = 'req' + key.charAt(0).toUpperCase() + key.slice(1);
                            const requirementElement = document.getElementById(requirementId);
                            if (requirementElement) {
                                if (requirements[key]) {
                                    requirementElement.classList.add('requirement-met');
                                    const icon = requirementElement.querySelector('i');
                                    if (icon) {
                                        icon.classList.remove('fa-times');
                                        icon.classList.add('fa-check');
                                    }
                                    strength++;
                                } else {
                                    requirementElement.classList.remove('requirement-met');
                                    const icon = requirementElement.querySelector('i');
                                    if (icon) {
                                        icon.classList.remove('fa-check');
                                        icon.classList.add('fa-times');
                                    }
                                }
                            }
                        });

                        // Update strength meter
                        const strengthElement = document.getElementById('passwordStrength');
                        if (strengthElement) {
                            let strengthClass = 'strength-weak';
                            let width = 25;

                            if (strength === 5) {
                                strengthClass = 'strength-very-strong';
                                width = 100;
                            } else if (strength >= 4) {
                                strengthClass = 'strength-strong';
                                width = 75;
                            } else if (strength >= 3) {
                                strengthClass = 'strength-medium';
                                width = 50;
                            }

                            strengthElement.className = 'strength-meter ' + strengthClass;
                            strengthElement.style.width = width + '%';
                        }
                    }

                    // Form validation before submission
                    document.getElementById('editUserForm').addEventListener('submit', function(e) {
                        const changePassword = document.getElementById('changePassword');
                        const passwordInput = document.getElementById('password');
                        const confirmPasswordInput = document.getElementById('password_confirmation');

                        if (changePassword.checked) {
                            if (passwordInput.value !== confirmPasswordInput.value) {
                                e.preventDefault();
                                alert('Password and confirmation do not match!');
                                return false;
                            }

                            if (passwordInput.value.length < 8) {
                                e.preventDefault();
                                alert('Password must be at least 8 characters long!');
                                return false;
                            }
                        }

                        return true;
                    });
                </script>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>
</body>

</html>
