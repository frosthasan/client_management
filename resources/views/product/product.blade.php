<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System - User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Additional styles for user list page */
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

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }

        .user-list-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .user-list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .user-list-header h3 {
            margin: 0;
            font-size: 18px;
            color: #2c3e50;
        }

        .list-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .pagination-info {
            font-size: 14px;
            color: #7f8c8d;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
            font-size: 14px;
        }

        .user-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #495057;
        }

        .user-table tr:hover {
            background-color: #f8f9fa;
        }

        .user-table tr:last-child td {
            border-bottom: none;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
        }

        .user-avatar.corporate {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
        }

        .user-avatar.reseller {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .user-avatar.individual {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .user-avatar.enterprise {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .status-inactive {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .status-pending {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f39c12;
        }

        .status-suspended {
            background-color: rgba(52, 73, 94, 0.1);
            color: #34495e;
        }

        .role-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            background-color: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .role-badge.admin {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border-color: rgba(231, 76, 60, 0.2);
        }

        .role-badge.manager {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
            border-color: rgba(155, 89, 182, 0.2);
        }

        .role-badge.staff {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
            border-color: rgba(52, 152, 219, 0.2);
        }

        .role-badge.user {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border-color: rgba(46, 204, 113, 0.2);
        }

        .group-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .group-badge.corporate {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
            border: 1px solid rgba(155, 89, 182, 0.2);
        }

        .group-badge.reseller {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
            border: 1px solid rgba(52, 152, 219, 0.2);
        }

        .group-badge.individual {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.2);
        }

        .group-badge.enterprise {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        .group-badge.premium {
            background-color: rgba(243, 156, 18, 0.1);
            color: #f39c12;
            border: 1px solid rgba(243, 156, 18, 0.2);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-view {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .btn-view:hover {
            background-color: #3498db;
            color: white;
        }

        .btn-edit {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .btn-edit:hover {
            background-color: #27ae60;
            color: white;
        }

        .btn-delete {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .btn-delete:hover {
            background-color: #e74c3c;
            color: white;
        }

        .btn-activate {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .btn-activate:hover {
            background-color: #27ae60;
            color: white;
        }

        .btn-suspend {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f39c12;
        }

        .btn-suspend:hover {
            background-color: #f39c12;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .pagination-btn {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            background: white;
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination-btn:hover {
            background-color: #f8f9fa;
            border-color: #3498db;
        }

        .pagination-btn.active {
            background-color: #3498db;
            color: white;
            border-color: #3498db;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #7f8c8d;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #bdc3c7;
        }

        .empty-state h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .empty-state p {
            max-width: 400px;
            margin: 0 auto 20px;
            line-height: 1.6;
        }

        .user-infos {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .user-email {
            font-size: 12px;
            color: #7f8c8d;
        }

        .text-muted {
            color: #95a5a6;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
        }

        .btn-text {
            background: none;
            color: #3498db;
            padding: 8px 15px;
        }

        .btn-text:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .search-box {
                width: 100%;
            }

            .user-list-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .list-actions {
                width: 100%;
                justify-content: space-between;
            }

            .user-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('layouts.inc.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        @include('layouts.inc.header')

        <!-- Main Content Area -->
        <div class="content-wrapper">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-users me-2"></i>Product List</h1>
                <div class="page-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchUsers" placeholder="Search Product...">
                    </div>
                    <a href="{{ route('add.product') }}">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Add Product
                        </button>
                    </a>
                </div>
            </div>

            <!-- User List Table -->
            <div class="user-list-container">
                <div class="user-list-header">
                    <h3>All Product <span class="text-muted">({{ $totalProducts }} Product)</span></h3>
                    <div class="list-actions">
                        <div class="pagination-info">
                            Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{
                            $totalProducts }}
                        </div>
                        {{--<div class="dropdown">
                            <button class="btn btn-text dropdown-toggle">
                                <i class="fas fa-download me-2"></i>Export
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"><i class="fas fa-file-excel me-2"></i>Excel</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-file-pdf me-2"></i>PDF</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-file-csv me-2"></i>CSV</a>
                            </div>
                        </div>--}}
                    </div>
                </div>

                <div class="table-responsive">
                   <table class="user-table">
    <thead>
        <tr>
            <th style="width: 60px;">ID</th>
            <th>Product Name</th>
            <th>Product Group</th>
            <th>Pricing Type</th>
            <th>Setup Fee</th>
            <th>Prices</th>
            <th>Status</th>
            <th>Created At</th>
            <th style="width: 160px;">Actions</th>
        </tr>
    </thead>
    <tbody id="userListBody">
        @foreach($products as $product)
        <tr>
            <td class="product-id">PR{{ str_pad($product->id, 3, '0', STR_PAD_LEFT) }}</td>
            <td>
                <strong class="product-name">{{ $product->name }}</strong>
                @if($product->version)
                    <small class="text-muted">v{{ $product->version }}</small>
                @endif
            </td>
            <td>
                @if($product->productGroup)
                    <span class="badge bg-info">{{ $product->productGroup->group_name }}</span>
                @else
                    <span class="badge bg-secondary">N/A</span>
                @endif
            </td>
            <td class="pricing-type">
                @if($product->pricing_type == 'one_time')
                    <span class="badge bg-primary">One-Time</span>
                @elseif($product->pricing_type == 'recurring')
                    <span class="badge bg-success">Recurring</span>
                @elseif($product->pricing_type == 'both')
                    <span class="badge bg-warning">Both</span>
                @endif
            </td>
            <td class="setup-fee">
                ${{ number_format($product->setup_fee, 2) }}
            </td>
            <td class="prices">
                <div style="display: flex; flex-direction: column; gap: 3px; font-size: 12px;">
                    @if($product->price_one_time)
                        <span><strong>One-time:</strong> ${{ number_format($product->price_one_time, 2) }}</span>
                    @endif
                    @if($product->price_monthly)
                        <span><strong>Monthly:</strong> ${{ number_format($product->price_monthly, 2) }}</span>
                    @endif
                    @if($product->price_yearly)
                        <span><strong>Yearly:</strong> ${{ number_format($product->price_yearly, 2) }}</span>
                    @endif
                    @if($product->price_quarterly)
                        <span><strong>Quarterly:</strong> ${{ number_format($product->price_quarterly, 2) }}</span>
                    @endif
                </div>
            </td>
            <td class="product-status">
                @if($product->status == 1)
                <span class="status-badge status-active">Active</span>
                @elseif($product->status == 0)
                <span class="status-badge status-inactive">Inactive</span>
                @elseif($product->status == 2)
                <span class="status-badge status-coming-soon">Coming Soon</span>
                @endif
            </td>
            <td class="created-date">{{ $product->created_at->format('Y-m-d') }}</td>
            <td>
                <div class="action-buttons">
                    <!-- View Button -->
            {{--<button class="btn-icon btn-view view-product" title="View Details"
                        data-id="{{ $product->id }}">
                        <i class="fas fa-eye"></i>
                    </button>--}}

                    <!-- Edit Button -->
                    <a href="{{ route('product.edit', $product->id) }}"
                        class="btn-icon btn-edit" title="Edit Product">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('product.destroy', $product->id) }}"
                          method="POST"
                          class="d-inline delete-form"
                          data-id="{{ $product->id }}"
                          data-name="{{ $product->name }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                class="btn-icon btn-delete delete-product"
                                title="Delete Product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach

        @if($products->isEmpty())
        <tr>
            <td colspan="9" style="text-align: center; padding: 40px;">
                <i class="fas fa-box"
                    style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
                <h4 style="color: #999; margin-bottom: 10px;">No Products found</h4>
                <p style="color: #aaa;">Click "Add Product" to create your first product.</p>
            </td>
        </tr>
        @endif
    </tbody>
</table>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Confirm Delete</h3>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <p>Are you sure you want to delete the product <strong id="deleteProductName"></strong>?</p>
            <p class="text-muted">This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary close-modal">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let currentForm = null;

        // Delete button click handler
        $('.delete-product').on('click', function() {
            currentForm = $(this).closest('form');
            const productName = currentForm.data('name');

            $('#deleteProductName').text(productName);
            $('#deleteModal').fadeIn();
        });

        // Confirm delete
        $('#confirmDelete').on('click', function() {
            if (currentForm) {
                // Show loading
                $(this).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
                $(this).prop('disabled', true);

                // Submit the form
                currentForm.submit();
            }
        });

        // Close modal
        $('.close-modal').on('click', function() {
            $('#deleteModal').fadeOut();
            $('#confirmDelete').html('Delete').prop('disabled', false);
        });

        // Close on outside click
        $(window).on('click', function(event) {
            if ($(event.target).is('#deleteModal')) {
                $('#deleteModal').fadeOut();
                $('#confirmDelete').html('Delete').prop('disabled', false);
            }
        });
    });
</script>

<style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 0;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 18px;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .close-modal {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-modal:hover {
        color: #000;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-body p {
        margin: 0 0 10px 0;
    }

    .text-muted {
        color: #7f8c8d !important;
        font-size: 14px;
    }

    .text-danger {
        color: #e74c3c;
    }

    .modal-footer {
        padding: 20px;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .status-inactive {
        background-color: #f8f9fa;
        color: #6c757d;
    }

    .status-coming-soon {
        background-color: #fff3cd;
        color: #856404;
    }

    /* Badges */
    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
    }

    .bg-info {
        background-color: #17a2b8 !important;
        color: white;
    }

    .bg-primary {
        background-color: #007bff !important;
        color: white;
    }

    .bg-success {
        background-color: #28a745 !important;
        color: white;
    }

    .bg-warning {
        background-color: #ffc107 !important;
        color: #212529;
    }

    .bg-secondary {
        background-color: #6c757d !important;
        color: white;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        font-size: 14px;
    }

    .btn-view {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .btn-view:hover {
        background-color: #bbdefb;
    }

    .btn-edit {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .btn-edit:hover {
        background-color: #c8e6c9;
    }

    .btn-delete {
        background-color: #ffebee;
        color: #d32f2f;
    }

    .btn-delete:hover {
        background-color: #ffcdd2;
    }
</style>

<!-- Update Pagination -->
<div class="pagination">
    @if($products->onFirstPage())
    <button class="pagination-btn disabled">
        <i class="fas fa-chevron-left"></i>
    </button>
    @else
    <a href="{{ $products->previousPageUrl() }}" class="pagination-btn">
        <i class="fas fa-chevron-left"></i>
    </a>
    @endif

    @foreach(range(1, min(5, $products->lastPage())) as $page)
    @if($page == $products->currentPage())
    <button class="pagination-btn active">{{ $page }}</button>
    @else
    <a href="{{ $products->url($page) }}" class="pagination-btn">{{ $page }}</a>
    @endif
    @endforeach

    @if($products->hasMorePages())
    <a href="{{ $products->nextPageUrl() }}" class="pagination-btn">
        <i class="fas fa-chevron-right"></i>
    </a>
    @else
    <button class="pagination-btn disabled">
        <i class="fas fa-chevron-right"></i>
    </button>
    @endif
</div>

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchUsers').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();

                let visibleCount = 0;

                $('.user-table tbody tr').each(function() {
                    const userId = $(this).find('.user-id').text().toLowerCase();
                    const userName = $(this).find('.user-name').text().toLowerCase();
                    const userEmail = $(this).find('.user-email').text().toLowerCase();
                    const userCompany = $(this).find('.user-company').text().toLowerCase();
                    const userGroup = $(this).find('.group-badge').text().toLowerCase();

                    let matchesSearch = true;

                    // Search filter
                    if (searchTerm) {
                        matchesSearch = userId.includes(searchTerm) ||
                                       userName.includes(searchTerm) ||
                                       userEmail.includes(searchTerm) ||
                                       userCompany.includes(searchTerm) ||
                                       userGroup.includes(searchTerm);
                    }

                    // Show/hide row based on search
                    if (matchesSearch) {
                        $(this).show();
                        visibleCount++;
                    } else {
                        $(this).hide();
                    }
                });

                // Update pagination info
                $('.pagination-info').text(`Showing 1-${Math.min(visibleCount, 10)} of ${visibleCount}`);

                // Update client count in header
                if (visibleCount === 0) {
                    $('.user-list-header h3 span').text('(0 Product)');
                } else {
                    $('.user-list-header h3 span').text(`(${visibleCount} Product)`);
                }
            });

            // View client details
            $(document).on('click', '.view-user', function() {
                const userId = $(this).data('id');
                alert(`View details for client ${userId}`);
                // In a real application, this would open a details modal or navigate to details page
            });

            // Suspend client
            $(document).on('click', '.suspend-user', function(e) {
                e.stopPropagation();
                const userId = $(this).data('id');
                const userName = $(this).closest('tr').find('.user-name').text();
                const row = $(this).closest('tr');

                if (confirm(`Are you sure you want to suspend client ${userId} - ${userName}?`)) {
                    // In a real application, this would make an API call to suspend the client
                    row.find('.status-badge')
                        .removeClass('status-active status-inactive status-pending')
                        .addClass('status-suspended')
                        .text('Suspended');

                    // Change suspend button to activate button
                    $(this).replaceWith(`
                        <button class="btn-icon btn-activate activate-user" title="Activate Client" data-id="${userId}">
                            <i class="fas fa-check"></i>
                        </button>
                    `);
                    alert(`Client ${userId} has been suspended`);
                }
            });

            // Activate client
            $(document).on('click', '.activate-user', function(e) {
                e.stopPropagation();
                const userId = $(this).data('id');
                const userName = $(this).closest('tr').find('.user-name').text();
                const row = $(this).closest('tr');

                if (confirm(`Are you sure you want to activate client ${userId} - ${userName}?`)) {
                    // In a real application, this would make an API call to activate the client
                    row.find('.status-badge')
                        .removeClass('status-suspended status-inactive status-pending')
                        .addClass('status-active')
                        .text('Active');

                    // Change activate button to suspend button
                    $(this).replaceWith(`
                        <button class="btn-icon btn-suspend suspend-user" title="Suspend Client" data-id="${userId}">
                            <i class="fas fa-pause"></i>
                        </button>
                    `);
                    alert(`Client ${userId} has been activated`);
                }
            });

            // Pagination buttons
            $('.pagination-btn').not('.disabled').click(function() {
                $('.pagination-btn').removeClass('active');
                $(this).addClass('active');
                // In a real application, this would load the corresponding page
            });

            // Dropdown functionality
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).closest('.dropdown').toggleClass('active');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown').removeClass('active');
                }
            });

            // Sidebar toggle for mobile (from your existing code)
            $('#mobileToggle').click(function() {
                $('#sidebar').toggleClass('active');
                const isExpanded = $('#sidebar').hasClass('active');
                $(this).attr('aria-expanded', isExpanded);
                $(this).find('i').toggleClass('fa-bars fa-times');
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() <= 992) {
                    if (!$(e.target).closest('#sidebar').length &&
                        !$(e.target).closest('#mobileToggle').length &&
                        $('#sidebar').hasClass('active')) {
                        $('#sidebar').removeClass('active');
                        $('#mobileToggle').find('i').removeClass('fa-times').addClass('fa-bars');
                    }
                }
            });
        });
    </script>
</body>

</html>
