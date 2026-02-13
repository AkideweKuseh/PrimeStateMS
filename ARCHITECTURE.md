# Architecture Documentation

PrimeStateMS follows a **Model-View-Controller (MVC)** organizational structure, though it utilizes **file-based routing** rather than a single central router (entry point). This means specific files are responsible for specific pages and actions, making the codebase easy to navigate and understand.

## 🏗️ Architectural Overview

-   **Views**: Display the user interface. Located in `views/`.
-   **Controllers**: Handle business logic and form submissions. Located in `controllers/`.
-   **Models**: Interact with the database. Located in `models/`.
-   **Core/Config**: Provide foundational services like database connections, authentication, and helper functions.

## 📂 Directory & File Roles

### 1. Configuration & Core (`config/`, `core/`)

These files set up the environment and provide static utilities used across the application.

-   **`config/config.php`**: Use this to define global constants like `BASE_URL`, database credentials (if not in the class), and session settings.
-   **`config/Database.php`**: A class responsible for creating and returning a PDO database connection. It ensures a single consistent way to connect to MySQL.
-   **`core/Auth.php`**: Handles user authentication state.
    -   `check()`: Returns true if a user is logged in.
    -   `user()`: Returns the current user's data.
    -   `requireLogin()`: Redirects unauthenticated users to the login page.
    -   `attempt()`: Validates credentials against the database.
-   **`core/Helper.php`**: standard utility functions.
    -   `redirect()`: easy utility for header redirects.
    -   `flash()`: Sets temporary session messages (success/error) for notifications.
    -   `sanitize()`: Cleans input data to prevent XSS.

### 2. Models (`models/`)

Each file here represents a database table and encapsulates all SQL queries related to it.

-   **`models/User.php`**: Handles user registration, login verification, and profile updates.
-   **`models/Property.php`**: Manages property listings. Includes methods to `create`, `read` (with filters), `update`, and `delete` properties.
-   **`models/Booking.php`**: Manages booking records. Handles creating requests, updating status (confirm/cancel), and preventing duplicate bookings (`isBookedByUser`).

### 3. Controllers (`controllers/`)

These files act as the "traffic cops". They receive requests (usually POST requests from forms), talk to the Models, and decide where to send the user next.

-   **`controllers/AuthController.php`**:
    -   `register()`: Validates input, calls `User->create()`, logs the user in.
    -   `login()`: checks credentials via `User` model.
    -   `logout()`: destroys session.
-   **`controllers/PropertyController.php`**:
    -   `create()`: Handles the "Add Property" form, including image uploads.
    -   `update()`: process edits to existing properties.
    -   `delete()`: removes a property.
-   **`controllers/BookingController.php`**:
    -   `book()`: Validates availability, calls `Booking->create()`.
    -   `updateStatus()`: (Admin) Approves or rejects bookings.
    -   `delete()`: (Client) Removes a pending/cancelled booking.

### 4. Views (`views/`)

The presentation layer. These are standard PHP files that mix HTML with PHP for dynamic content.

#### `views/public/`
Accessible to everyone.
-   `home.php`: Landing page.
-   `properties.php`: The search/filter catalog page.
-   `property-details.php`: Single property view. Contains the form to submit a booking request.

#### `views/client/`
Protected pages for logged-in tenants/buyers.
-   `dashboard.php`: Shows summary cards (Active Bookings) and recommended properties.
-   `bookings.php`: A list of all user bookings with actions (Delete).

#### `views/admin/`
Protected pages for administrators.
-   `dashboard.php`: Stats overview.
-   `properties/`: Sub-folder for creating/editing listings.
-   `bookings/`: Sub-folder for managing client requests.

#### `views/layouts/`
Reusable UI components.
-   `header.php` / `footer.php`: Global navigation and styling.
-   `client-sidebar.php`: Navigation for the client dashboard.
-   `admin-sidebar.php`: Navigation for the admin dashboard.

## 🔄 Request Flow Example: Booking a Property

1.  **User Action**: User submits the "Book Now" form on `views/public/property-details.php`.
2.  **Route**: The form action points to `controllers/BookingController.php?action=book`.
3.  **Controller**:
    -   `BookingController` initializes.
    -   Checks if user is logged in (via `Auth`).
    -   Checks if user already booked this property (via `Booking` model).
    -   Instantiates `Booking` model and calls `create()`.
4.  **Model**: `Booking->create()` executes the `INSERT` SQL query.
5.  **Response**:
    -   If successful: Controller calls `Helper::flash('success', ...)` and redirects to `views/client/bookings.php`.
    -   If failed: Controller flashes error and redirects back to property page.
