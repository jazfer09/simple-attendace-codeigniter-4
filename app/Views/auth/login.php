<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
        }
        .login-title {
            text-align: center;
            color: #14100f;
            margin-bottom: 2rem;
            font-weight: bold;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #888f7f;
        }
        .form-control:focus {
            border-color: #14100f;
            box-shadow: 0 0 0 0.2rem rgba(20, 16, 15, 0.15);
        }
        .form-label {
            color: #14100f;
            font-weight: 500;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            border: none;
            color: white;
            font-weight: bold;
            margin-top: 1rem;
        }
        .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            transition: all 0.3s;
        }
        .back-link {
            text-align: center;
            margin-top: 1rem;
        }
        .back-link a {
            color: #888f7f;
            text-decoration: none;
        }
        .back-link a:hover {
            color: #14100f;
        }
        .demo-credentials {
            border-top: 1px solid #e0e0e0;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
        .demo-credentials p {
            color: #888f7f;
            margin-bottom: 0.5rem;
        }
        .demo-credentials code {
            background-color: #f5f5f5;
            color: #14100f;
            padding: 2px 6px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 class="login-title">🔐 Login</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <form action="<?= base_url('login') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-login">Login</button>
        </form>
        
        <div class="back-link">
            <a href="<?= base_url('/') ?>">← Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>