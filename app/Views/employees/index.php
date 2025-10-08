<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); }
        .sidebar { background: white; min-height: calc(100vh - 56px); border-right: 1px solid #dee2e6; }
        .sidebar a { color: #333; padding: 1rem; display: block; text-decoration: none; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: linear-gradient(135deg, #14100f 0%, #888f7f 100%); color: white; }
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
        .btn-outline-light:hover { background: rgba(255,255,255,0.2); }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .table thead th { color: #14100f; border-bottom: 2px solid #888f7f; font-weight: 600; }
        h2, h5 { color: #14100f; }
        .badge.bg-danger { background: #14100f !important; }
        .badge.bg-info { background: #888f7f !important; }
        .modal-header .btn-close { 
            filter: invert(1); 
        }
        .form-label { color: #14100f; font-weight: 500; }
        .form-control:focus, .form-select:focus {
            border-color: #14100f;
            box-shadow: 0 0 0 0.2rem rgba(20, 16, 15, 0.15);
        }
        .btn-secondary {
            background: #888f7f;
            border: none;
        }
        .btn-secondary:hover {
            background: #14100f;
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
                <a href="<?= base_url('employees') ?>" class="active">👥 Employees</a>
                <a href="<?= base_url('reports') ?>">📈 Reports</a>
                <a href="<?= base_url('profile') ?>">⚙️ Profile</a>
            </div>

            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Employee Management</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        ➕ Add Employee
                    </button>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $emp): ?>
                                    <tr>
                                        <td><?= $emp['UserID'] ?></td>
                                        <td><?= $emp['FirstName'] . ' ' . $emp['LastName'] ?></td>
                                        <td><?= $emp['Username'] ?></td>
                                        <td><span class="badge bg-<?= $emp['Role'] == 'admin' ? 'danger' : 'info' ?>"><?= ucfirst($emp['Role']) ?></span></td>
                                        <td><?= $emp['Position'] ?></td>
                                        <td><?= $emp['Department'] ?></td>
                                        <td>
                                            <form action="<?= base_url('employees/delete/' . $emp['UserID']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete this employee?');">
                                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('employees/add') ?>" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="employee">Employee</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>