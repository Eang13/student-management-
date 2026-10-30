# Student Management System – Laravel 13

Features: Login/Register, Departments (PK) <-> Students (FK) relationship, seeders,
CRUD with search + filters + sorting, HTML table lists, Bootstrap 5 UI.

## Setup (fresh Laravel 13 project)
1. composer create-project laravel/laravel student-management
   cd student-management
2. Copy the folders from this package (app, database, resources, routes) into the
   project, overwriting existing files.
3. Edit .env for MySQL:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
4. php artisan migrate:fresh --seed
   php artisan serve
5. Open http://127.0.0.1:8000
   Login: admin@gmail.com / password123  (or register a new account)

## Push to GitHub
   git init
   git add .
   git commit -m "Laravel 13 Student Management System"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/student-management.git
   git push -u origin main

## Tables
departments: dept_id (PK), dept_name, manager_id, location_id, timestamps
students: student_id (PK), student_name, email, gender, enrollment_date, description,
          department_id (FK -> departments.dept_id), timestamps
