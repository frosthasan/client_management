<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System - Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Additional styles for edit product page */
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
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .radio-option:hover {
            background-color: #f8f9fa;
            border-color: #3498db;
        }

        .radio-option input[type="radio"]:checked+label {
            color: #3498db;
            font-weight: 600;
        }

        .radio-option input[type="radio"]:checked~label {
            color: #3498db;
            font-weight: 600;
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

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
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

        .input-group {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
            width: 100%;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 8px 0 0 8px;
        }

        .input-group .form-control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            min-width: 0;
            border-radius: 0 8px 8px 0;
        }

        .pricing-option {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #27ae60;
        }

        .pricing-option h4 {
            margin: 0 0 5px 0;
            color: #2c3e50;
            font-size: 16px;
        }

        .pricing-option .text-muted {
            color: #7f8c8d;
            margin: 0;
            font-size: 13px;
        }

        /* Product info badge */
        .product-info-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 10px;
        }

        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .badge-coming-soon {
            background-color: #fff3cd;
            color: #856404;
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

            .radio-group {
                flex-direction: column;
                gap: 12px;
            }

            .pricing-option .row {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .pricing-option .col-md-4,
            .pricing-option .col-md-8 {
                width: 100%;
                margin-bottom: 15px;
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
                <a href="{{ route('product') }}"><i class="fas fa-box"></i> Product List</a>
                <span class="separator"><i class="fas fa-chevron-right"></i></span>
                <span><i class="fas fa-edit"></i> Edit Product </span>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-edit me-2"></i>Edit Product
                    @if($product->status == 1)
                    <span class="product-info-badge badge-active">
                        <i class="fas fa-check-circle"></i> Active
                    </span>
                    @elseif($product->status == 0)
                    <span class="product-info-badge badge-inactive">
                        <i class="fas fa-times-circle"></i> Inactive
                    </span>
                    @elseif($product->status == 2)
                    <span class="product-info-badge badge-coming-soon">
                        <i class="fas fa-clock"></i> Coming Soon
                    </span>
                    @endif
                </h1>
                <div class="page-actions">
                    <a href="{{ route('product') }}">
                        <button class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </button>
                    </a>
                    <a href="{{ route('add.product') }}">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New
                        </button>
                    </a>
                </div>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="form-header">
                    <h3><i class="fas fa-box"></i> Product Information</h3>
                    <div class="product-meta">
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Created: {{ $product->created_at->format('M d, Y') }} |
                            <i class="fas fa-sync-alt ms-3 me-1"></i>
                            Updated: {{ $product->updated_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                <div class="alert alert-success"
                    style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 20px;">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger"
                    style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; border: 1px solid #f5c6cb; margin-bottom: 20px;">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
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

                <form id="editProductForm" action="{{ route('product.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Product Information Section -->
                    <div class="form-section">
                        <div class="row">
                            <!-- Product Name Field -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="product_name">Software Name <span class="required">*</span></label>
                                    <input type="text" id="product_name" name="name"
                                        class="form-control @error('name') error @enderror"
                                        placeholder="Enter software name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                    <div class="error-message" id="nameError">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Group Dropdown -->
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="product_group_id">Product Group <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="product_group_id" name="product_group_id"
                                            class="form-control @error('product_group_id') error @enderror" required>
                                            <option value="">-- Select Product Group --</option>
                                            @foreach($productGroups as $group)
                                            <option value="{{ $group->id }}"
                                                {{ old('product_group_id', $product->product_group_id) == $group->id ? 'selected' : '' }}
                                                {{ !$group->is_active ? 'disabled' : '' }}>
                                                {{ $group->group_name }}
                                                @if(!$group->is_active)
                                                (Inactive)
                                                @endif
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('product_group_id')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <small class="form-help">Cannot select inactive groups. Change group status first.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Type Selection -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Pricing Type</span>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="pricing_type">Select Pricing Type <span
                                            class="required">*</span></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="pricing_type_one_time" name="pricing_type"
                                                value="one_time" {{ old('pricing_type', $product->pricing_type) == 'one_time' ? 'checked' : '' }}
                                                onchange="togglePricingOptions()">
                                            <label for="pricing_type_one_time">One-Time Purchase Only</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="pricing_type_recurring" name="pricing_type"
                                                value="recurring" {{ old('pricing_type', $product->pricing_type) == 'recurring' ? 'checked' : '' }}
                                                onchange="togglePricingOptions()">
                                            <label for="pricing_type_recurring">Recurring Subscription</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="pricing_type_both" name="pricing_type" value="both"
                                                {{ old('pricing_type', $product->pricing_type) == 'both' ? 'checked' : '' }}
                                                onchange="togglePricingOptions()">
                                            <label for="pricing_type_both">Both Options Available</label>
                                        </div>
                                    </div>
                                    @error('pricing_type')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Setup Fee (Common for all) -->
                    <div class="form-section">
                        <div class="section-title">
                            <i class="fas fa-cogs"></i>
                            <span>Setup Fee</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="setup_fee">Setup/Activation Fee ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="setup_fee" name="setup_fee" step="0.01"
                                            class="form-control @error('setup_fee') error @enderror" placeholder="0.00"
                                            value="{{ old('setup_fee', $product->setup_fee) }}">
                                    </div>
                                    @error('setup_fee')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <small class="form-help">One-time fee applied to first purchase</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- One-Time Pricing Option -->
                    <div class="form-section" id="one_time_pricing_section"
                        style="{{ in_array(old('pricing_type', $product->pricing_type), ['one_time', 'both']) ? '' : 'display: none;' }}">
                        <div class="section-title">
                            <i class="fas fa-shopping-cart"></i>
                            <span>One-Time Purchase Price</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="price_one_time">One-Time Price ($) <span
                                            class="required">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="price_one_time" name="price_one_time" step="0.01"
                                            class="form-control @error('price_one_time') error @enderror"
                                            placeholder="0.00"
                                            value="{{ old('price_one_time', $product->price_one_time) }}"
                                            {{ in_array(old('pricing_type', $product->pricing_type), ['one_time', 'both']) ? 'required' : '' }}>
                                    </div>
                                    @error('price_one_time')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <small class="form-help">Customer pays once for lifetime access</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recurring Pricing Options -->
                    <div class="form-section" id="recurring_pricing_section"
                        style="{{ in_array(old('pricing_type', $product->pricing_type), ['recurring', 'both']) ? '' : 'display: none;' }}">
                        <div class="section-title">
                            <i class="fas fa-redo"></i>
                            <span>Recurring Subscription Options</span>
                        </div>

                        <!-- Monthly Subscription -->
                        <div class="pricing-option">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h4>Monthly Subscription</h4>
                                    <p class="text-muted">Billed every month</p>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_monthly">Monthly Price ($) <span
                                                        class="required">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="price_monthly" name="price_monthly"
                                                        step="0.01"
                                                        class="form-control @error('price_monthly') error @enderror"
                                                        placeholder="0.00"
                                                        value="{{ old('price_monthly', $product->price_monthly) }}"
                                                        {{ in_array(old('pricing_type', $product->pricing_type), ['recurring', 'both']) ? 'required' : '' }}>
                                                </div>
                                                @error('price_monthly')
                                                <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="monthly_yearly_savings">Equivalent Yearly</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="monthly_yearly_savings"
                                                        class="form-control" readonly
                                                        value="{{ $product->price_monthly ? number_format($product->price_monthly * 12, 2) : '0.00' }}">
                                                </div>
                                                <small class="form-help">Monthly × 12</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Yearly Subscription -->
                        <div class="pricing-option">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h4>Yearly Subscription</h4>
                                    <p class="text-muted">Billed annually (Save ~17%)</p>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_yearly">Yearly Price ($)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="price_yearly" name="price_yearly"
                                                        step="0.01"
                                                        class="form-control @error('price_yearly') error @enderror"
                                                        placeholder="0.00"
                                                        value="{{ old('price_yearly', $product->price_yearly) }}">
                                                </div>
                                                @error('price_yearly')
                                                <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="yearly_monthly_equivalent">Monthly Equivalent</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="yearly_monthly_equivalent"
                                                        class="form-control" readonly
                                                        value="{{ $product->price_yearly ? number_format($product->price_yearly / 12, 2) : '0.00' }}">
                                                </div>
                                                <small class="form-help">Yearly ÷ 12</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quarterly Subscription -->
                        <div class="pricing-option">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h4>Quarterly Subscription</h4>
                                    <p class="text-muted">Billed every 3 months</p>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price_quarterly">Quarterly Price ($)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" id="price_quarterly" name="price_quarterly"
                                                        step="0.01"
                                                        class="form-control @error('price_quarterly') error @enderror"
                                                        placeholder="0.00"
                                                        value="{{ old('price_quarterly', $product->price_quarterly) }}">
                                                </div>
                                                @error('price_quarterly')
                                                <div class="error-message">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quarterly_monthly_equivalent">Monthly Equivalent</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="quarterly_monthly_equivalent"
                                                        class="form-control" readonly
                                                        value="{{ $product->price_quarterly ? number_format($product->price_quarterly / 3, 2) : '0.00' }}">
                                                </div>
                                                <small class="form-help">Quarterly ÷ 3</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="form-section">
                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="status">Status <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="status" name="status"
                                            class="form-control @error('status') error @enderror" required>
                                            <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                            <option value="2" {{ old('status', $product->status) == '2' ? 'selected' : '' }}>Coming Soon</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Version -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="version">Software Version</label>
                                    <input type="text" id="version" name="version"
                                        class="form-control @error('version') error @enderror" placeholder="e.g., 2.0.1"
                                        value="{{ old('version', $product->version) }}">
                                    @error('version')
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
                                        placeholder="Enter software description"
                                        rows="4">{{ old('description', $product->description) }}</textarea>
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
                            required. Setup fee applies once for all purchase types.</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('product') }}" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                      {{--<button type="button" class="btn btn-danger" id="deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Delete
                        </button>--}}
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-2"></i>Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       {{-- <h5 class="modal-title" id="deleteModalLabel">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                            Confirm Deletion
                        </h5>--}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{--<div class="modal-body">
                        <p>Are you sure you want to delete <strong>"{{ $product->name }}"</strong>?</p>
                        <p class="text-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            This action cannot be undone. All associated data will be permanently deleted.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Delete Product
                            </button>
                        </form>
                    </div>--}}
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>

    <script>
        // Toggle pricing sections
        function togglePricingOptions() {
            const pricingType = document.querySelector('input[name="pricing_type"]:checked');
            const oneTimeSection = document.getElementById('one_time_pricing_section');
            const recurringSection = document.getElementById('recurring_pricing_section');

            // Get required fields
            const oneTimePrice = document.getElementById('price_one_time');
            const monthlyPrice = document.getElementById('price_monthly');

            if (pricingType) {
                // Show/hide sections
                if (pricingType.value === 'one_time') {
                    oneTimeSection.style.display = 'block';
                    recurringSection.style.display = 'none';

                    // Set required attributes
                    if (oneTimePrice) oneTimePrice.required = true;
                    if (monthlyPrice) monthlyPrice.required = false;
                }
                else if (pricingType.value === 'recurring') {
                    oneTimeSection.style.display = 'none';
                    recurringSection.style.display = 'block';

                    // Set required attributes
                    if (oneTimePrice) oneTimePrice.required = false;
                    if (monthlyPrice) monthlyPrice.required = true;
                }
                else if (pricingType.value === 'both') {
                    oneTimeSection.style.display = 'block';
                    recurringSection.style.display = 'block';

                    // Set required attributes
                    if (oneTimePrice) oneTimePrice.required = true;
                    if (monthlyPrice) monthlyPrice.required = true;
                }

                // Recalculate equivalent prices
                calculateEquivalentPrices();
            }
        }

        // Calculate equivalent prices
        function calculateEquivalentPrices() {
            // Monthly to yearly equivalent
            const monthlyPrice = parseFloat(document.getElementById('price_monthly').value) || 0;
            document.getElementById('monthly_yearly_savings').value = (monthlyPrice * 12).toFixed(2);

            // Yearly to monthly equivalent
            const yearlyPrice = parseFloat(document.getElementById('price_yearly').value) || 0;
            document.getElementById('yearly_monthly_equivalent').value = (yearlyPrice / 12).toFixed(2);

            // Quarterly to monthly equivalent
            const quarterlyPrice = parseFloat(document.getElementById('price_quarterly').value) || 0;
            document.getElementById('quarterly_monthly_equivalent').value = (quarterlyPrice / 3).toFixed(2);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            togglePricingOptions();

            // Add event listeners for price changes
            document.getElementById('price_monthly').addEventListener('input', calculateEquivalentPrices);
            document.getElementById('price_yearly').addEventListener('input', calculateEquivalentPrices);
            document.getElementById('price_quarterly').addEventListener('input', calculateEquivalentPrices);

            // Form submission validation
            document.getElementById('editProductForm').addEventListener('submit', function(e) {
                // Additional validation can be added here
                const productName = document.getElementById('product_name').value.trim();
                if (!productName) {
                    e.preventDefault();
                    alert('Product name is required!');
                    return false;
                }
            });

            // Delete confirmation
            document.getElementById('deleteBtn').addEventListener('click', function() {
                // Modal is handled by Bootstrap
            });
        });
    </script>
</body>

</html>
