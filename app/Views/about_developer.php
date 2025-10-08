<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Developer - Attendance System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }
        .about-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 3rem;
            max-width: 700px;
            width: 100%;
            text-align: center;
        }
        .developer-photo {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #14100f;
            margin: 0 auto 2rem;
            display: block;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .developer-name {
            color: #14100f;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .developer-title {
            color: #888f7f;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .thank-you-section {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin: 2rem 0;
        }
        .thank-you-section h3 {
            margin-bottom: 1rem;
        }
        .thank-you-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }
        .tech-stack {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }
        .tech-badge {
            background: #f8f9fa;
            border: 2px solid #14100f;
            color: #14100f;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .btn-back {
            background: linear-gradient(135deg, #14100f 0%, #888f7f 100%);
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            color: white;
        }
        .contact-info {
            margin-top: 2rem;
            color: #666;
        }
        .contact-info a {
            color: #888f7f;
            text-decoration: none;
            font-weight: 600;
        }
        .contact-info a:hover {
            color: #14100f;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="about-card">
        <!-- Developer Photo (Replace with actual image URL) -->
        <img src="<?= base_url('images/hero.png') ?>" alt="Jazfer John Emnace" class="developer-photo">
        
        <h1 class="developer-name">Jazfer John Emnace</h1>
        <p class="developer-title">Full Stack Developer | CodeIgniter 4 Specialist</p>
        
        <div class="thank-you-section">
            <h3>🙏 Thank You for Learning!</h3>
            <p>Thank you for exploring this Attendance & Timekeeping System.</p>
            <p>This project was built with CodeIgniter 4 framework, demonstrating modern web development practices and clean code architecture.</p>
            <p>I hope this system helps you understand the power and flexibility of CodeIgniter 4!</p>
        </div>
        
        <h4 style="color: #14100f; margin-top: 2rem;">Technologies Used</h4>
        <div class="tech-stack">
            <span class="tech-badge">CodeIgniter 4</span>
            <span class="tech-badge">PHP 8.x</span>
            <span class="tech-badge">MySQL</span>
            <span class="tech-badge">Bootstrap 5</span>
            <span class="tech-badge">JavaScript</span>
            <span class="tech-badge">HTML5/CSS3</span>
        </div>
        
        <div class="contact-info">
            <p>📧 Email: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=jazferjohnemnace@gmail.com" target="_blank">jazferjohnemnace@gmail.com</a></p>
            <p>💼 LinkedIn: <a href="https://www.linkedin.com/in/jazfer-john-emnace-2b341437a" target="_blank">Jazfer John Emnace</a></p>
            <p>🔗 GitHub: <a href="https://github.com/jazfer09" target="_blank">github.com/jazfer09</a></p>
        </div>
        
        <div style="margin-top: 2rem;">
            <a href="<?= base_url('/') ?>" class="btn-back">← Back to Home</a>
        </div>
    </div>
</body>
</html>