# Product Stock Manager

A web-based Product Stock Manager built with Laravel and MySQL to manage products, categories, pricing, and stock movements. The application provides stock tracking, low-stock alerts, search and filtering, and a history of stock additions and removals.

## Features

- **Product Management** — Create, view, update, and delete products.
- **Category Management** — Organize products by category.
- **Stock In** — Add inventory with quantity and an optional note.
- **Stock Out** — Remove inventory while preventing stock from becoming negative.
- **Stock History** — Track stock additions and removals with dates, quantities, types, and notes.
- **Low-Stock Alerts** — Highlight products with fewer than 5 units in stock.
- **Search and Filtering** — Search products by name and filter by category.
- **Pagination** — Display products across multiple pages.
- **Authentication** — Protect application routes using Laravel authentication middleware.
- **Success and Validation Messages** — Display feedback after operations and when validation fails.
- **Responsive Interface** — Build a user interface using Tailwind CSS and Blade templates.

## Technology Stack

| Technology | Purpose |
|---|---|
| PHP | Backend programming |
| Laravel 13 | Backend framework |
| MySQL | Database |
| Laravel Blade | Server-rendered views |
| Tailwind CSS | UI styling |
| Alpine.js | Interactive stock modals |
| Laravel Breeze | Authentication scaffolding |
| Git and GitHub | Version control |

## Installation and Setup

### 1. Clone the repository

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
cd YOUR_PROJECT_FOLDER
```

Replace the repository URL and folder name with your actual values.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure environment variables

Copy the example environment file.

```bash
copy .env.example .env
```

On macOS or Linux, use:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Create the database

Create a MySQL database using phpMyAdmin or your preferred MySQL client.

For example:

```sql
CREATE DATABASE inventory-panel;
```

Update the database settings in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory-panel
DB_USERNAME=root
DB_PASSWORD=
```

Use the credentials configured on your own machine.

### 5. Run database migrations

```bash
php artisan migrate
```

This creates the database tables defined by the project's migrations.

### 6. Install frontend dependencies

If the project includes `package.json`, install the dependencies:

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```

For local development, you can use:

```bash
npm run dev
```

### 7. Start the Laravel application

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

If authentication is provided through Laravel Breeze, register an account or sign in to access protected routes.

## Stock Management Logic

### Stock In

- Accepts a positive integer quantity.
- Increases the product's current stock.
- Records the movement in the stock history table.
- Supports an optional note.

### Stock Out

- Accepts a positive integer quantity.
- Checks that sufficient stock is available.
- Prevents stock from becoming negative.
- Records the movement only when the operation succeeds.

### Stock History

Each successful stock movement stores information such as:

- Product ID
- Movement type (`in` or `out`)
- Quantity
- Optional note
- Creation timestamp

Stock history is displayed in newest-first order on the Product Details page.

```text
## Project Structure

product-stock-manager/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ProductController.php
│   │       ├── CategoryController.php
│   │       └── StockController.php
│   └── Models/
│       ├── Product.php
│       ├── Category.php
│       └── StockHistory.php
│       └── StockMovement.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── auth/
│       ├── categories/
│       ├── components/
│       ├── products/
├── routes/
│   └── web.php
├── .env.example
├── composer.json
├── package.json
└── README.md
```
*The structure above is representative. Adjust it if your actual project uses different filenames or folders.

## Demo Login Credentials

Use the following demo account to access the Product Stock Manager.

| Field | Value |
|---|---|
| Email | `admin@example.com` |
| Password | `Admin@12345` |

## Application Routes
| Method    | Route                           | Purpose                                |
| --------- | ------------------------------- | -------------------------------------- |
| GET       | `/products`                     | List products                          |
| GET       | `/products/create`              | Show product creation form             |
| POST      | `/products`                     | Create a product                       |
| GET       | `/products/{product}`           | View product details and stock history |
| GET       | `/products/{product}/edit`      | Show product edit form                 |
| PUT/PATCH | `/products/{product}`           | Update a product                       |
| DELETE    | `/products/{product}`           | Delete a product                       |
| GET       | `/categories`                   | List categories                        |
| GET       | `/categories/create`            | Show category creation form            |
| POST      | `/categories`                   | Create a category                      |
| GET       | `/categories/{category}`        | View category details                  |
| GET       | `/categories/{category}/edit`   | Show category edit form                |
| PUT/PATCH | `/categories/{category}`        | Update a category                      |
| DELETE    | `/categories/{category}`        | Delete a category                      |

These routes match Laravel's `Route::resource()` conventions for products and categories, plus your custom stock movement routes. The category details route exists only if you retain the resource's `show` action in your routes and controller.

These routes are protected by authentication middleware in the application.

## Validation and Data Integrity

- Product names and category selections are validated.
- Price and stock values are validated before saving.
- Stock movement quantities must be positive integers.
- Stock Out checks available stock on the server.
- Database transactions help keep stock updates and stock history records consistent.

## Future Improvements

- Role-based access control for administrators and staff.
- Dashboard with inventory statistics and charts.
- Product SKU and barcode support.
- Supplier and purchase management.
- Sales and invoice management.
- Export reports to CSV, Excel, or PDF.
- Automated low-stock notifications.
- Automated tests for product and stock operations.

## Author

**Omkar Deshmukh**

PHP / Laravel Developer

GitHub: Add your GitHub profile URL here.
