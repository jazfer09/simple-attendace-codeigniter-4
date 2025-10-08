<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); }
        .sidebar { background: white; min-height: calc(100vh - 56px); border-right: 1px solid #dee2e6; }
        .sidebar a { color: #333; padding: 1rem; display: block; text-decoration: none; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); color: white; }
        .report-card { border-left: 4px solid #14100f; }
        .btn-outline-light:hover { background: rgba(255,255,255,0.2); }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .card-header { 
            background: #f8f9fa; 
            border-bottom: 2px solid #14100f; 
            font-weight: 600;
        }
        h2, h5, h6 { color: #14100f; }
        .form-label { color: #14100f; font-weight: 500; }
        .form-control:focus, .form-select:focus {
            border-color: #14100f;
            box-shadow: 0 0 0 0.2rem rgba(20, 16, 15, 0.15);
        }
        .btn-primary { 
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); 
            border: none; 
            transition: all 0.3s ease;
        }
        .btn-primary:hover { 
            opacity: 0.9; 
            transform: translateY(-2px); 
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .btn-outline-primary {
            color: #14100f;
            border-color: #14100f;
            transition: all 0.3s ease;
        }
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            border-color: #14100f;
            color: white;
        }
        .quick-report-card {
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .quick-report-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand">⏰ Attendance System</span>
            <div class="d-flex align-items-center text-white">
                <span class="me-3">👤 <?= session()->get('full_name') ?> (<?= ucfirst(session()->get('role')) ?>)</span>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <a href="<?= base_url('dashboard') ?>">📊 Dashboard</a>
                <a href="<?= base_url('employees') ?>">👥 Employees</a>
                <a href="<?= base_url('reports') ?>" class="active">📈 Reports</a>
                <a href="<?= base_url('profile') ?>">⚙️ Profile</a>
            </div>

            <div class="col-md-10 p-4">
                <h2 class="mb-4">Generate Attendance Reports</h2>

                <div class="card report-card">
                    <div class="card-body">
                        <form action="<?= base_url('reports/generate') ?>" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Report Type</label>
                                    <select name="report_type" class="form-control" required>
                                        <option value="daily">Daily Report</option>
                                        <option value="weekly">Weekly Report</option>
                                        <option value="monthly">Monthly Report</option>
                                        <option value="custom">Custom Date Range</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employee</label>
                                    <select name="employee_id" class="form-control" required>
                                        <option value="all">All Employees</option>
                                        <?php foreach ($employees as $emp): ?>
                                            <option value="<?= $emp['UserID'] ?>">
                                                <?= $emp['FirstName'] . ' ' . $emp['LastName'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    📥 Generate & Download CSV Report
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Quick Reports</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card text-center quick-report-card">
                                    <div class="card-body">
                                        <h6>Today's Attendance</h6>
                                        <form action="<?= base_url('reports/generate') ?>" method="POST">
                                            <input type="hidden" name="report_type" value="daily">
                                            <input type="hidden" name="employee_id" value="all">
                                            <input type="hidden" name="start_date" value="<?= date('Y-m-d') ?>">
                                            <input type="hidden" name="end_date" value="<?= date('Y-m-d') ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Download</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card text-center quick-report-card">
                                    <div class="card-body">
                                        <h6>This Week</h6>
                                        <form action="<?= base_url('reports/generate') ?>" method="POST">
                                            <input type="hidden" name="report_type" value="weekly">
                                            <input type="hidden" name="employee_id" value="all">
                                            <input type="hidden" name="start_date" value="<?= date('Y-m-d', strtotime('monday this week')) ?>">
                                            <input type="hidden" name="end_date" value="<?= date('Y-m-d') ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Download</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card text-center quick-report-card">
                                    <div class="card-body">
                                        <h6>This Month</h6>
                                        <form action="<?= base_url('reports/generate') ?>" method="POST">
                                            <input type="hidden" name="report_type" value="monthly">
                                            <input type="hidden" name="employee_id" value="all">
                                            <input type="hidden" name="start_date" value="<?= date('Y-m-01') ?>">
                                            <input type="hidden" name="end_date" value="<?= date('Y-m-d') ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Download</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>