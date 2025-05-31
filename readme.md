# Laravel 12 Project Setup Guide

This guide will help you set up and run this Laravel 12 project, including Composer installation, environment configuration, database setup, frontend tooling, and running the application.

---

## 1. Prerequisites

- **PHP >= 8.2**
- **Composer** (dependency manager for PHP)
- **Node.js & npm** (for frontend assets)
- **Database**: MySQL, MariaDB, or PostgreSQL
- **Git** (optional, for version control)

---

## 2. Install Composer

### Windows

- Download and run the Composer installer:  
  https://getcomposer.org/Composer-Setup.exe

### macOS / Linux

```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

---

## 3. Clone the Repository

```sh
git clone https://github.com/ejikosowor/events-sasa-backend
cd events-sasa-backend
```

---

## 4. Install PHP Dependencies

```sh
composer install
```

---

## 5. Install Node.js Dependencies

```sh
npm install
```

---

## 6. Environment Setup

- Copy the example environment file and edit as needed:

```sh
cp .env.example .env
```

- Generate an application key:

```sh
php artisan key:generate
```

- Edit `.env` to set your database credentials and other environment variables.

---

## 7. Database Setup

- Create a database (MySQL, MariaDB, or PostgreSQL).
- Update `.env` with your database connection details.

- Run migrations:

```sh
php artisan migrate
```

- (Optional) Seed the database with test data:

```sh
php artisan db:seed
```

---

## 8. Storage Link

Create a symbolic link for file uploads:

```sh
php artisan storage:link
```

---

## 9. Build Frontend Assets

For development (with hot reload):

```sh
npm run dev
```

For production:

```sh
npm run build
```

---

## 10. Running the Application

Start the Laravel development server:

```sh
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

For more details, see the [Laravel Documentation](https://laravel.com/docs/12.x).