# Service Booking & Management System

A simple PHP and MySQL application for managing clients, service bookings, tool inventory, and payments.

## What's Inside

* **Dashboard:** View a quick summary of clients, services, bookings, and revenue.
* **Clients:** Add, view, and edit client information.
* **Services:** View and manage available services and hourly rates.
* **Bookings:** Create and manage service bookings.
* **Tool Inventory:** Track available tools and assign them to bookings.
* **Payments:** Record payments and payment methods.

## Client Management

The client section now includes:

* **Add Client:** Add a new client with their name, email, phone number, and address.
* **Client List:** View all registered clients.
* **Edit Client:** Update existing client information.
* **Validation:** Full Name and Email are required when adding or editing a client.

## Database Structure

The database is named `assessment_db`.

* `clients`: Stores client name, email, phone number, and address.
* `services`: Stores available services and hourly rates.
* `bookings`: Stores bookings connected to clients and services.
* `tools`: Stores tool inventory and availability.
* `booking_tools`: Tracks tools assigned to specific bookings.
* `payments`: Stores payment records and payment methods.

## File Structure

```text
assessment_beginner/
├── db.php                    # Database connection
├── index.php                 # Main dashboard
├── nav.php                   # Navigation bar
└── pages/
    ├── clients_add.php       # Add a new client
    ├── clients_list.php      # View all clients
    ├── clients_edit.php      # Edit client information
    ├── services_list.php     # View services
    ├── bookings_create.php   # Create a booking
    ├── bookings_list.php     # View bookings
    ├── tools_list_assign.php # View and assign tools
    └── payments_list.php     # View payment records
```

## Setup Instructions

### Prerequisites

A local PHP and MySQL environment is required, such as:

* XAMPP
* WAMP
* MAMP

### Setup Steps

1. **Move the project folder**

   Copy the `assessment_beginner` folder into your local web server directory.

   For XAMPP:

   ```text
   C:/xampp/htdocs/assessment_beginner/
   ```

2. **Import the database**

   * Open XAMPP.
   * Start **Apache** and **MySQL**.
   * Open `http://localhost/phpmyadmin`.
   * Select the **SQL** tab.
   * Copy and run the contents of `schema.sql`.

   This will create the `assessment_db` database and its required tables.

3. **Check the database connection**

   Open `db.php` and make sure the database settings are correct:

   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $dbname = "assessment_db";
   ```

4. **Run the project**

   Open:

   ```text
   http://localhost/assessment_beginner/index.php
   ```

## Current Client Features

The system currently supports:

* Adding new clients
* Viewing registered clients
* Editing client information
* Saving client information to MySQL
* Required field validation for client name and email
