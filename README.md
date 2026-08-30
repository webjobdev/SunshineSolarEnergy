# ☀️ Sunshine Solar Energy

[![Laravel Version](https://img.shields.io/badge/Laravel-12.63.0-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2.12-blue.svg)](https://php.net)
[![Composer Version](https://img.shields.io/badge/Composer-2.9.5-green.svg)](https://getcomposer.org)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange.svg)](https://mysql.com)

## 📋 Project Overview

Sunshine Solar Energy is a modern web application built with Laravel Framework 12.63.0. This project provides solar energy management solutions with a robust backend API.

### 🏗️ System Requirements

- **PHP**: ^8.2
- **Composer**: ^2.9.5
- **MySQL**: 5.7 or higher
- **Web Server**: Apache/Nginx (XAMPP 8.2.12)

### 🚀 Quick Installation

#### Prerequisites Setup (XAMPP)

1. Install **XAMPP 8.2.12** from [Apache Friends](https://www.apachefriends.org/)
2. Start **Apache** and **MySQL** services from XAMPP Control Panel
3. Install **Composer** globally from [getcomposer.org](https://getcomposer.org/)

#### Step-by-Step Installation

```bash
# Step 1: Clone or create project
git clone [repository-url] sunshine-solar-energy
# OR
composer create-project laravel/laravel sunshine-solar-energy

# Step 2: Navigate to project
cd sunshine-solar-energy

# Step 3: Install PHP dependencies
composer install

# Step 4: Create environment file
cp .env.example .env

# Step 5: Generate application key
php artisan key:generate

# Step 6: Configure MySQL Database
# Open phpMyAdmin (http://localhost/phpmyadmin)
# Create database: sunshine_solar_energy

# Step 7: Update .env file with database credentials
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sunshine_solar_energy
# DB_USERNAME=root
# DB_PASSWORD=

# Step 8: Run database migrations
php artisan migrate

# Step 9: (Optional) Seed database with sample data
php artisan db:seed

# Step 10: Start Laravel development server
php artisan serve
