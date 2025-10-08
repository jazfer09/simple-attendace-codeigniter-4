<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance & Timekeeping System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .hero-section {
            text-align: center;
            color: white;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }
        .btn-custom {
            padding: 15px 50px;
            font-size: 1.2rem;
            border-radius: 50px;
            background: white;
            color: #14100f;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
            color: #888f7f;
            background: #fafafa;
        }
        .features {
            margin-top: 4rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        .feature-card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 15px;
            width: 200px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .feature-card p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            color: white;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }
        .footer a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }
        .footer a:hover {
            color: #fafafa;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <h1 class="hero-title">⏰ Attendance & Timekeeping</h1>
        <p class="hero-subtitle">Simple, Efficient, Reliable Time Management System</p>
        
        <a href="<?= base_url('login') ?>" class="btn btn-custom">
            🔐 Login to Continue
        </a>
        
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h5>Employee Management</h5>
                <p>Manage your workforce efficiently</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h5>Attendance Tracking</h5>
                <p>Real-time punch in/out system</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📈</div>
                <h5>Reports & Analytics</h5>
                <p>Generate detailed reports</p>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>© 2025 Attendance & Timekeeping System | Developed by <a href="<?= base_url('about-developer') ?>">Jazfer John Emnace</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>