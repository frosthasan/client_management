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

        .filters-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filters-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .filters-header h3 {
            margin: 0;
            font-size: 16px;
            color: #2c3e50;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .filter-group select,
        .filter-group input {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            transition: all 0.3s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .user-list-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
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

        .user-avatar.admin {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
        }

        .user-avatar.staff {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }

        .user-avatar.user {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
        }

        .user-avatar.manager {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
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

        .role-badge.manager {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
            border-color: rgba(155, 89, 182, 0.2);
        }

        .department-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            background-color: #fff8e1;
            color: #ff8f00;
            border: 1px solid #ffe082;
        }

        .department-badge.it {
            background-color: rgba(52, 152, 219, 0.1);
            color: #3498db;
            border-color: rgba(52, 152, 219, 0.2);
        }

        .department-badge.hr {
            background-color: rgba(155, 89, 182, 0.1);
            color: #9b59b6;
            border-color: rgba(155, 89, 182, 0.2);
        }

        .department-badge.sales {
            background-color: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border-color: rgba(46, 204, 113, 0.2);
        }

        .department-badge.marketing {
            background-color: rgba(243, 156, 18, 0.1);
            color: #f39c12;
            border-color: rgba(243, 156, 18, 0.2);
        }

        .department-badge.finance {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border-color: rgba(231, 76, 60, 0.2);
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

            .filter-row {
                grid-template-columns: 1fr;
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
                <h1><i class="fas fa-users me-2"></i>User List</h1>
                <div class="page-actions">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchUsers" placeholder="Search users...">
                    </div>
                    <a href="{{ route('user.create') }}">
                        <button class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i>Add User
                        </button>
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-container">
                <div class="filters-header">
                    <h3><i class="fas fa-filter me-2"></i>Filters</h3>
                    <button class="btn btn-text" id="clearFilters">
                        <i class="fas fa-times me-2"></i>Clear All
                    </button>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="filterStatus">Status</label>
                        <select id="filterStatus">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filterRole">User Role</label>
                        <select id="filterRole">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="staff">Staff</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filterDepartment">Department</label>
                        <select id="filterDepartment">
                            <option value="">All Departments</option>
                            <option value="it">IT</option>
                            <option value="hr">HR</option>
                            <option value="sales">Sales</option>
                            <option value="marketing">Marketing</option>
                            <option value="finance">Finance</option>
                        </select>
                    </div>
                </div>
                <div class="filter-actions">
                    <button class="btn btn-text" id="resetFilters">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                    <button class="btn btn-primary" id="applyFilters">
                        <i class="fas fa-check me-2"></i>Apply Filters
                    </button>
                </div>
            </div>

            <!-- User List Table -->
            <div class="user-list-container">
                <div class="user-list-header">
                    <h3>All Users <span class="text-muted">({{ $totalUsers }} users)</span></h3>
                    <div class="list-actions">
                        <div class="pagination-info">
                            Showing {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} of {{ $totalUsers }}
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
                                <th style="width: 50px;"></th>
                                <th style="width: 100px;">User ID</th>
                                <th>User Info</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Join Date</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userListBody">
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-avatar {{ $user->client_group ?? 'user' }}">
                                        {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1))
                                        }}
                                    </div>
                                </td>
                                <td class="user-id">US{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="user-infos">
                                        <strong class="user-name">{{ $user->first_name }} {{ $user->last_name
                                            }}</strong>
                                        <div class="user-email">{{ $user->email }}</div>
                                        @if($user->company_name)
                                        <div class="user-company">{{ $user->company_name }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="department">
                                    <span class="department-badge {{ strtolower($user->client_group ?? 'general') }}">
                                        {{ ucfirst($user->client_group ?? 'General') }}
                                    </span>
                                </td>
                                <td class="user-role">
                                    @php
                                    // Determine role based on user type or permissions
                                    $role = 'user';
                                    if($user->is_admin) {
                                    $role = 'admin';
                                    } elseif($user->client_group == 'corporate' || $user->client_group == 'reseller') {
                                    $role = 'manager';
                                    }
                                    @endphp
                                    <span class="role-badge {{ $role }}">{{ ucfirst($role) }}</span>
                                </td>
                                <td class="phone">{{ $user->phone ?? 'N/A' }}</td>
                                <td class="user-status">
                                    @if($user->status == '1')
                                    <span class="status-badge status-active">Active</span>
                                    @elseif($user->status == '0')
                                    <span class="status-badge status-inactive">Inactive</span>
                                    @elseif($user->status == '2')
                                    <span class="status-badge status-suspended">Suspended</span>
                                    @else
                                    <span class="status-badge status-pending">Pending</span>
                                    @endif
                                </td>
                                <td class="join-date">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-icon btn-view view-user" title="View Details"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-icon btn-edit"
                                            title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if($user->status == 'active')
                                        <button class="btn-icon btn-suspend suspend-user" title="Suspend User"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        @elseif($user->status == 'inactive' || $user->status == 'suspended')
                                        <button class="btn-icon btn-activate activate-user" title="Activate User"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @elseif($user->status == 'pending')
                                        <button class="btn-icon btn-activate activate-user" title="Activate User"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-delete" title="Delete User"
                                                onclick="return confirm('Are you sure you want to delete {{ $user->first_name }} {{ $user->last_name }}?\\n\\nThis action cannot be undone.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if($users->isEmpty())
                            <tr>
                                <td colspan="9" style="text-align: center; padding: 40px;">
                                    <i class="fas fa-users"
                                        style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
                                    <h4 style="color: #999; margin-bottom: 10px;">No users found</h4>
                                    <p style="color: #aaa;">Click "Add User" to create your first user.</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    @if($users->onFirstPage())
                    <button class="pagination-btn disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    @else
                    <a href="{{ $users->previousPageUrl() }}" class="pagination-btn">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    @endif

                    @foreach(range(1, min(5, $users->lastPage())) as $page)
                    @if($page == $users->currentPage())
                    <button class="pagination-btn active">{{ $page }}</button>
                    @else
                    <a href="{{ $users->url($page) }}" class="pagination-btn">{{ $page }}</a>
                    @endif
                    @endforeach

                    @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="pagination-btn">
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

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchUsers').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                filterUsers();
            });

            // Filter functionality
            function filterUsers() {
                const searchTerm = $('#searchUsers').val().toLowerCase();
                const statusFilter = $('#filterStatus').val();
                const roleFilter = $('#filterRole').val();
                const departmentFilter = $('#filterDepartment').val();

                let visibleCount = 0;

                $('.user-table tbody tr').each(function() {
                    const userId = $(this).find('.user-id').text().toLowerCase();
                    const userName = $(this).find('.user-name').text().toLowerCase();
                    const userEmail = $(this).find('.user-email').text().toLowerCase();
                    const userRole = $(this).find('.role-badge').text().toLowerCase();
                    const department = $(this).find('.department-badge').text().toLowerCase();
                    const statusText = $(this).find('.status-badge').text().toLowerCase();

                    let matchesSearch = true;
                    let matchesStatus = true;
                    let matchesRole = true;
                    let matchesDepartment = true;

                    // Search filter
                    if (searchTerm) {
                        matchesSearch = userId.includes(searchTerm) ||
                                       userName.includes(searchTerm) ||
                                       userEmail.includes(searchTerm);
                    }

                    // Status filter
                    if (statusFilter) {
                        matchesStatus = statusText.includes(statusFilter);
                    }

                    // Role filter
                    if (roleFilter) {
                        matchesRole = userRole.includes(roleFilter.toLowerCase());
                    }

                    // Department filter
                    if (departmentFilter) {
                        matchesDepartment = department.includes(departmentFilter.toLowerCase());
                    }

                    // Show/hide row based on filters
                    if (matchesSearch && matchesStatus && matchesRole && matchesDepartment) {
                        $(this).show();
                        visibleCount++;
                    } else {
                        $(this).hide();
                    }
                });

                // Update pagination info
                $('.pagination-info').text(`Showing 1-${Math.min(visibleCount, 10)} of ${visibleCount}`);

                // Update user count in header
                if (visibleCount === 0) {
                    $('.user-list-header h3 span').text('(0 users)');
                } else {
                    $('.user-list-header h3 span').text(`(${visibleCount} users)`);
                }
            }

            // Apply filters button
            $('#applyFilters').click(filterUsers);

            // Clear all filters
            $('#clearFilters').click(function() {
                $('#searchUsers').val('');
                $('#filterStatus').val('');
                $('#filterRole').val('');
                $('#filterDepartment').val('');
                filterUsers();
            });

            // Reset filters
            $('#resetFilters').click(function() {
                $('#filterStatus').val('');
                $('#filterRole').val('');
                $('#filterDepartment').val('');
            });

            // View user details
            $(document).on('click', '.view-user', function() {
                const userId = $(this).data('id');
                alert(`View details for user ${userId}`);
                // In a real application, this would open a details modal or navigate to details page
            });

            // Edit user
            $(document).on('click', '.edit-user', function() {
                const userId = $(this).data('id');
                alert(`Edit user ${userId}`);
                // In a real application, this would open an edit form
            });

            // Delete user
            $(document).on('click', '.delete-user', function(e) {
                e.stopPropagation();
                const userId = $(this).data('id');
                const userName = $(this).closest('tr').find('.user-name').text();

                if (confirm(`Are you sure you want to delete user ${userId} - ${userName}?`)) {
                    // In a real application, this would make an API call to delete the user
                    $(this).closest('tr').fadeOut(300, function() {
                        $(this).remove();
                        alert(`User ${userId} has been deleted`);
                        filterUsers(); // Update counts after deletion
                    });
                }
            });

            // Suspend user
            $(document).on('click', '.suspend-user', function(e) {
                e.stopPropagation();
                const userId = $(this).data('id');
                const userName = $(this).closest('tr').find('.user-name').text();
                const row = $(this).closest('tr');

                if (confirm(`Are you sure you want to suspend user ${userId} - ${userName}?`)) {
                    // In a real application, this would make an API call to suspend the user
                    row.find('.status-badge')
                        .removeClass('status-active status-inactive status-pending')
                        .addClass('status-suspended')
                        .text('Suspended');

                    // Change suspend button to activate button
                    $(this).replaceWith(`
                        <button class="btn-icon btn-activate activate-user" title="Activate User" data-id="${userId}">
                            <i class="fas fa-check"></i>
                        </button>
                    `);
                    alert(`User ${userId} has been suspended`);
                }
            });

            // Activate user
            $(document).on('click', '.activate-user', function(e) {
                e.stopPropagation();
                const userId = $(this).data('id');
                const userName = $(this).closest('tr').find('.user-name').text();
                const row = $(this).closest('tr');

                if (confirm(`Are you sure you want to activate user ${userId} - ${userName}?`)) {
                    // In a real application, this would make an API call to activate the user
                    row.find('.status-badge')
                        .removeClass('status-suspended status-inactive status-pending')
                        .addClass('status-active')
                        .text('Active');

                    // Change activate button to suspend button
                    $(this).replaceWith(`
                        <button class="btn-icon btn-suspend suspend-user" title="Suspend User" data-id="${userId}">
                            <i class="fas fa-pause"></i>
                        </button>
                    `);
                    alert(`User ${userId} has been activated`);
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

            // Initialize filtering
            filterUsers();

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
