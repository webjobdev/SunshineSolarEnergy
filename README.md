# ☀️ Sunshine Solar Energy

[![Laravel Version](https://img.shields.io/badge/Laravel-12.63.0-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2.12-blue.svg)](https://php.net)
[![Composer Version](https://img.shields.io/badge/Composer-2.9.5-green.svg)](https://getcomposer.org)

## 📋 Project Overview

Sunshine Solar Energy is a modern web application built with Laravel Framework 12.63.0. This project aims to provide solar energy management solutions.

### 🏗️ System Requirements

- **PHP**: ^8.2
- **Composer**: Latest version
- **Database**: MySQL/PostgreSQL/SQLite
- **Node.js**: Latest LTS version (for frontend assets)

### 🚀 Quick Setup

#### Prerequisites

1. Install XAMPP 8.2.12 or similar PHP environment
2. Install Composer globally
3. Install Node.js and NPM

#### Installation Steps

```bash
# 1. Clone the repository
git clone [repository-url]
cd sunshine-solar-energy

# 2. Install PHP dependencies
composer install

# 3. Environment configuration
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Configure database in .env file
# Update DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 6. Run database migrations
php artisan migrate

# 7. Install and build frontend assets
npm install
npm run build

# 8. Start the development server
php artisan serve
