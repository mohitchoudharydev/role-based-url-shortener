# Laravel Multi-Tenant URL Shortener

A role-based URL shortening application built with Laravel. The application supports multi-company management, invitation-based user onboarding, and role-based access control using Laravel Policies.

## Features

### Authentication

* User login and registration
* Secure authentication using Laravel Breeze

### Role-Based Access Control

* SuperAdmin
* Admin
* Member

### Company Management

* SuperAdmin can create new companies
* Each company has isolated data

### Invitation System

* SuperAdmin can invite an Admin for a new company
* Admin can invite Admins and Members within their own company

### URL Shortening

* Generate unique short URLs
* Store original URLs
* Company-based URL ownership

### Authorization

Implemented using Laravel Policies.

#### SuperAdmin

* Can view URLs from all companies
* Cannot create URLs

#### Admin

* Can create URLs
* Can view URLs belonging to their company
* Can invite Admins and Members

#### Member

* Can create URLs
* Can view URLs created by themselves

## Tech Stack

* Laravel 12
* PHP 8.2
* MySQL
* Blade
* Laravel Policies
* Bootstrap / Custom CSS

## Installation

Clone the repository:

```bash
git clone https://github.com/mohitchoudharydev/role-based-url-shortener.git
```

Install dependencies:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure database credentials in `.env`.

Run migrations:

```bash
php artisan migrate
```
Run seeders:

```bash
php artisan db:seed
```

Or run migrations and seeders together:

```bash
php artisan migrate --seed

Start development server:

```bash
php artisan serve
```

Visit:

```text
http://localhost:8000
```

## Database Structure

### Users

* id
* company_id
* name
* email
* role
* password

### Companies

* id
* name

### Short URLs

* id
* company_id
* user_id
* original_url
* short_code

## Project Structure

* Policies for authorization
* Controllers for business logic
* Models for data access
* Blade templates for UI

## Future Improvements

* Email-based invitation workflow
* Click analytics
* URL expiration
* QR code generation
* Automated feature tests

## Author

Mohit Choudhary

PHP / Laravel Developer
