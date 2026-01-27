<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management System Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Sidebar -->
    @include('layouts.inc.sidebar')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
    @include('layouts.inc.header')

        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Vehicles</h3>
                    <div class="card-icon" style="background-color: #3498db;">
                        <i class="fas fa-car"></i>
                    </div>
                </div>
                <div class="card-value" id="totalVehicles">24</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 2 new this month
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Active Vehicles</h3>
                    <div class="card-icon" style="background-color: #2ecc71;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="card-value" id="activeVehicles">18</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 75% of fleet
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Maintenance Due</h3>
                    <div class="card-icon" style="background-color: #f39c12;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <div class="card-value" id="maintenanceDue">6</div>
                <div class="card-change negative">
                    <i class="fas fa-arrow-up"></i> 3 urgent
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Avg. Fuel Efficiency</h3>
                    <div class="card-icon" style="background-color: #9b59b6;">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                </div>
                <div class="card-value" id="avgFuel">8.2</div>
                <div class="card-change positive">
                    <i class="fas fa-arrow-up"></i> 0.3 improvement
                </div>
            </div>
        </div>

        <!-- Reminders Section -->
        <div class="reminders-container">
            <div class="reminders-header">
                <h3>Reminders & Notifications</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Reminder
                </button>
            </div>
            <div class="reminders-list" id="remindersList">
                <!-- Reminders Data as HTML -->
                <div class="reminder-item" data-id="1">
                    <div class="reminder-icon" style="background-color: #f39c12">
                        <i class="fas fa-oil-can"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Oil Change Due</div>
                        <div class="reminder-description">Vehicle VH002 needs oil change within next 3 days</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-15
                            </div>
                            <span class="reminder-priority priority-high">
                                High Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="2">
                    <div class="reminder-icon" style="background-color: #3498db">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Insurance Renewal</div>
                        <div class="reminder-description">Renew insurance for 5 vehicles expiring next week</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-18
                            </div>
                            <span class="reminder-priority priority-high">
                                High Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="3">
                    <div class="reminder-icon" style="background-color: #1abc9c">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Regular Maintenance</div>
                        <div class="reminder-description">Schedule monthly maintenance check for fleet vehicles</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-20
                            </div>
                            <span class="reminder-priority priority-medium">
                                Medium Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="4">
                    <div class="reminder-icon" style="background-color: #9b59b6">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Driver License Expiry</div>
                        <div class="reminder-description">Driver license for John Smith expires next month</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2024-01-10
                            </div>
                            <span class="reminder-priority priority-medium">
                                Medium Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="5">
                    <div class="reminder-icon" style="background-color: #e74c3c">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Tire Replacement</div>
                        <div class="reminder-description">Replace tires on vehicle VH006 (due to wear)</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-25
                            </div>
                            <span class="reminder-priority priority-high">
                                High Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="6">
                    <div class="reminder-icon" style="background-color: #2ecc71">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Fuel Efficiency Report</div>
                        <div class="reminder-description">Generate monthly fuel efficiency analysis report</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-30
                            </div>
                            <span class="reminder-priority priority-low">
                                Low Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="7">
                    <div class="reminder-icon" style="background-color: #34495e">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Vehicle Inspection</div>
                        <div class="reminder-description">Annual safety inspection due for 3 commercial vehicles</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2024-01-05
                            </div>
                            <span class="reminder-priority priority-medium">
                                Medium Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="8">
                    <div class="reminder-icon" style="background-color: #27ae60">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Software Update</div>
                        <div class="reminder-description">Update vehicle tracking software to latest version</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-22
                            </div>
                            <span class="reminder-priority priority-low">
                                Low Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="9">
                    <div class="reminder-icon" style="background-color: #d35400">
                        <i class="fas fa-car-crash"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Brake System Check</div>
                        <div class="reminder-description">Routine brake inspection for all active vehicles</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2023-12-28
                            </div>
                            <span class="reminder-priority priority-medium">
                                Medium Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="reminder-item" data-id="10">
                    <div class="reminder-icon" style="background-color: #8e44ad">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="reminder-content">
                        <div class="reminder-title">Quarterly Review Meeting</div>
                        <div class="reminder-description">Schedule quarterly fleet performance review meeting</div>
                        <div class="reminder-meta">
                            <div class="reminder-date">
                                <i class="far fa-calendar"></i> 2024-01-15
                            </div>
                            <span class="reminder-priority priority-low">
                                Low Priority
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <h3 class="chart-title">Vehicle Status Distribution</h3>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <div class="chart-card">
                <h3 class="chart-title">Monthly Fuel Cost</h3>
                <div class="chart-container">
                    <canvas id="fuelChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Vehicle Table -->
        <div class="vehicle-table-container">
            <div class="table-header">
                <h3>Recent Vehicle Activity</h3>
                <button class="btn btn-success add-vehicle-btn">
                    <i class="fas fa-plus"></i> Add Vehicle
                </button>
            </div>
            <table id="vehicleTable">
                <thead>
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Type</th>
                        <th>Driver</th>
                        <th>Last Service</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Vehicle Data as HTML -->
                    <tr>
                        <td>VH001</td>
                        <td>SUV</td>
                        <td>John Smith</td>
                        <td>2023-10-15</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH001">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH002</td>
                        <td>Truck</td>
                        <td>Robert Johnson</td>
                        <td>2023-09-22</td>
                        <td><span class="status-badge status-maintenance">Maintenance</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH002">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH003</td>
                        <td>Sedan</td>
                        <td>Michael Brown</td>
                        <td>2023-11-05</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH003">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH004</td>
                        <td>Van</td>
                        <td>William Davis</td>
                        <td>2023-08-30</td>
                        <td><span class="status-badge status-inactive">Inactive</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH004">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH005</td>
                        <td>SUV</td>
                        <td>David Wilson</td>
                        <td>2023-10-28</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH005">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH006</td>
                        <td>Truck</td>
                        <td>James Taylor</td>
                        <td>2023-09-10</td>
                        <td><span class="status-badge status-maintenance">Maintenance</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH006">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>VH007</td>
                        <td>Sedan</td>
                        <td>Thomas Anderson</td>
                        <td>2023-11-12</td>
                        <td><span class="status-badge status-active">Active</span></td>
                        <td>
                            <button class="btn btn-primary btn-sm view-vehicle" data-id="VH007">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        @include('layouts.inc.footer')
    </div>

    <script>
        $(document).ready(function() {
            // Sidebar toggle for mobile
            $('#mobileToggle').click(function() {
                $('#sidebar').toggleClass('active');
                // Update aria label for accessibility
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

            // Handle window resize
            $(window).on('resize', function() {
                if ($(window).width() > 992) {
                    $('#sidebar').removeClass('active');
                    $('#mobileToggle').find('i').removeClass('fa-times').addClass('fa-bars');
                }
            });

            // Initialize charts
            function initCharts() {
                // Vehicle Status Chart
                const statusCtx = document.getElementById('statusChart').getContext('2d');
                const statusChart = new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Active', 'Maintenance', 'Inactive'],
                        datasets: [{
                            data: [18, 4, 2],
                            backgroundColor: [
                                'rgba(46, 204, 113, 0.8)',
                                'rgba(241, 196, 15, 0.8)',
                                'rgba(231, 76, 60, 0.8)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Fuel Cost Chart
                const fuelCtx = document.getElementById('fuelChart').getContext('2d');
                const fuelChart = new Chart(fuelCtx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                            label: 'Fuel Cost ($)',
                            data: [3200, 2950, 3100, 2800, 3500, 4200, 4100, 3800, 3700, 3900, 4000, 4200],
                            backgroundColor: 'rgba(52, 152, 219, 0.1)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 3,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Event handlers
            $(document).on('click', '.view-vehicle', function() {
                const vehicleId = $(this).data('id');
                alert(`View details for vehicle ${vehicleId}`);
            });

            $('.add-vehicle-btn').click(function() {
                alert('Add new vehicle functionality would open a form here.');
            });

            // Reminder item click
            $(document).on('click', '.reminder-item', function() {
                const reminderId = $(this).data('id');
                const reminderTitles = {
                    1: "Oil Change Due",
                    2: "Insurance Renewal",
                    3: "Regular Maintenance",
                    4: "Driver License Expiry",
                    5: "Tire Replacement",
                    6: "Fuel Efficiency Report",
                    7: "Vehicle Inspection",
                    8: "Software Update",
                    9: "Brake System Check",
                    10: "Quarterly Review Meeting"
                };

                const reminderDescriptions = {
                    1: "Vehicle VH002 needs oil change within next 3 days",
                    2: "Renew insurance for 5 vehicles expiring next week",
                    3: "Schedule monthly maintenance check for fleet vehicles",
                    4: "Driver license for John Smith expires next month",
                    5: "Replace tires on vehicle VH006 (due to wear)",
                    6: "Generate monthly fuel efficiency analysis report",
                    7: "Annual safety inspection due for 3 commercial vehicles",
                    8: "Update vehicle tracking software to latest version",
                    9: "Routine brake inspection for all active vehicles",
                    10: "Schedule quarterly fleet performance review meeting"
                };

                const reminderDates = {
                    1: "2023-12-15",
                    2: "2023-12-18",
                    3: "2023-12-20",
                    4: "2024-01-10",
                    5: "2023-12-25",
                    6: "2023-12-30",
                    7: "2024-01-05",
                    8: "2023-12-22",
                    9: "2023-12-28",
                    10: "2024-01-15"
                };

                const reminderPriority = $(this).find('.reminder-priority').text().replace(' Priority', '');

                alert(`Reminder: ${reminderTitles[reminderId]}\n\n${reminderDescriptions[reminderId]}\n\nDue: ${reminderDates[reminderId]}\nPriority: ${reminderPriority}`);
            });

            // Initialize dashboard
            initCharts();

            // Dropdown functionality
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Toggle current dropdown
                $(this).closest('.dropdown').toggleClass('active');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown').removeClass('active');
                }
            });

            // Prevent dropdown from closing when clicking inside
            $(document).on('click', '.dropdown-menu', function(e) {
                e.stopPropagation();
            });

            // Handle nested dropdowns
            $(document).on('click', '.dropdown-menu .dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).closest('.dropdown').toggleClass('active');
            });

            // Highlight active menu item
            $(document).on('click', '.nav-links a', function(e) {
                // If it's a dropdown toggle, don't follow the link
                if ($(this).hasClass('dropdown-toggle')) {
                    e.preventDefault();
                    return;
                }

                // Remove active class from all links
                $('.nav-links a').removeClass('active');

                // Add active class to clicked link
                $(this).addClass('active');

                // Close sidebar on mobile after clicking a link
                if ($(window).width() <= 992) {
                    $('#sidebar').removeClass('active');
                    $('#mobileToggle').find('i').removeClass('fa-times').addClass('fa-bars');
                }
            });
        });
    </script>
</body>

</html>
