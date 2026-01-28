<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
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
                                    <option value="{{ $customer->id }}" {{ old('customer_id')==$customer->id ?
                                        'selected' : '' }}>
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
                                <select id="product_id" name="product_id" class="form-control" required
                                    onchange="updateBillingOptions()">
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-pricing-type="{{ $product->pricing_type }}"
                                        data-price-one-time="{{ $product->price_one_time }}"
                                        data-price-monthly="{{ $product->price_monthly }}"
                                        data-price-yearly="{{ $product->price_yearly }}"
                                        data-price-quarterly="{{ $product->price_quarterly }}" {{
                                        old('product_id')==$product->id ? 'selected' : '' }}>
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

                        <!-- Domain Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <input type="text" id="domain" name="domain" class="form-control"
                                    placeholder="Enter domain (e.g., example.com)" value="{{ old('domain') }}">
                                @error('domain')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Billing Cycle -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="billing_cycle">Billing Cycle <span class="required">*</span></label>
                                <select id="billing_cycle" name="billing_cycle" class="form-control" required
                                    onchange="updatePriceAndExpireDate()">
                                    <option value="">-- Select Billing Cycle --</option>
                                    <option value="one_time" {{ old('billing_cycle')=='one_time' ? 'selected' : '' }}>
                                        One-Time</option>
                                    <option value="monthly" {{ old('billing_cycle')=='monthly' ? 'selected' : '' }}>
                                        Monthly</option>
                                    <option value="quarterly" {{ old('billing_cycle')=='quarterly' ? 'selected' : '' }}>
                                        Quarterly</option>
                                    <option value="yearly" {{ old('billing_cycle')=='yearly' ? 'selected' : '' }}>Yearly
                                    </option>
                                </select>
                                @error('billing_cycle')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price ($) <span class="required">*</span></label>
                                <input type="number" id="price" name="price" class="form-control" step="0.01"
                                    placeholder="0.00" value="{{ old('price') }}" required readonly>
                                @error('price')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="form-help text-muted">Price is automatically set based on product and
                                    billing cycle</small>
                            </div>
                        </div>

                        <!-- Paid Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="paid_date">Paid Date <span class="required">*</span></label>
                                <input type="date" id="paid_date" name="paid_date" class="form-control"
                                    value="{{ old('paid_date', date('Y-m-d')) }}" required
                                    onchange="updateExpireDate()">
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
                                    value="{{ old('expire_date') }}" required readonly>
                                @error('expire_date')
                                <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="form-help text-muted">Expire date is automatically calculated based on
                                    billing cycle</small>
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

                <!-- JavaScript for dynamic calculations -->
                <script>
                    function updateBillingOptions() {
    const productSelect = document.getElementById('product_id');
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    const billingCycleSelect = document.getElementById('billing_cycle');

    // Get product pricing type and available options
    const pricingType = selectedOption.getAttribute('data-pricing-type');

    // Reset and enable all options first
    for (let option of billingCycleSelect.options) {
        option.disabled = false;
        option.style.display = '';
    }

    // Disable options based on product pricing type
    if (pricingType === 'one_time') {
        disableBillingOptions(['monthly', 'quarterly', 'yearly']);
    } else if (pricingType === 'recurring') {
        disableBillingOptions(['one_time']);
    }
    // For 'both' type, all options remain enabled

    // Reset price and expire date
    document.getElementById('price').value = '';
    document.getElementById('expire_date').value = '';

    // Update price if billing cycle is already selected
    if (billingCycleSelect.value) {
        updatePriceAndExpireDate();
    }
}

function disableBillingOptions(optionsToDisable) {
    const billingCycleSelect = document.getElementById('billing_cycle');

    for (let option of billingCycleSelect.options) {
        if (optionsToDisable.includes(option.value)) {
            option.disabled = true;
            if (option.selected) {
                option.selected = false;
            }
        }
    }
}

function updatePriceAndExpireDate() {
    const productSelect = document.getElementById('product_id');
    const selectedProductOption = productSelect.options[productSelect.selectedIndex];
    const billingCycle = document.getElementById('billing_cycle').value;
    const paidDate = document.getElementById('paid_date').value;

    if (!selectedProductOption.value || !billingCycle) return;

    // Update price based on billing cycle
    let price = '';
    switch(billingCycle) {
        case 'one_time':
            price = selectedProductOption.getAttribute('data-price-one-time');
            break;
        case 'monthly':
            price = selectedProductOption.getAttribute('data-price-monthly');
            break;
        case 'quarterly':
            price = selectedProductOption.getAttribute('data-price-quarterly');
            break;
        case 'yearly':
            price = selectedProductOption.getAttribute('data-price-yearly');
            break;
    }

    document.getElementById('price').value = price || '';

    // Update expire date if paid date is set
    if (paidDate) {
        updateExpireDate();
    }
}

function updateExpireDate() {
    const paidDate = document.getElementById('paid_date').value;
    const billingCycle = document.getElementById('billing_cycle').value;

    if (!paidDate || !billingCycle) return;

    const paidDateObj = new Date(paidDate);
    let expireDate = new Date(paidDateObj);

    switch(billingCycle) {
        case 'one_time':
            // For one-time, set expire date far in the future (e.g., 100 years)
            expireDate.setFullYear(expireDate.getFullYear() + 100);
            break;
        case 'monthly':
            expireDate.setMonth(expireDate.getMonth() + 1);
            break;
        case 'quarterly':
            expireDate.setMonth(expireDate.getMonth() + 3);
            break;
        case 'yearly':
            expireDate.setFullYear(expireDate.getFullYear() + 1);
            break;
    }

    // Format date as YYYY-MM-DD
    const formattedDate = expireDate.toISOString().split('T')[0];
    document.getElementById('expire_date').value = formattedDate;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Set default paid date to today if not already set
    if (!document.getElementById('paid_date').value) {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('paid_date').value = today;
    }

    // Initialize billing options if product is selected
    const productSelect = document.getElementById('product_id');
    if (productSelect.value) {
        updateBillingOptions();
    }
});
                </script>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>
</body>

</html>
