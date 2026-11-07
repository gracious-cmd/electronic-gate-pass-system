# Electronic Security Gate Pass System

A PHP + MySQLi visitor access management system for XAMPP.

## Requirements
- Windows 10/11
- XAMPP (Apache and MySQL)
- VS Code
- Web browser

## Installation
1. Copy the `electronic-gate-pass` folder into `C:\xampp\htdocs\`.
2. Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. Visit `http://localhost/phpmyadmin`.
4. Select **Import**, choose `database/gate_pass.sql`, then click **Go**.
5. Visit `http://localhost/electronic-gate-pass/setup.php`.
6. Create the first administrator account. Use a strong password (at least 8 characters).
7. **Delete `setup.php` after creating the administrator.**
8. Open `http://localhost/electronic-gate-pass/`.

## Main workflows
- Public visitor: request a gate pass from the home page.
- Administrator: log in, review pending requests, approve/reject, manage staff, view records and reports.
- Security officer: log in and record visitor entry/exit using the pass reference.
- Staff accounts: create them from Admin > Employees.

## Notes
- Database settings are in `config/database.php`. Default XAMPP MySQL settings are host `localhost`, user `root`, blank password.
- If you set a MySQL root password, update the password in `config/database.php`.
- Gate entry is accepted only for an approved pass whose visit date is today. A pass can only have one entry and one exit record.
- This is a learning/academic project. Before real deployment, add HTTPS, backups, rate limiting, audit logging, stronger operational controls, privacy notices, and independent security testing.
- Never expose this local XAMPP installation directly to the public internet.

# electronic-gate-pass-system
A web-based electronic gate pass management system developed using php, MySQL, html, CSS and JavaScript
