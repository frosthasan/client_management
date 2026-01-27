<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product Group - User Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Same styles as add-product-group.blade.php */
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

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
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
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
        }

        .form-footer {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        @media (max-width: 768px) {
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
    @include('layouts.inc.sidebar')

    <div class="main-content">
        @include('layouts.inc.header')

        <div class="content-wrapper">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route('product.group') }}"><i class="fas fa-layer-group"></i> Product Groups</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span><i class="fas fa-edit"></i> Edit Product Group</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-edit me-2"></i>Edit Product Group</h1>
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
                    <h3><i class="fas fa-layer-group"></i>Edit Product Group Information</h3>
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

                <form action="{{ route('product-group.update', $productGroup->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <div class="row">
                            <!-- Group Name Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="group_name">Product Group Name <span class="required">*</span></label>
                                    <input type="text" id="group_name" name="group_name"
                                        class="form-control @error('group_name') error @enderror"
                                        placeholder="Enter group name"
                                        value="{{ old('group_name', $productGroup->group_name) }}" required>
                                    @error('group_name')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description"
                                        class="form-control @error('description') error @enderror"
                                        placeholder="Enter description for this product group"
                                        rows="4">{{ old('description', $productGroup->description) }}</textarea>
                                    @error('description')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status <span class="required">*</span></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="status_active" name="is_active" value="1" {{
                                                old('is_active', $productGroup->is_active) == 1 ? 'checked' : '' }}>
                                            <label for="status_active">Active</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status_inactive" name="is_active" value="0" {{
                                                old('is_active', $productGroup->is_active) == 0 ? 'checked' : '' }}>
                                            <label for="status_inactive">Inactive</label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Footer -->
                    <div class="form-footer">
                        <p><i class="fas fa-info-circle"></i> Fields marked with <span class="required">*</span> are
                            required. All changes will be saved immediately upon submission.</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('product.group') }}" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>Update Product Group
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.inc.footer')
    </div>
</body>

</html>
