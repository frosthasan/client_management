<div class="sidebar" id="sidebar">
    <div class="logo-container">
        <a href="#" class="logo"><span>VMS</span> Dashboard</a>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}"" class=" {{ request()->is('dashboard') ? 'active' : '' }}"><i
                    class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <a href="{{ route('users') }}" class="{{ request()->is('users') ? 'active' : '' }}">
            <i class="fas fa-car"></i> Clients
        </a>

        <!-- Vehicles Dropdown -->
        {{-- <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-car"></i> Vehicles <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-list"></i> All Vehicles</a></li>
                <li><a href="#"><i class="fas fa-plus-circle"></i> Add New Vehicle</a></li>
                <li><a href="#"><i class="fas fa-edit"></i> Vehicle Categories</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> Vehicle Locations</a></li>
            </ul>
        </li>--}}

        <!-- Maintenance Dropdown -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-wrench"></i> Product <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('product') }}"><i class="fas fa-exclamation-triangle"></i>Product</a></li>
                <li><a href="{{ route('product.group') }}"><i class="fas fa-calendar-alt"></i> Product group</a></li>
                <li><a href="{{ route('services') }}"><i class="fas fa-exclamation-triangle"></i> Services</a></li>
                <li><a href="#"><i class="fas fa-history"></i> Maintenance History</a></li>
                <li><a href="#"><i class="fas fa-file-invoice-dollar"></i> Service Records</a></li>
            </ul>
        </li>

        <!-- Fuel Tracking Dropdown -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-gas-pump"></i> Fuel Tracking <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-chart-line"></i> Fuel Consumption</a></li>
                <li><a href="#"><i class="fas fa-dollar-sign"></i> Fuel Costs</a></li>
                <li><a href="#"><i class="fas fa-gas-pump"></i> Refueling Logs</a></li>
                <li><a href="#"><i class="fas fa-leaf"></i> Emissions Report</a></li>
            </ul>
        </li>

        <!-- Analytics Dropdown -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-chart-line"></i> Analytics <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-chart-bar"></i> Fleet Performance</a></li>
                <li><a href="#"><i class="fas fa-chart-pie"></i> Cost Analysis</a></li>
                <li><a href="#"><i class="fas fa-road"></i> Utilization Reports</a></li>
                <li><a href="#"><i class="fas fa-clock"></i> Downtime Analysis</a></li>
            </ul>
        </li>

        <!-- Drivers Dropdown -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-users"></i> Drivers <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-id-card"></i> Driver Profiles</a></li>
                <li><a href="#"><i class="fas fa-tasks"></i> Driver Assignments</a></li>
                <li><a href="#"><i class="fas fa-award"></i> Performance Ratings</a></li>
                <li><a href="#"><i class="fas fa-file-alt"></i> License Tracking</a></li>
            </ul>
        </li>

        <!-- Settings Dropdown -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-cog"></i> Settings <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-sliders-h"></i> System Settings</a></li>
                <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
                <li><a href="#"><i class="fas fa-user-shield"></i> User Management</a></li>
                <li><a href="#"><i class="fas fa-database"></i> Data Backup</a></li>
            </ul>
        </li>

        <!-- Reports -->
        <li><a href="#"><i class="fas fa-file-pdf"></i> Reports</a></li>

        <!-- Help & Support -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <i class="fas fa-question-circle"></i> Help & Support <i class="fas fa-chevron-down dropdown-icon"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#"><i class="fas fa-book"></i> Documentation</a></li>
                <li><a href="#"><i class="fas fa-headset"></i> Contact Support</a></li>
                <li><a href="#"><i class="fas fa-video"></i> Tutorials</a></li>
                <li><a href="#"><i class="fas fa-info-circle"></i> About VMS</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
<script>
    $(document).ready(function() {
    // Sidebar Dropdown Toggle
    $('.dropdown-toggle').click(function(e) {
        e.preventDefault();
        e.stopPropagation();

        // Get the parent dropdown
        var $dropdown = $(this).closest('.dropdown');

        // Toggle current dropdown
        $dropdown.toggleClass('active');

        // Close other dropdowns
        $('.dropdown').not($dropdown).removeClass('active');
    });

    // Close dropdown when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown').removeClass('active');
        }
    });

    // Prevent dropdown from closing when clicking inside dropdown menu
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });

    // Sidebar toggle for mobile
    $('#sidebarToggle').click(function() {
        $('#sidebar').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('#sidebar').length &&
                !$(e.target).closest('#sidebarToggle').length &&
                $('#sidebar').hasClass('active')) {
                $('#sidebar').removeClass('active');
                $('#sidebarToggle').find('i').removeClass('fa-times').addClass('fa-bars');
            }
        }
    });

    // Close sidebar when clicking on a link (mobile)
    $('.nav-links a').click(function() {
        if ($(window).width() <= 768) {
            $('#sidebar').removeClass('active');
            $('#sidebarToggle').find('i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Set active dropdown based on current URL
    function setActiveDropdown() {
        var currentPath = window.location.pathname;

        // Check each dropdown menu link
        $('.dropdown-menu a').each(function() {
            var href = $(this).attr('href');
            if (href && currentPath.includes(href.replace(/^.*\/\/[^\/]+/, ''))) {
                $(this).closest('.dropdown').addClass('active');
                return false; // Exit loop once found
            }
        });
    }

    // Call function on page load
    setActiveDropdown();
});
</script>
