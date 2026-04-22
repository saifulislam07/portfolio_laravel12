# Luxury Monochrome Portfolio & CMS

![Laravel Version](https://img.shields.io/badge/Laravel-11.x%20%2F%2012.x-red)
![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue)
![License](https://img.shields.io/badge/License-MIT-green)

A premium, high-performance, and strictly monochromatic portfolio system designed for developers who value minimalism and high-end aesthetics. Built with Laravel, it features a robust administrative control panel to manage every aspect of your professional presence.

---

## 🌟 Key Features

### 🎨 Premium Aesthetic & UI

- **Luxury Monochrome Design**: A strict black-and-white, high-contrast visual language throughout the frontend and backend.
- **Dynamic Frontend**: Modern, responsive layouts powered by **AOS (Animate On Scroll)** and custom typography.
- **Custom Error Pages**: Professionally designed 404, 500, and 503 pages that maintain your brand's integrity even during failures.

### 🏢 Content Management (CMS)

- **Project Showcase**: Full CRUD management for projects with multi-image handling and unique slug generation.
- **Skill & Hobby Engine**: Manage your technical stack and personal interests dynamically from the dashboard.
- **Biometric Integration (Concept)**: Ready for expansion into automated data fetching.

### 📊 Advanced Admin Dashboard

- **Real-time Analytics**: Integrated **Chart.js** visualizations for Visitor Trends, Traffic Sources, and Page Performance.
- **Contact Management**: AJAX-powered message center with instant "Mark as Read" functionality and secure input purification.
- **Maintenance Mode**: Toggle your site availability with a single click from the admin topbar.

### 🛡️ Security & SEO

- **Backdoor Login**: Renamed authentication routes (`/backdoor`) for improved security through obscurity.
- **SEO Suite**: Dynamic meta tags (Description, Keywords) and an automated **Sitemap.xml** generator for rapid indexing.
- **Input Sanitization**: Multi-layer protection against XSS and script injection on all public forms.

---

## 🛠 Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Templates, Vanilla CSS, Bootstrap 5
- **Charts & Motion**: Chart.js, AOS.js
- **Icons**: FontAwesome 6 (Pro-style integration)

---

## 🚀 Installation Guide

Ensure you have **Composer**, **NPM**, and **MySQL** installed before proceeding.

### 1. Clone the Repository

```bash
git clone https://github.com/saifulislam07/portfolio_laravel12.git
cd portfolio_laravel12

```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

_Update your `.env` file with your database and mail credentials._

### 4. Database Setup & Seeding

```bash
php artisan migrate --seed
```

_This creates all tables and populates the system with professional sample data._

### 5. Start the Application

```bash
php artisan serve
```

---

## 🔑 Administrative Access

Use the following default credentials for the initial setup:

| Role            | Route       | Email             | Password   |
| :-------------- | :---------- | :---------------- | :--------- |
| **Super Admin** | `/backdoor` | `admin@admin.com` | `password` |

---

## 👨‍💻 Developer & Attribution

- **Developer**: Md Saiful Islam
      <!-- - **Portfolio**: [saiful.dev](https://your-portfolio-link.com) -->
- **GitHub**: [@saifulislam07](https://github.com/saifulislam07)

---

## ☕ Support My Work

If this project helped you or you find it useful, consider supporting my work!

<a href="https://paypal.me/tosaiful" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>

> "Crafted with a passion for minimalism and modern engineering."
