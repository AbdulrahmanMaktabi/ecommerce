# Multi-Vendor eCommerce Platform

This is a multi-vendor eCommerce platform built with Laravel. It allows multiple vendors to register, manage their products, and sell them online, while customers can browse, purchase products, and manage orders.

## Features

-   **Multi-Vendor Support**: Allow multiple vendors to register and manage their products.
-   **Product Management**: Vendors can add, edit, and delete their products.
-   **User Authentication**: Customers can register, login, and manage their profiles.
-   **Order Management**: Customers can place orders and track their status.
-   **Payment Integration**: Stripe, PayPal, or other payment methods can be integrated for handling transactions.
-   **Admin Panel**: Admin can manage all users, vendors, and products.
-   **Responsive Design**: The platform is designed to be mobile-friendly.

## Installation

### Prerequisites

Make sure you have the following installed on your local machine:

-   PHP >= 8.1
-   Composer
-   MySQL or another supported database
-   Node.js and NPM (for frontend assets)

### Steps to Install

1. **Clone the repository**:
    ```bash
    git clone https://github.com/yourusername/ecommerce-platform.git
    cd ecommerce-platform
    ```

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
