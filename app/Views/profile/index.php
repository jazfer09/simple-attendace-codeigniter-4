<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); }
        .sidebar { background: white; min-height: calc(100vh - 56px); border-right: 1px solid #dee2e6; }
        .sidebar a { color: #333; padding: 1rem; display: block; text-decoration: none; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); color: white; }
        .profile-header { 
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); 
            color: white; 
            padding: 2rem; 
            border-radius: 10px; 
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .btn-outline-light:hover { background: rgba(255,255,255,0.2); }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .card-header { 
            background: #f8f9fa; 
            border-bottom: 2px solid #14100f; 
            font-weight: 600;
        }
        h2, h5 { color: #14100f; }
        .profile-header h2, .profile-header p { color: white; }
        .badge.bg-danger { background: #14100f !important; }
        .badge.bg-info { background: #888f7f !important; }
        .table th { color: #14100f; font-weight: 600; }
        .form-label { color: #14100f; font-weight: 500; }
        .form-control:focus {
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
                <?php if (session()->get('role') == 'admin'): ?>
                    <a href="<?= base_url('employees') ?>">👥 Employees</a>
                    <a href="<?= base_url('reports') ?>">📈 Reports</a>
                <?php endif; ?>
                <a href="<?= base_url('profile') ?>" class="active">⚙️ Profile</a>
            </div>

            <div class="col-md-10 p-4">
                <div class="profile-header text-center">
                    <div class="display-1 mb-3">👤</div>
                    <h2><?= $user['FirstName'] . ' ' . $user['LastName'] ?></h2>
                    <p class="mb-0"><?= $user['Position'] ?> - <?= $user['Department'] ?></p>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Profile Information</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">User ID:</th>
                                        <td><?= $user['UserID'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Full Name:</th>
                                        <td><?= $user['FirstName'] . ' ' . ($user['MiddleName'] ?? '') . ' ' . $user['LastName'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Username:</th>
                                        <td><?= $user['Username'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Role:</th>
                                        <td><span class="badge bg-<?= $user['Role'] == 'admin' ? 'danger' : 'info' ?>"><?= ucfirst($user['Role']) ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Position:</th>
                                        <td><?= $user['Position'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Department:</th>
                                        <td><?= $user['Department'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Member Since:</th>
                                        <td><?= date('F j, Y', strtotime($user['EntryDate'])) ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('profile/change-password') ?>" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control" required minlength="6">
                                        <small class="text-muted">Minimum 6 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" name="confirm_password" class="form-control" required minlength="6">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
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