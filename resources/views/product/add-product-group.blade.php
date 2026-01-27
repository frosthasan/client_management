<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System - Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Additional styles for add user page */
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

        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-option input[type="radio"] {
            margin: 0;
            width: 18px;
            height: 18px;
        }

        .radio-option label {
            margin: 0;
            font-weight: normal;
            cursor: pointer;
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .checkbox-option input[type="checkbox"] {
            margin: 0;
            width: 18px;
            height: 18px;
        }

        .checkbox-option label {
            margin: 0;
            font-weight: normal;
            cursor: pointer;
        }

        .select-wrapper {
            position: relative;
        }

        .select-wrapper:after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            pointer-events: none;
        }

        .avatar-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .avatar-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7f8c8d;
            font-weight: 600;
            font-size: 36px;
            text-transform: uppercase;
            border: 3px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .btn-avatar-upload {
            padding: 8px 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #2c3e50;
            transition: all 0.3s;
        }

        .btn-avatar-upload:hover {
            background-color: #e9ecef;
        }

        .file-input {
            display: none;
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

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.2);
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

        .password-input-wrapper {
            position: relative;
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

            .radio-group,
            .checkbox-group {
                flex-direction: column;
                gap: 12px;
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
                <a href="{{ route('add.product.group') }}"><i class="fas fa-users"></i> User List</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span><i class="fas fa-user-plus"></i> Add Product Group</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-user-plus me-2"></i>Add New Product Group</h1>
                <div class="page-actions">
                    <a href="{{ route('product.group') }}">
                        <button class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </button>
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h3><i class="fas fa-user-circle"></i>Product Group Information</h3>
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
                <form id="addUserForm" action="{{ route('product-group.store') }}" method="POST">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <div class="row">
                            <!-- Full width Name Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="group_name">Product Group Name <span class="required">*</span></label>
                                    <input type="text" id="group_name" name="group_name"
                                        class="form-control @error('group_name') error @enderror"
                                        placeholder="Enter group name" value="{{ old('group_name') }}" required>
                                    @error('group_name')
                                    <div class="error-message" id="firstNameError">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Full width Description Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description"
                                        class="form-control @error('description') error @enderror"
                                        placeholder="Enter description for this product group"
                                        rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="form-footer">
                        <p><i class="fas fa-info-circle"></i> Fields marked with <span class="required">*</span> are
                            required. All information will be kept confidential and secure.</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('users') }}" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-check me-2"></i>Create Client
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>
</body>

</html>
