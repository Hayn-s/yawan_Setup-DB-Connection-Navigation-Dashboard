# Service Booking & Management System

A simple PHP and MySQL application for tracking clients, booking services, managing tool inventory, and recording payments.

## What's Inside

- **Dashboard:** Quick snapshot of clients, active services, total bookings, and total revenue.
- **Clients:** Manage client contact information.
- **Services:** Manage offered services and their hourly rates.
- **Bookings:** Schedule jobs and calculate costs based on hours worked.
- **Tool Inventory:** Track available tools and assign equipment to specific jobs.
- **Payments:** Log payments and payment methods.

## Database Structure

 The database is named `assessment_db`. Here is what each table does:

- `clients`: Customer details (name, email, phone, address).
- `services`: Available services and hourly rates.
- `bookings`: Active and past jobs linked to a client and service.
- `tools`: Total and available inventory counts.
- `booking_tools`: Tracks which tools are used for specific bookings.
- `payments`: Tracks amounts paid per booking and payment methods.

## File Structure

```
assessment_beginner/
├── db.php                  # Database connection setup
├── index.php               # Main dashboard
├── nav.php                 # Navigation bar
└── pages/
    ├── clients_add.php     # Add client form
    ├── clients_list.php    # View all clients
    ├── services_list.php   # View services
    ├── bookings_create.php # Book a service
    ├── bookings_list.php   # View all bookings
    ├── tools_list_assign.php # Inventory & assigning tools
    └── payments_list.php   # View payment records
```

## Setup Instructions

### Prerequisites
You need a local PHP/MySQL environment installed (like XAMPP, WAMP, or MAMP).

### Setup Steps

1. **Move files to your web directory:**
   Copy the `assessment_beginner` folder into your local server root (for XAMPP, this is `htdocs`).
   *Path:* `C:/xampp/htdocs/assessment_beginner/`

2. **Import the database:**
   - Open XAMPP and start **Apache** and **MySQL**.
   - Go to `http://localhost/phpmyadmin` in your browser.
   - Click the **SQL** tab.
   - Copy everything inside `schema.sql`, paste it into the query box, and run it. This creates the `assessment_db` database, tables, and sample data.

3. **Check database configuration:**
   Open `db.php` and make sure your MySQL credentials match:
   ```php
   $host = "localhost";
   $user = "root";
   $pass = ""; // Default is blank for XAMPP
   $dbname = "assessment_db";
   ```

4. **Launch the app:**
   Go to `http://localhost/assessment_beginner/index.php` in your browser.