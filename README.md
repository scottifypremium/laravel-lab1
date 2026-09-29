# Laravel Request System

## Project Description
A Laravel-based web application developed as part of a DevOps laboratory activity. The project demonstrates the setup of a Laravel application, its connection to a MySQL database, and the establishment of a complete DevOps workflow — from local development and version control (Git) to remote repository hosting (GitHub).

## Student Information
- **Names:** Scott Denver Habla, Shenna Mea Conde
- **Course, Year & Section:** BSIT 4th Year, Block 3

## Software Requirements
- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL / MariaDB
- Node.js & NPM (for frontend asset compilation)
- Git
- A code editor (e.g., VS Code)
- Web server (Laravel's built-in server via `php artisan serve`, or XAMPP/WAMP/Laragon)

## Laravel Installation Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/laravel-request-system.git
   cd laravel-request-system
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   npm install
   ```
4. Copy the example environment file and configure it:
   ```bash
   cp .env.example .env
   ```
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Update the `.env` file with your local database credentials (see **Database Name** below).

## Database Name
```
laravel_request_system_db
```

## Database Import Instructions
1. Create the database in MySQL (via phpMyAdmin or the command line):
   ```sql
   CREATE DATABASE laravel_request_system_db;
   ```
2. Update your `.env` file with the database name, username, and password:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_request_system_db
   DB_USERNAME=your_db_username
   DB_PASSWORD=your_db_password
   ```
3. Run the Laravel migrations to build the database structure:
   ```bash
   php artisan migrate
   ```

## Commands Needed to Run the Project
```bash
# Start the local development server
php artisan serve

# (Optional) Compile frontend assets
npm run dev
```
Then open the project in your browser at:
```
http://127.0.0.1:8000
```

## GitHub Repository Link
https://github.com/scottifypremium/laravel-lab1.git

## Laboratory 2: Request Data Model

### requests table
| Field | Type | Constraint | Purpose |
|---|---|---|---|
| id | BIGINT UNSIGNED | Primary key, auto-increment | Unique request number |
| requester_name | VARCHAR(100) | NOT NULL | Person submitting the request |
| requester_email | VARCHAR(255) | NOT NULL | Contact address |
| item_name | VARCHAR(150) | NOT NULL | Requested item or service |
| quantity | INT UNSIGNED | NOT NULL | Requested quantity |
| purpose | TEXT | NOT NULL | Reason for the request |
| status | VARCHAR(20) | NOT NULL, default `pending` | Request state |
| created_at, updated_at | TIMESTAMP | Nullable | Creation and update times |

### Migration command
php artisan migrate

### How to verify the table
1. Run `php artisan migrate:status` and check that `create_requests_table` is marked Ran.
2. Open the database in phpMyAdmin and check the Structure tab of `requests`.
3. Run `SELECT id, requester_name, item_name, quantity, status FROM requests;`

### User stories
1. As a requester, I want to record my name, email, item, quantity, and purpose so that my request is saved and can be reviewed later.
2. As a staff reviewer, I want to see the item, quantity, purpose, and status of each request so that I can decide which requests need action.
3. As a record keeper, I want every request to have a unique number and time records so that I can trace when it was created and last changed.