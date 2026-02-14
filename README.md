# 🏢 Prime Estate Management System

A comprehensive web-based real estate management platform for property listings, bookings, and payments.

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-orange)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

---

## 📋 Overview

Prime Estate Management System is a full-featured real estate management solution that streamlines property management, client bookings, and payment processing. Built with PHP and MySQL, it provides separate interfaces for administrators and clients with role-based access control.

### ✨ Key Features

- 🏠 **Property Management** - Complete CRUD operations with image uploads
- 🔍 **Advanced Search** - Filter properties by location, type, and price
- 📅 **Booking System** - Real-time booking with conflict prevention
- 💰 **Payment Processing** - Secure payment tracking and receipts
- 📊 **Reports & Analytics** - Comprehensive reporting dashboard
- 🔔 **Notifications** - Real-time alerts for bookings and payments
- ⚙️ **Admin Settings** - Configurable branding and currency
- 🎨 **Modern UI** - Responsive design with dark mode support

---

## 🚀 Quick Start

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP (recommended for local development)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd PrimeStateMS
   ```

2. **Create database**
   ```sql
   CREATE DATABASE real_estate_db;
   ```

3. **Import schema**
   ```bash
   mysql -u root -p real_estate_db < database/schema.sql
   ```

4. **Configure settings**
   - Edit `config/config.php` with your database credentials
   - Set your `BASE_URL`

5. **Run setup scripts**
   ```bash
   php tasks/create_settings_table.php
   ```

6. **Access the application**
   ```
   http://localhost/PrimeStateMS
   ```

### Default Admin Login
- **Email:** admin@primeestate.com
- **Password:** admin123 *(Change after first login)*

---

## 📖 Documentation

For comprehensive documentation, see [DOCUMENTATION.md](DOCUMENTATION.md)

**Contents:**
- System Architecture
- Detailed Feature Guide
- Database Schema
- User Roles & Permissions
- API Reference
- Troubleshooting Guide

---

## 🎯 Requirements Checklist

### Objectives ✅
- [x] Centralized property management platform
- [x] Online property search and booking
- [x] Admin dashboard with reports
- [x] Secure data handling
- [x] Reduced manual paperwork
- [x] Real-time updates

### Functional Requirements ✅
- [x] User Registration & Login
- [x] Property Management (CRUD)
- [x] Property Search & Filtering
- [x] Booking Management
- [x] Payment Processing
- [x] Report Generation
- [x] Notification System
- [x] Data Storage (MySQL)
- [x] Security & Access Control

**Status:** 100% Complete ✅

---

## 🏗️ Technology Stack

**Backend:**
- PHP 7.4+
- MySQL 5.7+
- PDO for database operations

**Frontend:**
- HTML5
- Tailwind CSS
- JavaScript (Vanilla)

**Architecture:**
- MVC Pattern
- Role-based Access Control
- RESTful routing

---

## 📂 Project Structure

```
PrimeStateMS/
├── config/           # Configuration files
├── core/             # Core utilities (Auth, Helper, Validator)
├── controllers/      # Business logic controllers
├── models/           # Database models
├── views/            # UI templates
│   ├── admin/        # Admin dashboard
│   ├── client/       # Client dashboard
│   ├── public/       # Public pages
│   └── layouts/      # Shared layouts
├── uploads/          # User uploads
└── tasks/            # Setup scripts
```

---

## 👥 User Roles

### 🔵 Client
- Browse and search properties
- Save favorite properties
- Book properties
- Make payments
- View history and receipts

### 🔴 Administrator
- All client features
- Manage properties
- Approve/reject bookings
- Verify payments
- Generate reports
- Configure system settings
- Create admin accounts

---

## 🔒 Security Features

- Bcrypt password hashing
- SQL injection prevention (PDO prepared statements)
- XSS protection (input sanitization)
- Role-based authorization
- Secure session management

---

## 🌟 Highlights

**Beyond Core Requirements:**
- Saved/Favorite properties system
- Comprehensive activity logging
- Dynamic branding (configurable logo, name, currency)
- Toast notification system
- Dark mode support
- Mobile-responsive design

---

## 📸 Screenshots

*(Add screenshots here)*

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 📧 Contact & Support

For support or inquiries:
- **Email:** support@primeestate.com
- **Documentation:** [DOCUMENTATION.md](DOCUMENTATION.md)
- **Issues:** [GitHub Issues](https://github.com/your-repo/issues)

---

## 🙏 Acknowledgments

- Tailwind CSS for the UI framework
- Google Material Symbols for icons
- PHP community for best practices

---

