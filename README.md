📋 Simple Attendance & Timekeeping System
A comprehensive web-based attendance and timekeeping management system built with CodeIgniter 4 and MySQL. This system provides role-based access control for administrators and employees to manage attendance records efficiently.

✨ Features
🔐 Authentication & Security

Secure login/logout system
Password encryption using bcrypt
Role-based access control (Admin & Employee)
Protected routes with custom filters
Session management

👥 User Roles
Admin Features:

✅ Employee management (CRUD operations)
✅ View all attendance records
✅ Generate and export reports (CSV)
✅ Dashboard with system overview
✅ Manage employee profiles

Employee Features:

✅ Punch in/out functionality
✅ View personal attendance history
✅ Monthly statistics (days present, total hours)
✅ Profile management
✅ Change password

📊 Core Modules

Dashboard

Real-time punch in/out
Today's attendance status
Monthly statistics
Recent attendance history


Employee Management (Admin only)

Add new employees
View employee list
Soft delete employees
Edit employee information


Reports (Admin only)

Generate attendance reports by date range
Filter by employee or all employees
Export to CSV format
Quick reports (Today, This Week, This Month)


Profile Settings

View personal information
Change password with validation
Update profile details




🛠️ Technology Stack

Backend: PHP 8.x, CodeIgniter 4
Database: MySQL 8.x / MariaDB
Frontend: HTML5, CSS3, JavaScript
UI Framework: Bootstrap 5.1.3
Server: Apache (XAMPP/WAMP/LAMP)


📦 Installation
Prerequisites

PHP 8.0 or higher
MySQL 8.0 or MariaDB
Apache Web Server
Composer (optional, for dependencies)

Step 1: Clone Repository
bashgit clone https://github.com/yourusername/attendance-system.git
cd attendance-system
Step 2: Database Setup

Create a database named dict
Import the SQL file:

sqlmysql -u root -p dict < database/dict.sql
Or use phpMyAdmin:

Open phpMyAdmin
Create database: dict
Import database/dict.sql

Step 3: Configure Database
Edit app/Config/Database.php:
phppublic array $default = [
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'dict',
    // ...
];
Step 4: Configure Base URL
Edit app/Config/App.php:
phppublic string $baseURL = 'http://localhost/attendance-system';
Step 5: Set Permissions (Linux/Mac)
bashchmod -R 755 writable/
Step 6: Run the Application
bash# For PHP built-in server
php spark serve

# Or access via Apache
http://localhost/attendance-system

🔑 Default Credentials
Admin Account

Username: admin
Password: 1

Employee Account

Username: employee
Password: 1


⚠️ Important: Change these credentials after first login!


📁 Project Structure
attendance-system/
├── app/
│   ├── Config/
│   │   ├── Database.php      # Database configuration
│   │   ├── Filters.php       # Filter configuration
│   │   └── Routes.php        # Route definitions
│   ├── Controllers/
│   │   ├── Auth.php          # Authentication controller
│   │   ├── Dashboard.php     # Dashboard controller
│   │   ├── Employees.php     # Employee management
│   │   ├── Reports.php       # Report generation
│   │   ├── Profile.php       # User profile
│   │   └── Home.php          # Landing page
│   ├── Filters/
│   │   ├── AuthFilter.php    # Authentication filter
│   │   └── AdminFilter.php   # Admin authorization filter
│   ├── Models/
│   │   ├── UserModel.php     # User data model
│   │   └── AttendanceModel.php # Attendance data model
│   └── Views/
│       ├── home.php
│       ├── auth/
│       │   └── login.php
│       ├── dashboard/
│       │   └── index.php
│       ├── employees/
│       │   └── index.php
│       ├── reports/
│       │   └── index.php
│       └── profile/
│           └── index.php
├── public/
│   └── index.php             # Entry point
├── database/
│   └── dict.sql              # Database schema
└── README.md

🗄️ Database Schema
Tables
user_tbl

UserID (Primary Key)
LastName, FirstName, MiddleName
Username, Password (hashed)
Role (admin/employee)
Position, Department
EntryDate, LastUpdatingDate, DateDeleted

attendance_tbl

AttendanceID (Primary Key)
UserID (Foreign Key)
PunchIn, PunchOut
TotalHours, Status
Remarks, EntryDate

reports_tbl

ReportID (Primary Key)
ReportName, ReportType
StartDate, EndDate
GeneratedBy (Foreign Key)
GeneratedDate, Filepath


🚀 Usage Guide
For Employees:

Login with your credentials
Navigate to Dashboard
Click "Punch In" when starting work
Click "Punch Out" when leaving
View your attendance history

For Administrators:

Login with admin credentials
Manage employees (Add/Delete)
Generate attendance reports
Export reports to CSV
Monitor all employee attendance


📸 Screenshots
Landing Page
Clean and modern landing page with feature highlights.
Login Page
Secure authentication with demo credentials.
Dashboard
Role-based dashboard with real-time attendance tracking.
Employee Management
CRUD operations for employee data.
Reports
Generate and export attendance reports in CSV format.

🔒 Security Features

✅ Password hashing with bcrypt
✅ Session-based authentication
✅ CSRF protection (can be enabled in Config)
✅ SQL injection prevention (Query Builder)
✅ XSS protection (CodeIgniter escaping)
✅ Role-based access control
✅ Protected routes with filters


🤝 Contributing
Contributions are welcome! Please follow these steps:

Fork the repository
Create a feature branch (git checkout -b feature/AmazingFeature)
Commit your changes (git commit -m 'Add some AmazingFeature')
Push to the branch (git push origin feature/AmazingFeature)
Open a Pull Request


📝 Future Enhancements

 Email notifications for attendance
 Biometric integration support
 Mobile responsive design improvements
 Leave management system
 Payroll calculation module
 Multi-language support
 Dark mode theme
 API endpoints for mobile app
 Advanced analytics dashboard
 Automated backup system


🐛 Known Issues

None reported yet. Please submit issues on GitHub.


📄 License
This project is licensed under the MIT License - see the LICENSE file for details.

👨‍💻 Author
Your Name

GitHub: @yourusername
Email: your.email@example.com


🙏 Acknowledgments

CodeIgniter 4 Framework
Bootstrap 5 for UI components
Font Awesome for icons
The PHP community


📞 Support
For support and queries:

Create an issue on GitHub
Email: support@example.com


📊 System Requirements
Minimum Requirements:

PHP 8.0+
MySQL 5.7+ or MariaDB 10.3+
Apache 2.4+
512MB RAM
100MB disk space

Recommended:

PHP 8.2+
MySQL 8.0+
Apache 2.4+ with mod_rewrite
1GB RAM
500MB disk space


⚡ Quick Start
bash# Clone the repository
git clone https://github.com/yourusername/attendance-system.git

# Navigate to project directory
cd attendance-system

# Import database
mysql -u root -p dict < database/dict.sql

# Start PHP server
php spark serve

# Open browser
http://localhost:8080

Made with ❤️ using CodeIgniter 4
⭐ Star this repo if you find it helpful!
