# 📚 Library Master - Book Management System

A modern, responsive web application for managing library books, users, and borrowing records. Built with Laravel 11 and Tailwind CSS for a seamless user experience.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.3+-purple.svg)
![Status](https://img.shields.io/badge/status-Active-green.svg)

---

## ⚡ Quick Start (Clone from GitHub)

### Run in 5 Minutes on Any System

#### 1. Clone the Repository
```bash
git clone https://github.com/anjuparanagama/Library-Master.git
cd "Library-Master"
```

#### 2. Install Dependencies
```bash
composer install
```

#### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

#### 4. Create & Migrate Database
```bash
touch database.sqlite
php artisan migrate --force
php artisan migrate:refresh --seed --force
```

#### 5. Start the Server
```bash
php artisan serve
```

**Access Application:** http://localhost:8000

### Login Credentials
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@library.com | admin123 |
| User | user@library.com | user123 |

---

## 🎯 Features

### 🔐 Role-Based Access Control
- ✅ Admin users with full system access
- ✅ Regular users with limited viewing privileges
- ✅ Admin can manage all operations
- ✅ Users can only view their own borrowing history
- ✅ Secure login authentication
- ✅ Last login tracking

### 📖 Book Management
- ✅ Add, edit, and delete books
- ✅ Categorize books by genre
- ✅ Track book stock levels in real-time
- ✅ Filter books by category
- ✅ Display book price in Rs. currency
- ✅ Responsive table and card views

### 👥 User Management
- ✅ Create and manage library users
- ✅ Store user information (name, email, phone, address)
- ✅ Secure password management
- ✅ User profile management

### 📤 Book Borrowing & Returns
- ✅ Issue books to users
- ✅ Track issued books with dates
- ✅ Process book returns
- ✅ Automatic stock management
- ✅ Maintain complete borrowing history

### 📊 Reporting & Logs
- ✅ View complete transaction logs
- ✅ Filter by user or action type
- ✅ Track issued vs. returned books
- ✅ Real-time statistics dashboard

### 🎨 User Interface
- ✅ Fully responsive design (mobile, tablet, desktop)
- ✅ Beautiful Tailwind CSS styling
- ✅ Custom background and logo branding

---

## 🛠️ Technologies Used

### Backend
- **Laravel 11** - PHP web framework
- **PHP 8.3+** - Server-side language
- **SQLite** - Database (can be configured for MySQL)

### Frontend
- **Blade Templating** - Laravel's templating engine
- **Tailwind CSS** - Utility-first CSS framework
- **HTML5** - Semantic markup

### Tools & Libraries
- **Composer** - PHP dependency manager
- **Artisan CLI** - Laravel command-line tool

---

## 📋 System Requirements

- PHP >= 8.3
- Composer
- Node.js & NPM (optional, for frontend building)
- SQLite or MySQL database
- Web browser with JavaScript enabled

---

## 🚀 Installation & Setup

### 1. Clone the Repository
```bash
git clone https://github.com/anjuparanagama/Library-Master.git
cd "Book Management System"
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file and set database connection:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database.sqlite
```


### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Start the Development Server
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## 📁 Project Structure

```
Book Management System/
├── app/
│   ├── Models/              # Database models
│   │   ├── User.php
│   │   ├── Book.php
│   │   ├── Category.php
│   │   └── Borrow.php
│   └── Http/Controllers/    # Request handlers
│       ├── BookController.php
│       ├── CategoryController.php
│       ├── UserController.php
│       └── BorrowController.php
├── resources/
│   └── views/               # Blade templates
│       ├── layouts/
│       │   └── app.blade.php       # Main layout
│       ├── books/                  # Book management views
│       ├── categories/             # Category management views
│       ├── users/                  # User management views
│       ├── borrow/                 # Borrowing & returns views
│       └── components/             # Reusable components
├── routes/
│   └── web.php              # Application routes
├── database/
│   ├── migrations/          # Database schema
│   ├── factories/           # Model factories for testing
│   └── seeders/             # Database seeders
├── public/
│   ├── logo.png             # Application logo
│   ├── background.jpg       # Background image
│   └── index.php            # Entry point
├── config/                  # Configuration files
├── storage/                 # Logs and cache
└── tests/                   # Test files
```

---

## 🔧 Key Controllers & Functions

### BookController
```php
- index()       // List all books with filtering
- create()      // Show create form
- store()       // Save new book
- edit()        // Show edit form
- update()      // Update book details
- destroy()     // Delete book
```

### CategoryController
```php
- index()       // List all categories
- create()      // Show create form
- store()       // Save new category
- edit()        // Show edit form
- update()      // Update category
- destroy()     // Delete category
```

### UserController
```php
- index()       // List all users
- create()      // Show user creation form
- store()       // Create new user
- edit()        // Show edit form
- update()      // Update user details
- destroy()     // Delete user
```

### BorrowController
```php
- showIssueForm()   // Display book issue form
- storeIssue()      // Process book issue
- showReturnForm()  // Display book return form
- storeReturn()     // Process book return
- showLogs()        // Display transaction logs
```

---

## 📊 Database Schema

### Users Table
```sql
- id (Primary Key)
- name (String)
- email (String, Unique)
- password (String, Hashed)
- phone (String, Optional)
- address (Text, Optional)
- timestamps
```

### Books Table
```sql
- id (Primary Key)
- title (String)
- author (String)
- price (Decimal)
- stock (Integer)
- category_id (Foreign Key)
- timestamps
```

### Categories Table
```sql
- id (Primary Key)
- name (String, Unique)
- timestamps
```

### Borrows Table
```sql
- id (Primary Key)
- user_id (Foreign Key)
- book_id (Foreign Key)
- issue_date (DateTime)
- return_date (DateTime, Nullable)
- timestamps
```

## 📱 Step-by-Step Usage Guide

### For Administrators

#### Step 1: Login
1. Navigate to: http://localhost:8000
2. Enter Email: `admin@library.com`
3. Enter Password: `admin123`
4. Click "Sign In"
5. You'll see the admin dashboard with statistics

#### Step 2: View Dashboard Stats
On the dashboard you can see:
- **Total Users** - Number of library members
- **Total Books** - Books in the library
- **Categories** - Number of book categories
- **Active Issues** - Books currently borrowed
- **Recent Activities** - Latest transactions

#### Step 3: Manage Books
1. Click **"Books"** in the navigation menu
2. View all books in a table format
3. Filter by category using the dropdown
4. To add a book:
   - Click **"Add New Book"** button
   - Fill in: Title, Author, Price (in Rs.), Stock, Category
   - Click **"Save"**
5. To edit: Click the **Edit** button on any book
6. To delete: Click the **Delete** button

#### Step 4: Manage Categories
1. Click **"Categories"** in menu
2. View existing categories
3. Click **"Add New Category"**
4. Enter category name (e.g., Fiction, Science, History)
5. Click **"Save"**
6. Categories are now available for book assignment

#### Step 5: Manage Users
1. Click **"Users"** in menu
2. View all registered users
3. Click **"Create User"** to add new:
   - Name: Full name
   - Email: Unique email address
   - Password: Secure password (min 8 chars)
   - Phone: Optional
   - Address: Optional
4. Click **"Save"**

#### Step 6: Issue Books
1. Click **"Issue"** in menu
2. Select a user from the dropdown
3. Select an available book
4. Click **"Issue Book"**
5. Book stock automatically decreases
6. Transaction is logged automatically

#### Step 7: Return Books
1. Click **"Return"** in menu
2. Select the user
3. Click **"Load Books"** to see their issued books
4. Select the book to return
5. Click **"Return Book"**
6. Book stock automatically increases
7. Return date is recorded

#### Step 8: View Transaction Logs
1. Click **"Logs"** in menu
2. See all borrowing transactions
3. View user names, books, dates, and status
4. Filter and track all activities

### For Regular Users

#### Step 1: Login
1. Navigate to: http://localhost:8000
2. Enter your email and password
3. Click "Sign In"
4. View your personal dashboard

#### Step 2: Check Issued Books
1. On dashboard, see **"Currently Issued Books"**
2. View:
   - Book title and author
   - Book category
   - Issue date
3. This shows books you currently have

#### Step 3: View Borrowing History
1. Scroll down to **"Returned Books History"**
2. See all books you previously borrowed
3. View:
   - Issue and return dates
   - How many days you had each book
4. Track your borrowing patterns

#### Step 4: Request Books
- To borrow new books, contact the library administrator
- Admin will issue books from the system

---

## 🔄 Workflow Examples

### Complete Book Borrowing Workflow (Admin)
1. **Check Available Books**
   - Go to Books page
   - See stock levels
   
2. **Select User**
   - Go to Issue page
   - Choose user from dropdown
   
3. **Issue the Book**
   - Select desired book
   - Click "Issue Book"
   
4. **Confirm Changes**
   - Stock decreases automatically
   - Transaction logged
   - User can see book in their dashboard

### Complete Book Return Workflow (Admin)
1. **Go to Return Page**
   - Click "Return" in menu
   
2. **Load User's Books**
   - Select user
   - Click "Load Books"
   
3. **Process Return**
   - Select book from dropdown
   - Click "Return Book"
   
4. **Confirm Changes**
   - Stock increases automatically
   - Return date recorded
   - Book moved to user's history

### Managing New Category
1. Go to **Categories** page
2. Click **"Add New Category"** button
3. Enter name (e.g., "Mystery Novels")
4. Click **"Save"**
5. Category now available for books

---

### Issuing a Book
1. Navigate to **Issue Book** page
2. Select a user from dropdown
3. Select an available book
4. Click **Issue Book**
5. Book stock automatically decreases by 1
6. Record created in borrow logs

### Returning a Book
1. Navigate to **Return Book** page
2. Select user and click **Load Books**
3. Choose book to return from dropdown
4. Click **Return Book**
5. Book stock automatically increases by 1
6. Return date recorded in logs

### Managing Categories
1. Go to **Categories** page
2. Click **+ Add New Category** button
3. Enter category name (e.g., Fiction, Science, History)
4. Save category
5. Category now available for book assignment

---

## 🎨 Customization

### Change Logo
1. Replace `public/logo.png` with your logo
2. Ensure PNG format for best quality

### Change Background
1. Replace `public/background.jpg` with your image
2. Supports JPG format

### Theme Color
Edit `resources/views/layouts/app.blade.php` and update:
```php
// Change indigo-600 to your preferred Tailwind color
// Examples: blue-600, purple-600, green-600, red-600
```

---

## 📱 Responsive Design

The application is fully responsive:
- **Mobile** (< 640px): Card-based layout
- **Tablet** (640px - 1024px): Optimized layout
- **Desktop** (> 1024px): Table-based layout with full features

---

## 🔐 Security Features

- ✅ Password hashing with bcrypt
- ✅ CSRF protection on forms
- ✅ SQL injection prevention (Laravel Eloquent ORM)
- ✅ Input validation on all forms
- ✅ Secure authentication

---

## 🐛 Troubleshooting

### Port 8000 Already in Use
```bash
php artisan serve --port=8001
```

### Database Migration Error
```bash
php artisan migrate:refresh --force
```

### Clear Application Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Permission Denied Errors
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 📞 Support

For issues or questions:
1. Check existing issues on GitHub
2. Create a new issue with detailed description
3. Include steps to reproduce the problem

---

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 👨‍💻 Author

**Anju Paranagama**
- GitHub: [@anjuparanagama](https://github.com/anjuparanagama)
- Repository: [Library-Master](https://github.com/anjuparanagama/Library-Master)

---

## 🙏 Acknowledgments

- Laravel Framework - https://laravel.com
- Tailwind CSS - https://tailwindcss.com
- Alpine.js - https://alpinejs.dev

---

## 📅 Changelog

### Version 1.0.0 - Initial Release
- Complete book management system
- User management functionality
- Book borrowing and returns system
- Full responsive design
- Transaction logging and reporting

---
