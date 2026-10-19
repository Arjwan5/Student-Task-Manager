# Student Task Manager

Course Project: CSC 1405 - Advanced Software Engineering
University of Tabuk

## Project Overview

A web-based application designed for students to manage their academic tasks and for instructors (admins) to assign specific tasks to students. Developed with a focus on simplicity, usability, and core software engineering principles.

## Features

- Student Dashboard: Create, update, and track personal tasks.
- Admin Dashboard: Monitor all student tasks and assign new ones.
- Notifications System: Get alerted when new tasks are assigned or tasks are completed.
- Urgent Deadline Alerts: Visual warnings for tasks due within 24 hours.
- Security: MD5 password hashing, Session management, and Role-Based Access Control (RBAC).

## Tech Stack

- Frontend: HTML5, CSS3 (Custom Design).
- Backend: PHP 8.x (Procedural style).
- Database: MySQL.
- Environment: XAMPP / WAMP / MAMP.

## Installation and Running

1. Clone/Download: Extract the project folder into your XAMPP htdocs directory (e.g., C:\xampp\htdocs\project).
2. Start XAMPP: Open XAMPP Control Panel and start Apache and MySQL.
3. Database Setup:
   - Open your browser and go to: http://localhost/project/setup.php
   - This script will automatically create the database csc1405_project and all necessary tables.
4. Login Credentials:
   - Admin: admin@tabuk.edu.sa | Password: 123456
   - Student: Register a new account via the "Register" page.
5. Start Using: Go to http://localhost/project/index.php.

## Project Structure

- /css: Stylesheets.
- /docs: Project reports (Proposal, Sprint reports, Final Report).
- /includes: Reusable components (db connection, header, footer).
- setup.php: Database initializer.
- index.php: Student dashboard.

## Team: 

- Shouq Alanazi (ID: 441003943)
- Sarah Albulayhid (ID: 441003399)
- Arjwan Alamri (ID: 441000970)
