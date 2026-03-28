# 🚀 Laravel Authentication Starter Project

A clean and simple **Laravel authentication system built from scratch**, including:

* User Registration
* Login & Logout
* Protected Dashboard
* Forgot Password (Email Reset)
* Gmail SMTP Integration (Real Emails)
* Custom Middleware (Guest Redirect)

---

# 📌 Features

✅ User Registration with validation
✅ Secure Login using hashed passwords
✅ Session-based authentication
✅ Protected routes using middleware
✅ Forgot Password with email reset link
✅ Gmail SMTP configured for real email sending
✅ Custom middleware to prevent logged-in users from accessing login/register pages

---

# 🛠️ Tech Stack

* Laravel (PHP Framework)
* MySQL
* Blade Templating
* SMTP (Gmail)

---

# ⚙️ Installation

## 1. Clone the Repository

```bash
git clone <your-repo-url>
cd your-project
```

## 2. Install Dependencies

```bash
composer install
```

## 3. Setup Environment

```bash
cp .env.example .env
```

Update `.env`:

```env
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=
```

---

## 4. Generate App Key

```bash
php artisan key:generate
```

---

## 5. Run Migrations

```bash
php artisan migrate
```

---

## 6. Start Server

```bash
php artisan serve
```

👉 Visit:

```
http://127.0.0.1:8000
```

---

# 🔐 Authentication Flow

### Register

* User registers with name, email, password
* Password is hashed before storing

### Login

* Credentials verified using Laravel Auth
* Session created on success

### Dashboard

* Protected using `auth` middleware

### Logout

* Session destroyed

---

# 🔄 Forgot Password Flow

1. User enters email
2. Token is generated and stored in DB
3. Reset link sent via email
4. User sets new password
5. Token is deleted after use

---

# 📧 Gmail SMTP Setup

## Enable App Password

1. Enable **2-Step Verification** in your Google account
2. Generate **App Password**

---

## Update `.env`

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="Laravel App"
```

---

## Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

---

# 🧱 Project Structure

```
app/
 └── Http/
      ├── Controllers/
      │    ├── AuthController.php
      │    └── PasswordController.php
      └── Middleware/
           └── RedirectIfAuthenticated.php

resources/
 └── views/
      ├── landing.blade.php
      ├── dashboard.blade.php
      └── auth/
           ├── login.blade.php
           ├── register.blade.php
           ├── forgot-password.blade.php
           └── reset-password.blade.php

routes/
 └── web.php
```

---

# 🛡️ Middleware

### auth

* Protects dashboard routes

### guest.redirect (custom)

* Prevents logged-in users from accessing login/register pages
* Redirects to dashboard

---

# 🧪 Test Email Route

```php
Route::get('/test-email', function () {
    Mail::raw('Test Email', function ($message) {
        $message->to('your_email@gmail.com')
                ->subject('Test Email');
    });

    return "Email sent!";
});
```

---

# ⚠️ Common Issues

### ❌ Mail not sending

* Check Gmail App Password
* Ensure correct SMTP config

### ❌ Token invalid

* Ensure token exists in DB
* Check email matches

### ❌ Redirect issues

* Verify middleware is applied correctly

---

# 🚀 Future Improvements

* Role-based authentication (Admin/User)
* Email verification
* Password confirmation
* Token expiry handling
* API authentication (Sanctum)
* Queue system for emails

---

# 🙌 Conclusion

This project gives you a **strong foundation in Laravel authentication**, covering both:

✔️ Core concepts
✔️ Real-world implementation

Perfect for learning, portfolio, or extending into a production-ready app.

---

# 👨‍💻 Author

Built for learning and mastering Laravel authentication 🚀

---
