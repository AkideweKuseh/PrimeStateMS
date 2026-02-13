# PrimeStateMS - Prime Estate Management System

PrimeStateMS is a comprehensive web-based application designed for managing real estate properties and bookings. It provides a seamless experience for potential tenants ("Clients") to browse and book properties, while offering robust tools for administrators to manage listings, track bookings, and oversee operations.

## 🚀 Features

### 🏠 Public Interface
-   **Property Browsing**: extensive catalog of properties with filtering options (Location, Type, Price, Bedrooms, Bathrooms).
-   **Property Details**: Detailed views with high-quality images, amenities, and location info.
-   **Responsive Design**: Optimized for desktop and mobile devices using TailwindCSS.

### 👤 Client Portal
-   **Dashboard**: Overview of active bookings and recent activity.
-   **Booking Management**: Book properties, view booking status (Pending, Confirmed, Cancelled), and cancel/delete eligible bookings.
-   **Favorites**: Save properties to a wishlist (UI implemented).

### 🛡️ Admin Dashboard
-   **Property Management**: Add, Edit, and Delete property listings.
-   **Booking Oversight**: View all bookings, approve/confirm requests, or cancel them.
-   **Image Management**: Upload and manage property images.

## 🛠️ Technology Stack

-   **Backend**: PHP (Custom MVC Architecture)
-   **Frontend**: HTML5, JavaScript, TailwindCSS (CDN)
-   **Database**: MySQL / MariaDB
-   **Icons**: Google Material Symbols
-   **Fonts**: Inter (Google Fonts)

## 📂 Project Structure

> [!TIP]
> For a detailed breakdown of the MVC architecture, file roles, and request flow, please read the **[Architecture Documentation](ARCHITECTURE.md)**.

```
PrimeStateMS/
├── config/             # Database and Application configuration
├── controllers/        # Request handling logic (Auth, Booking, Property)
├── core/               # Core framework classes (Router, Helper, Auth middleware)
├── models/             # Database models (Booking, Property, User)
├── public/             # Public assets
├── sql/                # Database schema import files
├── uploads/            # Property image uploads storage
├── views/              # UI Templates
│   ├── admin/          # Admin-specific views
│   ├── client/         # Client-specific views
│   ├── layouts/        # Shared header/footer/sidebar layouts
│   └── public/         # Publicly accessible pages
└── index.php           # Entry point
```

## ⚙️ Installation & Setup

### Prerequisites
-   PHP 7.4 or higher
-   MySQL/MariaDB
-   Apache Server (e.g., via XAMPP, WAMP, or Laragon)

### Steps

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/your-username/PrimeStateMS.git
    cd PrimeStateMS
    ```
    *Or extract the source code to your web server's root directory (e.g., `htdocs` or `www`).*

2.  **Database Setup**
    -   Open your MySQL administration tool (e.g., phpMyAdmin).
    -   Create a new database named `real_estate_db`.
    -   Import the schema file located at `sql/database.sql` into the new database.

3.  **Configuration**
    -   **Database**: Open `config/Database.php`. The default settings are configured for a standard XAMPP setup:
        -   Host: `localhost`
        -   User: `root`
        -   Pass: ` ` (empty)
        -   DB: `real_estate_db`
        -   *Update these values if your local setup differs.*
    -   **Base URL**: Open `config/config.php`.
        -   Update `BASE_URL` if you are hosting the project in a subfolder different from `/PrimeStateMS/`.
        ```php
        define('BASE_URL', 'http://localhost/PrimeStateMS/');
        ```

4.  **Run the Application**
    -   Start your Apache and MySQL services.
    -   Open your browser and navigate to:
        `http://localhost/PrimeStateMS/`

## 🔑 Default Credentials (if applicable)

*Check your database `users` table for pre-seeded accounts or register a new account via the interface.*


