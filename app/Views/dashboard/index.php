<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); }
        .sidebar { background: white; min-height: calc(100vh - 56px); border-right: 1px solid #dee2e6; }
        .sidebar a { color: #333; padding: 1rem; display: block; text-decoration: none; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); color: white; }
        .card-stat { border-left: 4px solid #14100f; }
        .punch-card { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); color: white; }
        .btn-punch { background: white; color: #14100f; font-weight: bold; transition: all 0.3s ease; }
        .btn-punch:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        .btn-outline-light:hover { background: rgba(255,255,255,0.2); }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .card-header { background: #f8f9fa; border-bottom: 2px solid #14100f; font-weight: 600; }
        .badge.bg-success { background: #888f7f !important; }
        .table thead th { color: #14100f; border-bottom: 2px solid #888f7f; }
        h2, h5 { color: #14100f; }
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
                <a href="<?= base_url('dashboard') ?>" class="active">📊 Dashboard</a>
                <?php if (session()->get('role') == 'admin'): ?>
                    <a href="<?= base_url('employees') ?>">👥 Employees</a>
                    <a href="<?= base_url('reports') ?>">📈 Reports</a>
                <?php endif; ?>
                <a href="<?= base_url('profile') ?>">⚙️ Profile</a>
            </div>

            <div class="col-md-10 p-4">
                <h2 class="mb-4">Dashboard</h2>

                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card punch-card">
                            <div class="card-body text-center">
                                <h3>Today's Attendance</h3>
                                <p class="mb-4"><?= date('l, F j, Y') ?> - <?= date('h:i A') ?></p>
                                
                                <?php if ($today_attendance && $today_attendance['PunchOut'] == null): ?>
                                    <p class="fs-5">✅ Punched In at: <?= date('h:i A', strtotime($today_attendance['PunchIn'])) ?></p>
                                    <form action="<?= base_url('dashboard/punch') ?>" method="POST">
                                        <input type="hidden" name="action" value="punch_out">
                                        <button type="submit" class="btn btn-punch btn-lg">Punch Out</button>
                                    </form>
                                <?php elseif ($today_attendance && $today_attendance['PunchOut'] != null): ?>
                                    <p class="fs-5">✅ Already completed for today</p>
                                    <p>In: <?= date('h:i A', strtotime($today_attendance['PunchIn'])) ?> | Out: <?= date('h:i A', strtotime($today_attendance['PunchOut'])) ?></p>
                                    <p>Total Hours: <?= number_format($today_attendance['TotalHours'], 2) ?> hrs</p>
                                <?php else: ?>
                                    <form action="<?= base_url('dashboard/punch') ?>" method="POST">
                                        <input type="hidden" name="action" value="punch_in">
                                        <button type="submit" class="btn btn-punch btn-lg">Punch In</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-stat mb-3">
                            <div class="card-body">
                                <h6 class="text-muted">Days Present (This Month)</h6>
                                <h2><?= $monthly_stats['days_present'] ?? 0 ?></h2>
                            </div>
                        </div>
                        <div class="card card-stat">
                            <div class="card-body">
                                <h6 class="text-muted">Total Hours (This Month)</h6>
                                <h2><?= number_format($monthly_stats['total_hours'] ?? 0, 1) ?> hrs</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Recent Attendance History</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Total Hours</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($attendance_history)): ?>
                                    <?php foreach ($attendance_history as $record): ?>
                                        <tr>
                                            <td><?= date('M j, Y', strtotime($record['PunchIn'])) ?></td>
                                            <td><?= date('h:i A', strtotime($record['PunchIn'])) ?></td>
                                            <td><?= $record['PunchOut'] ? date('h:i A', strtotime($record['PunchOut'])) : '<span class="text-muted">-</span>' ?></td>
                                            <td><?= $record['TotalHours'] ? number_format($record['TotalHours'], 2) . ' hrs' : '<span class="text-muted">-</span>' ?></td>
                                            <td><span class="badge bg-success"><?= ucfirst($record['Status']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No attendance records found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>