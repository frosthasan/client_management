<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .form-header {
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

        .form-group {
            margin-bottom: 25px;
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
            text-decoration: none;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
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

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 10px;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 10px;
        }

        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
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
                <a href="{{ route('services') }}"><i class="fas fa-cogs"></i> Services</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span><i class="fas fa-plus-circle"></i> Add Service</span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-plus-circle me-2"></i>Add New Service</h1>
                <div class="page-actions">
                    <a href="{{ route('services') }}">
                        <button class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </button>
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h3><i class="fas fa-cog"></i>Service Information</h3>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>{{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Customer Selection -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_id">Customer <span class="required">*</span></label>
                                <select id="customer_id" name="customer_id" class="form-control" required>
                                    <option value="">-- Select Customer --</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                        @if($customer->company_name)
                                        ({{ $customer->company_name }})
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Product Selection -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">Product <span class="required">*</span></label>
                                <select id="product_id" name="product_id" class="form-control" required>
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                        @if($product->productGroup)
                                        ({{ $product->productGroup->group_name }})
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Package Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="package_name">Package Name <span class="required">*</span></label>
                                <input type="text" id="package_name" name="package_name" class="form-control"
                                    placeholder="Enter package name" value="{{ old('package_name') }}" required>
                                @error('package_name')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price ($) <span class="required">*</span></label>
                                <input type="number" id="price" name="price" class="form-control"
                                    step="0.01" placeholder="0.00" value="{{ old('price') }}" required>
                                @error('price')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Paid Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid_date">Paid Date <span class="required">*</span></label>
                                <input type="date" id="paid_date" name="paid_date" class="form-control"
                                    value="{{ old('paid_date') }}" required>
                                @error('paid_date')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Expire Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="expire_date">Expire Date <span class="required">*</span></label>
                                <input type="date" id="expire_date" name="expire_date" class="form-control"
                                    value="{{ old('expire_date') }}" required>
                                @error('expire_date')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status (Optional) -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                @error('status')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes (Optional) -->
                        <div class="col-12">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea id="notes" name="notes" class="form-control"
                                    placeholder="Enter any additional notes" rows="3">{{ old('notes') }}</textarea>
                                @error('notes')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('services') }}" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>Create Service
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
