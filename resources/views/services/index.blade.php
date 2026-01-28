<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Management System - Services List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Additional styles for services list page */
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

        .services-list-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .services-list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .services-list-header h3 {
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

        .services-table {
            width: 100%;
            border-collapse: collapse;
        }

        .services-table th {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
            font-size: 14px;
        }

        .services-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #495057;
        }

        .services-table tr:hover {
            background-color: #f8f9fa;
        }

        .services-table tr:last-child td {
            border-bottom: none;
        }

        .service-avatar {
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

        .status-cancelled {
            background-color: rgba(52, 73, 94, 0.1);
            color: #34495e;
        }

        .trashed-row {
            background-color: #f8f9fa !important;
            opacity: 0.7;
        }

        .trashed-badge {
            background-color: rgba(52, 73, 94, 0.1);
            color: #34495e;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 500;
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

        .btn-restore {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
        }

        .btn-restore:hover {
            background-color: #9b59b6;
            color: white;
        }

        .btn-force-delete {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .btn-force-delete:hover {
            background-color: #e74c3c;
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
            text-decoration: none;
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

        .customer-info {
            display: flex;
            flex-direction: column;
        }

        .customer-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .customer-email {
            font-size: 12px;
            color: #7f8c8d;
        }

        .product-info {
            font-weight: 500;
            color: #2c3e50;
        }

        .text-muted {
            color: #95a5a6;
        }

        .expired-text {
            color: #e74c3c;
            font-weight: 500;
        }

        .upcoming-renewal {
            color: #f39c12;
            font-weight: 500;
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

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background-color: #d68910;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
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

            .services-list-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .list-actions {
                width: 100%;
                justify-content: space-between;
            }

            .services-table {
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
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="background-color: #d4edda; color: #155724; padding: 12px 20px; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close"
                    style="margin-left: auto; background: none; border: none; font-size: 18px; cursor: pointer;"
                    onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="background-color: #f8d7da; color: #721c24; padding: 12px 20px; border-radius: 8px; border: 1px solid #f5c6cb; margin-bottom: 20px; display: flex; align-items: center;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close"
                    style="margin-left: auto; background: none; border: none; font-size: 18px; cursor: pointer;"
                    onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
            @endif

            <!-- Page Header -->
            <div class="page-header">
                <h1><i class="fas fa-cogs me-2"></i>Services List</h1>
                <div class="page-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchServices" placeholder="Search Services...">
                    </div>
                    @if($trashedOnly)
                    <a href="{{ route('services') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-2"></i>Back to Services
                    </a>
                    @if($trashedServices > 0)
                    {{-- - <form action="{{ route('services.empty-trash') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Permanently delete ALL trashed services? This cannot be undone!')">
                            <i class="fas fa-trash-alt me-2"></i>Empty Trash
                        </button>
                    </form>--}}
                    @endif
                    @else
                    <a href="{{ route('add.services') }}">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Service
                        </button>
                    </a>
                    @if($trashedServices > 0)
                    {{-- <a href="{{ route('services', ['trashed' => 'true']) }}" class="btn btn-warning">
                        <i class="fas fa-trash me-2"></i>Trash ({{ $trashedServices }})
                    </a>- --}}
                    @endif
                    @endif
                </div>
            </div>

            <!-- Stats Cards -->
            @if(!$trashedOnly)
            <div class="row" style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                <div class="stat-card"
                    style="flex: 1; min-width: 200px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h3 style="margin: 0 0 5px 0; font-size: 28px; color: #2c3e50;">{{ $totalServices }}</h3>
                            <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Total Services</p>
                        </div>
                        <i class="fas fa-cogs" style="font-size: 40px; color: #3498db;"></i>
                    </div>
                </div>

                <div class="stat-card"
                    style="flex: 1; min-width: 200px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h3 style="margin: 0 0 5px 0; font-size: 28px; color: #27ae60;">{{ $activeServices }}</h3>
                            <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Active Services</p>
                        </div>
                        <i class="fas fa-check-circle" style="font-size: 40px; color: #27ae60;"></i>
                    </div>
                </div>

                <div class="stat-card"
                    style="flex: 1; min-width: 200px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <h3 style="margin: 0 0 5px 0; font-size: 28px; color: #e74c3c;">{{ $expiredServices }}</h3>
                            <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Expired Services</p>
                        </div>
                        <i class="fas fa-exclamation-triangle" style="font-size: 40px; color: #e74c3c;"></i>
                    </div>
                </div>
            </div>
            @endif

            <!-- Services List Table -->
            <div class="services-list-container">
                <div class="services-list-header">
                    <h3>
                        @if($trashedOnly)
                        <i class="fas fa-trash me-2"></i>Trashed Services
                        <span class="text-muted">({{ $trashedServices }} Services)</span>
                        @else
                        All Services
                        <span class="text-muted">({{ $totalServices }} Services)</span>
                        @endif
                    </h3>
                    <div class="list-actions">
                        <div class="pagination-info">
                            Showing {{ $services->firstItem() ?? 0 }}-{{ $services->lastItem() ?? 0 }} of {{
                            $trashedOnly ? $trashedServices : $totalServices }}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- Update the table header (add API Link column) -->
                    <table class="services-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Domain</th>
                                <th>Price</th>
                                <th>Paid Date</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th style="width: 100px;">API Link</th> <!-- New column -->
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="servicesListBody">
                            @foreach($services as $service)
                            @php
                            $isExpired = $service->expire_date < now(); $isExpiringSoon=!$isExpired && $service->
                                expire_date->diffInDays(now()) <= 30; $isTrashed=$service->trashed();
                                    @endphp
                                    <tr class="{{ $isTrashed ? 'trashed-row' : '' }}">
                                        <td class="service-id">
                                            SV{{ str_pad($service->id, 3, '0', STR_PAD_LEFT) }}
                                            @if($isTrashed)
                                            <br><span class="trashed-badge">Trashed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="customer-info">
                                                <strong class="customer-name">
                                                    {{ $service->customer->first_name }} {{
                                                    $service->customer->last_name }}
                                                </strong>
                                                <small class="customer-email">{{ $service->customer->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-info">
                                                {{ $service->product->name }}
                                                @if($service->product->productGroup)
                                                <br><small class="text-muted">{{
                                                    $service->product->productGroup->group_name }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $service->domain }}</strong>
                                            @if($service->notes)
                                            <br><small class="text-muted">{{ Str::limit($service->notes, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>${{ number_format($service->price, 2) }}</strong>
                                        </td>
                                        <td class="paid-date">
                                            {{ $service->paid_date->format('M d, Y') }}
                                        </td>
                                        <td
                                            class="expire-date {{ $isExpired ? 'expired-text' : ($isExpiringSoon ? 'upcoming-renewal' : '') }}">
                                            {{ $service->expire_date->format('M d, Y') }}
                                            @if($isExpired)
                                            <br><small class="text-danger">Expired</small>
                                            @elseif($isExpiringSoon)
                                            <br><small class="text-warning">{{
                                                round($service->expire_date->diffInDays(now())) }} days left</small>
                                            @endif
                                        </td>
                                        <td class="service-status">
                                            @if($service->status == 'active')
                                            <span class="status-badge status-active">Active</span>
                                            @elseif($service->status == 'inactive')
                                            <span class="status-badge status-inactive">Inactive</span>
                                            @elseif($service->status == 'pending')
                                            <span class="status-badge status-pending">Pending</span>
                                            @elseif($service->status == 'cancelled')
                                            <span class="status-badge status-cancelled">Cancelled</span>
                                            @endif
                                        </td>

                                        <!-- API Link Column -->
                                        <td class="api-link-cell">
                                            @if(!$isTrashed)
                                            <div class="api-link-container">
                                                <button class="btn-icon btn-api copy-api-link" title="Copy API Link"
                                                    data-api-url="{{ url('/api/service/' . $service->id) }}">
                                                    <i class="fas fa-link"></i>
                                                </button>
                                                <div class="api-url-tooltip">
                                                    {{ url('/api/service/' . $service->id) }}
                                                </div>
                                            </div>
                                            @else
                                            <span class="text-muted">N/A</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="action-buttons">
                                                @if($isTrashed)
                                                <!-- Restore Button -->
                                                <form action="{{ route('services.restore', $service->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn-icon btn-restore"
                                                        title="Restore Service">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>

                                                <!-- Permanent Delete Button -->
                                                <form action="{{ route('services.force-delete', $service->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-icon btn-force-delete"
                                                        title="Permanently Delete"
                                                        onclick="return confirm('Permanently delete this service? This cannot be undone!')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @else
                                                <!-- Edit Button -->
                                                <a href="{{ route('services.edit', $service->id) }}"
                                                    class="btn-icon btn-edit" title="Edit Service">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Soft Delete Button -->
                                                <form action="{{ route('services.destroy', $service->id) }}"
                                                    method="POST" class="d-inline delete-form"
                                                    data-id="{{ $service->id }}"
                                                    data-name="{{ $service->package_name }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-icon btn-delete delete-service"
                                                        title="Move to Trash">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Delete Confirmation Modal -->
                <div id="deleteModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3><i class="fas fa-exclamation-triangle text-danger"></i> Move to Trash</h3>
                            <span class="close-modal">&times;</span>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to move service <strong id="deleteServiceName"></strong> to trash?
                            </p>
                            <p class="text-muted">This can be restored later from the trash.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary close-modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDelete">Move to Trash</button>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let currentForm = null;

                        // Delete button click handler
                        $('.delete-service').on('click', function() {
                            currentForm = $(this).closest('form');
                            const serviceName = currentForm.data('name');

                            $('#deleteServiceName').text(serviceName);
                            $('#deleteModal').fadeIn();
                        });

                        // Confirm delete
                        $('#confirmDelete').on('click', function() {
                            if (currentForm) {
                                // Show loading
                                $(this).html('<i class="fas fa-spinner fa-spin"></i> Moving...');
                                $(this).prop('disabled', true);

                                // Submit the form
                                currentForm.submit();
                            }
                        });

                        // Close modal
                        $('.close-modal').on('click', function() {
                            $('#deleteModal').fadeOut();
                            $('#confirmDelete').html('Move to Trash').prop('disabled', false);
                        });

                        // Close on outside click
                        $(window).on('click', function(event) {
                            if ($(event.target).is('#deleteModal')) {
                                $('#deleteModal').fadeOut();
                                $('#confirmDelete').html('Move to Trash').prop('disabled', false);
                            }
                        });

                        // Search functionality
                        $('#searchServices').on('input', function() {
                            const searchTerm = $(this).val().toLowerCase();

                            let visibleCount = 0;

                            $('.services-table tbody tr').each(function() {
                                if ($(this).find('.service-id').length) {
                                    const serviceId = $(this).find('.service-id').text().toLowerCase();
                                    const customerName = $(this).find('.customer-name').text().toLowerCase();
                                    const customerEmail = $(this).find('.customer-email').text().toLowerCase();
                                    const productInfo = $(this).find('.product-info').text().toLowerCase();
                                    const packageName = $(this).find('td:nth-child(4)').text().toLowerCase();

                                    let matchesSearch = true;

                                    // Search filter
                                    if (searchTerm) {
                                        matchesSearch = serviceId.includes(searchTerm) ||
                                                       customerName.includes(searchTerm) ||
                                                       customerEmail.includes(searchTerm) ||
                                                       productInfo.includes(searchTerm) ||
                                                       packageName.includes(searchTerm);
                                    }

                                    // Show/hide row based on search
                                    if (matchesSearch) {
                                        $(this).show();
                                        visibleCount++;
                                    } else {
                                        $(this).hide();
                                    }
                                }
                            });

                            // Update pagination info
                            $('.pagination-info').text(`Showing 1-${Math.min(visibleCount, 10)} of ${visibleCount}`);
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

                    /* API Link Styles */
                    .api-link-cell {
                        text-align: center;
                    }

                    .api-link-container {
                        position: relative;
                        display: inline-block;
                    }

                    .btn-api {
                        background-color: rgba(155, 89, 182, 0.1);
                        color: #9b59b6;
                    }

                    .btn-api:hover {
                        background-color: #9b59b6;
                        color: white;
                    }

                    .api-url-tooltip {
                        visibility: hidden;
                        position: absolute;
                        z-index: 1000;
                        background-color: #333;
                        color: white;
                        text-align: center;
                        padding: 8px 12px;
                        border-radius: 6px;
                        font-size: 12px;
                        width: 250px;
                        bottom: 125%;
                        left: 50%;
                        transform: translateX(-50%);
                        opacity: 0;
                        transition: opacity 0.3s;
                        word-break: break-all;
                    }

                    .api-url-tooltip::after {
                        content: "";
                        position: absolute;
                        top: 100%;
                        left: 50%;
                        margin-left: -5px;
                        border-width: 5px;
                        border-style: solid;
                        border-color: #333 transparent transparent transparent;
                    }

                    .api-link-container:hover .api-url-tooltip {
                        visibility: visible;
                        opacity: 1;
                    }

                    /* API Modal Styles */
                    #apiModal .modal-content {
                        max-width: 600px;
                    }

                    .api-url-display {
                        background-color: #f8f9fa;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                        padding: 12px;
                        margin: 15px 0;
                        font-family: 'Courier New', monospace;
                        font-size: 14px;
                        word-break: break-all;
                        position: relative;
                    }

                    .api-url-display .copy-btn {
                        position: absolute;
                        right: 10px;
                        top: 10px;
                        background: #3498db;
                        color: white;
                        border: none;
                        border-radius: 4px;
                        padding: 4px 10px;
                        font-size: 12px;
                        cursor: pointer;
                    }

                    .api-url-display .copy-btn:hover {
                        background: #2980b9;
                    }

                    .api-response-preview {
                        background-color: #2c3e50;
                        color: #ecf0f1;
                        border-radius: 6px;
                        padding: 15px;
                        margin: 15px 0;
                        font-family: 'Courier New', monospace;
                        font-size: 12px;
                        max-height: 300px;
                        overflow-y: auto;
                        white-space: pre-wrap;
                    }

                    .api-test-btn {
                        background-color: #27ae60;
                        color: white;
                        border: none;
                        padding: 8px 16px;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 14px;
                        display: inline-flex;
                        align-items: center;
                        gap: 8px;
                    }

                    .api-test-btn:hover {
                        background-color: #219653;
                    }

                    .api-test-btn i {
                        font-size: 12px;
                    }

                    .api-usage-example {
                        background-color: #f8f9fa;
                        border-left: 4px solid #3498db;
                        padding: 10px 15px;
                        margin: 15px 0;
                        border-radius: 4px;
                        font-size: 13px;
                    }

                    .api-usage-example code {
                        background-color: #e9ecef;
                        padding: 2px 6px;
                        border-radius: 3px;
                        font-family: 'Courier New', monospace;
                    }
                </style>

                <!-- Pagination -->
                <div class="pagination">
                    @if($services->onFirstPage())
                    <button class="pagination-btn disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    @else
                    <a href="{{ $trashedOnly ? $services->url(1).'&trashed=true' : $services->url(1) }}"
                        class="pagination-btn">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    @endif

                    @php
                    $currentPage = $services->currentPage();
                    $lastPage = $services->lastPage();
                    $start = max(1, $currentPage - 2);
                    $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @for($page = $start; $page <= $end; $page++) @if($page==$currentPage) <button
                        class="pagination-btn active">{{ $page }}</button>
                        @else
                        <a href="{{ $trashedOnly ? $services->url($page).'&trashed=true' : $services->url($page) }}"
                            class="pagination-btn">{{ $page }}</a>
                        @endif
                        @endfor

                        @if($services->hasMorePages())
                        <a href="{{ $trashedOnly ? $services->nextPageUrl().'&trashed=true' : $services->nextPageUrl() }}"
                            class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        @else
                        <button class="pagination-btn disabled">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        @endif
                </div>
            </div>
        </div>

        <!-- API Link Modal -->
        <div id="apiModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fas fa-link me-2"></i>Service API Link</h3>
                    <span class="close-modal" onclick="closeApiModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <p>Use this API link to access service data from external applications:</p>

                    <div class="api-url-display">
                        <span id="apiUrlDisplay"></span>
                        <button class="copy-btn" onclick="copyApiUrl()">
                            <i class="fas fa-copy me-1"></i>Copy
                        </button>
                    </div>

                    <div class="api-usage-example">
                        <strong><i class="fas fa-lightbulb me-1"></i>Usage Examples:</strong>
                        <div style="margin-top: 8px;">
                            <strong>JavaScript Fetch:</strong>
                            <pre
                                style="margin: 5px 0; padding: 8px; background: #e9ecef; border-radius: 4px; font-size: 11px;">
fetch('<span id="jsApiUrl"></span>')
    .then(response => response.json())
    .then(data => console.log(data));</pre>

                            <strong>jQuery:</strong>
                            <pre
                                style="margin: 5px 0; padding: 8px; background: #e9ecef; border-radius: 4px; font-size: 11px;">
$.getJSON('<span id="jqueryApiUrl"></span>', function(data) {
    console.log(data);
});</pre>
                        </div>
                    </div>

                    <button class="api-test-btn" onclick="testApiEndpoint()">
                        <i class="fas fa-bolt"></i> Test API Endpoint
                    </button>

                    <div id="apiResponse" class="api-response-preview" style="display: none;">
                        <div id="apiResponseContent"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeApiModal()">Close</button>
                </div>
            </div>
        </div>

        <script>
            // API Link functionality
let currentApiUrl = '';

// Show API modal
$(document).on('click', '.copy-api-link', function() {
    currentApiUrl = $(this).data('api-url');

    // Update modal content
    $('#apiUrlDisplay').text(currentApiUrl);
    $('#jsApiUrl').text(currentApiUrl);
    $('#jqueryApiUrl').text(currentApiUrl);

    // Show modal
    $('#apiModal').fadeIn();
});

// Copy API URL to clipboard
function copyApiUrl() {
    navigator.clipboard.writeText(currentApiUrl).then(function() {
        // Show success message
        const copyBtn = document.querySelector('.copy-btn');
        const originalHtml = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        copyBtn.style.background = '#27ae60';

        setTimeout(function() {
            copyBtn.innerHTML = originalHtml;
            copyBtn.style.background = '#3498db';
        }, 2000);

        // Also show toast notification
        showToast('API link copied to clipboard!', 'success');
    }).catch(function(err) {
        console.error('Failed to copy: ', err);
        showToast('Failed to copy. Please try again.', 'error');
    });
}

// Test API endpoint
function testApiEndpoint() {
    const testBtn = document.querySelector('.api-test-btn');
    const originalHtml = testBtn.innerHTML;
    const responseDiv = $('#apiResponse');
    const responseContent = $('#apiResponseContent');

    // Show loading
    testBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Testing...';
    testBtn.disabled = true;

    // Clear previous response
    responseContent.html('');
    responseDiv.hide();

    // Make API request
    fetch(currentApiUrl)
        .then(response => response.json())
        .then(data => {
            // Show response
            responseContent.html(JSON.stringify(data, null, 2));
            responseDiv.fadeIn();

            // Reset button
            testBtn.innerHTML = originalHtml;
            testBtn.disabled = false;

            // Scroll to response
            responseDiv[0].scrollIntoView({ behavior: 'smooth' });
        })
        .catch(error => {
            // Show error
            responseContent.html('Error: ' + error.message);
            responseDiv.fadeIn();

            // Reset button
            testBtn.innerHTML = originalHtml;
            testBtn.disabled = false;
        });
}

// Close API modal
function closeApiModal() {
    $('#apiModal').fadeOut();
    $('#apiResponse').hide();
    $('#apiResponseContent').html('');

    // Reset test button
    const testBtn = document.querySelector('.api-test-btn');
    if (testBtn) {
        testBtn.innerHTML = '<i class="fas fa-bolt"></i> Test API Endpoint';
        testBtn.disabled = false;
    }
}

// Simple copy on button click (without modal)
$(document).on('click', '.btn-api', function(e) {
    e.preventDefault();
    const apiUrl = $(this).data('api-url');

    navigator.clipboard.writeText(apiUrl).then(function() {
        // Visual feedback
        const btn = $(e.target).closest('.btn-api');
        const originalHtml = btn.html();
        const originalColor = btn.css('background-color');

        btn.html('<i class="fas fa-check"></i>');
        btn.css('background-color', '#27ae60');

        setTimeout(function() {
            btn.html(originalHtml);
            btn.css('background-color', originalColor);
        }, 1000);

        // Show toast
        showToast('API link copied!', 'success');
    });
});

// Toast notification function
function showToast(message, type = 'info') {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'toast-notification ' + type;
    toast.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
        ${message}
    `;

    // Add to page
    document.body.appendChild(toast);

    // Show toast
    setTimeout(() => toast.classList.add('show'), 10);

    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add toast styles
const toastStyles = document.createElement('style');
toastStyles.textContent = `
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #2c3e50;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        display: flex;
        align-items: center;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        max-width: 300px;
    }

    .toast-notification.show {
        transform: translateX(0);
    }

    .toast-notification.success {
        background: #27ae60;
        border-left: 4px solid #219653;
    }

    .toast-notification.error {
        background: #e74c3c;
        border-left: 4px solid #c0392b;
    }

    .toast-notification.info {
        background: #3498db;
        border-left: 4px solid #2980b9;
    }
`;
document.head.appendChild(toastStyles);

// Close modals on outside click
$(window).on('click', function(event) {
    if ($(event.target).is('#apiModal')) {
        closeApiModal();
    }
});
        </script>
        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>
</body>

</html>
