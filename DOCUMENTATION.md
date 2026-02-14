# Prime Estate Management System - Documentation

## Table of Contents
1. [System Overview](#system-overview)
2. [Objectives](#objectives)
3. [Functional Requirements](#functional-requirements)
4. [System Architecture](#system-architecture)
5. [Features](#features)
6. [Database Schema](#database-schema)
7. [User Roles](#user-roles)
8. [Installation Guide](#installation-guide)
9. [Usage Guide](#usage-guide)

---

## System Overview

Prime Estate Management System is a comprehensive web-based real estate management platform built with PHP and MySQL. It provides a centralized solution for managing properties, client bookings, payments, and administrative operations.

**Technology Stack:**
- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Frontend:** HTML, CSS (Tailwind CSS), JavaScript
- **Architecture:** MVC (Model-View-Controller)

---

## Objectives

✅ **Primary Objectives (All Achieved):**

1. Provide a centralized platform for managing real estate properties, clients, bookings, and payments efficiently
2. Enable clients to search, view, and book properties online in a seamless manner
3. Allow administrators to manage property listings, monitor bookings, and generate reports
4. Ensure secure handling of client data and payment transactions
5. Reduce manual paperwork and improve the accuracy of property management operations
6. Provide real-time updates on property availability and booking status

---

## Functional Requirements

### ✅ Core Requirements (100% Complete)

| Requirement | Status | Implementation |
|------------|--------|----------------|
| User Registration & Login | ✅ | Secure authentication with password hashing |
| Property Management | ✅ | Full CRUD operations with image upload |
| Property Search & Filter | ✅ | Location, type, and price-based filtering |
| Booking Management | ✅ | Booking system with status tracking |
| Payment Processing | ✅ | Payment records and receipt generation |
| Report Generation | ✅ | Properties, Bookings, and Payments reports |
| Notification System | ✅ | Real-time alerts for clients and admins |
| Data Storage | ✅ | MySQL database with 9 tables |
| Security & Access Control | ✅ | Role-based access control |

---

## System Architecture

### Directory Structure
```
PrimeStateMS/
├── config/
│   ├── config.php          # Application configuration
│   └── Database.php        # Database connection class
├── core/
│   ├── Auth.php            # Authentication and authorization
│   ├── Helper.php          # Utility functions
│   └── Validator.php       # Input validation
├── controllers/
│   ├── AuthController.php
│   ├── PropertyController.php
│   ├── BookingController.php
│   ├── PaymentController.php
│   ├── UserController.php
│   ├── ReportController.php
│   └── SettingController.php
├── models/
│   ├── User.php
│   ├── Property.php
│   ├── Booking.php
│   ├── Payment.php
│   ├── Notification.php
│   ├── Activity.php
│   ├── SavedProperty.php
│   └── Setting.php
├── views/
│   ├── auth/               # Login & Registration
│   ├── admin/              # Admin dashboard & features
│   ├── client/             # Client dashboard & features
│   ├── public/             # Public-facing pages
│   └── layouts/            # Reusable layouts
└── uploads/                # User-uploaded files
```

### MVC Pattern
- **Models:** Handle database operations and business logic
- **Views:** Render HTML and UI components
- **Controllers:** Process requests, interact with models, and load views

---

## Features

### 🔐 Authentication & Authorization
- User registration with email validation
- Secure login with password hashing (bcrypt)
- Role-based access control (Admin/Client)
- Session management

### 🏠 Property Management (Admin)
- Add new properties with images
- Edit existing property details
- Delete properties (soft/hard delete)
- Image upload and management
- Property status management

### 🔍 Property Search (Client)
- Browse all available properties
- Filter by location, type, and price range
- View detailed property information
- Save/favorite properties

### 📅 Booking System
- Client booking with date selection
- Double-booking prevention
- Booking status tracking (Pending → Confirmed → Cancelled)
- Admin booking management and approval
- Booking history for clients

### 💰 Payment Processing
- Payment record creation
- Payment confirmation and tracking
- Payment receipts generation
- Payment history for clients
- Admin payment verification

### 📊 Reports & Analytics
- Property reports
- Booking reports (filterable by status, date)
- Payment reports with revenue tracking
- Export/print functionality

### 🔔 Notification System
- Real-time notifications for:
  - New bookings (Admin)
  - Payment confirmations (Client & Admin)
  - Booking status changes (Client)
- Mark as read functionality
- Notification count badges

### 📝 Activity Logging
- Comprehensive audit trail
- User action tracking
- Activity timeline on dashboards

### ⚙️ Admin Settings
- Configure site name
- Upload site logo
- Set currency (code and symbol)
- Create new admin accounts
- View all administrators

### 🎨 User Interface
- Modern, responsive design (Tailwind CSS)
- Dark mode support
- Toast notifications for user feedback
- Mobile-friendly navigation
- Intuitive dashboards

---

## Database Schema

### Tables

1. **users**
   - `id`, `full_name`, `email`, `phone`, `password`, `role`, `status`, `profile_picture`, `created_at`

2. **properties**
   - `id`, `title`, `description`, `location`, `type`, `price`, `bedrooms`, `bathrooms`, `size`, `status`, `image`, `created_at`, `updated_at`

3. **bookings**
   - `id`, `user_id`, `property_id`, `start_date`, `end_date`, `status`, `total_amount`, `created_at`, `updated_at`

4. **payments**
   - `id`, `booking_id`, `user_id`, `amount`, `payment_method`, `transaction_id`, `status`, `payment_date`, `created_at`

5. **notifications**
   - `id`, `user_id`, `message`, `type`, `is_read`, `created_at`

6. **activities**
   - `id`, `user_id`, `action`, `description`, `created_at`

7. **saved_properties**
   - `id`, `user_id`, `property_id`, `created_at`

8. **settings**
   - `id`, `setting_key`, `setting_value`, `created_at`, `updated_at`

---

## User Roles

### 👤 Client Role
**Capabilities:**
- Browse and search properties
- Save favorite properties
- Book properties
- Make payments
- View booking history
- View payment history and receipts
- Receive notifications
- Update profile

**Access:** Client dashboard and public pages

### 👨‍💼 Admin Role
**Capabilities:**
- All Client capabilities, plus:
- Manage properties (CRUD)
- Manage all bookings
- Verify payments
- Generate reports
- View all users
- Configure system settings
- Create new admin accounts
- Access admin dashboard

**Access:** Full system access

---

## Installation Guide

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP (recommended for local development)

### Installation Steps

1. **Clone/Download the project**
   ```bash
   git clone <repository-url>
   cd PrimeStateMS
   ```

2. **Configure Database**
   - Create a new MySQL database named `real_estate_db`
   - Update database credentials in `config/config.php`

3. **Import Database Schema**
   ```bash
   mysql -u root -p real_estate_db < database/schema.sql
   ```

4. **Run Setup Scripts**
   ```bash
   php tasks/create_settings_table.php
   ```

5. **Configure Base URL**
   - Edit `config/config.php`
   - Set `BASE_URL` to your application URL

6. **Set Permissions**
   ```bash
   chmod -R 755 uploads/
   ```

7. **Access the Application**
   - Open browser: `http://localhost/PrimeStateMS`
   - Default admin credentials will be created on first run

### Default Admin Account
- **Email:** admin@primeestate.com
- **Password:** admin123 (Change after first login)

---

## Usage Guide

### For Clients

1. **Registration**
   - Click "Register" on the homepage
   - Fill in your details
   - Verify email and login

2. **Browsing Properties**
   - Use search filters (location, type, price)
   - Click on property cards for details
   - Save favorites by clicking the heart icon

3. **Booking a Property**
   - Select property → Click "Book Now"
   - Choose start and end dates
   - Submit booking request

4. **Making Payments**
   - Navigate to Bookings → View pending booking
   - Click "Make Payment"
   - Enter payment details and confirm

5. **Viewing History**
   - Dashboard shows summary of bookings and payments
   - Access detailed history via sidebar menus

### For Administrators

1. **Property Management**
   - Dashboard → Properties → Add New
   - Fill property details and upload images
   - Edit/Delete from property list

2. **Booking Management**
   - Bookings → View all bookings
   - Filter by status or date
   - Confirm or cancel bookings

3. **Payment Verification**
   - Payments → View all transactions
   - Verify payment details
   - Update booking status upon confirmation

4. **Generate Reports**
   - Reports → Select report type
   - Apply filters (date range, status)
   - Print or export data

5. **System Settings**
   - Settings → General Settings
   - Update site name, logo, currency
   - Settings → Admin Management
   - Create new admin accounts

---

## Security Features

- **Password Security:** Bcrypt hashing with salt
- **SQL Injection Prevention:** Prepared statements (PDO)
- **XSS Protection:** Input sanitization with `htmlspecialchars()`
- **CSRF Protection:** Session-based validation
- **Access Control:** Role-based authorization checks
- **Session Security:** Secure session handling

---

## Support & Maintenance

### Common Issues

**Issue:** Database connection error
- **Solution:** Verify database credentials in `config/config.php`

**Issue:** Images not uploading
- **Solution:** Check `uploads/` folder permissions (755)

**Issue:** Settings not applying
- **Solution:** Clear browser cache and refresh

### Maintenance Tasks

1. **Regular Backups:** Schedule daily database backups
2. **Log Monitoring:** Review activity logs weekly
3. **Update Dependencies:** Keep PHP and MySQL updated
4. **Security Patches:** Apply security updates promptly

---

## Additional Features (Bonus)

Beyond the core requirements, the system includes:

- **Saved Properties:** Bookmark system for clients
- **Activity Logging:** Comprehensive audit trail
- **Dynamic Settings:** Configurable branding and currency
- **Toast Notifications:** Enhanced user feedback
- **Responsive Design:** Mobile-optimized interface
- **Dark Mode:** Theme switching support

---

## System Requirements Met: ✅ 100%

All functional requirements and objectives have been successfully implemented and tested.

---

**Version:** 1.0  
**Last Updated:** February 2026  
**Developed By:** Prime Estate Development Team
