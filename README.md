# 📚 SchoolMart

**SchoolMart** is a web application designed to simplify the process of managing book lists, schools, notifications, and book purchases. It connects users (parents), bookstores, and schools in one unified platform.

---

## 🔑 Features

- **User Authentication & Authorization**  
  Secure login and registration for three roles: `User`, `School`, and `Bookstore`. Passwords are encrypted using `password_hash()`.

- **Book List Upload**  
  Upload `.xls` or `.xlsx` files via the UI (requires Python backend for processing Excel files).

- **School Management**  
  View a list of registered schools dynamically fetched from the database.

- **Order Management**  
  - Users can place orders for books.
  - Orders start as `Pending` and can be accepted or rejected by bookstores.

- **Notifications System**  
  Users receive real-time updates about their order status.

- **MySQL Database Integration**  
  All user, school, book, and order data is stored in a structured MySQL database.

---

## 🛠️ Technologies Used

### Frontend
- HTML5
- CSS3 (with `styles.css` and inline styles)
- JavaScript

### Backend
- PHP (for main server-side logic)
- Python (Flask app for Excel upload processing — optional)

### Database
- MySQL

---

## 🚀 Setup Instructions

### 1. 📦 Database Setup

1. Create a database named `schoolmart`.

```sql
CREATE DATABASE IF NOT EXISTS schoolmart;
USE schoolmart;
