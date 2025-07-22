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
Import the schoolmart.sql file:

bash
Copy
Edit
mysql -u your_username -p schoolmart < schoolmart.sql
(Optional) If bookstores table is missing, create it:

sql
Copy
Edit
CREATE TABLE bookstores (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Update your db.php connection file:

php
Copy
Edit
$host = 'localhost';
$db   = 'schoolmart';
$user = 'root';
$pass = '';
2. 🖥️ Web Server Setup (PHP)
Place all files (PHP, HTML, CSS) inside your web server root (e.g., htdocs/schoolmart/).

Ensure PHP is installed and configured (Apache or Nginx with PHP-FPM).

3. 🐍 Python Backend for Excel Uploads (Optional)
The fff.html page sends uploads to http://localhost:5000/upload-booklist.

Sample Flask Backend (app.py):
python
Copy
Edit
from flask import Flask, request, jsonify
from flask_cors import CORS
import pandas as pd

app = Flask(__name__)
CORS(app)

@app.route('/upload-booklist', methods=['POST'])
def upload_booklist():
    if 'booklist' not in request.files:
        return jsonify({'error': 'No file part'}), 400
    file = request.files['booklist']
    if file.filename == '':
        return jsonify({'error': 'No selected file'}), 400
    if file and file.filename.endswith(('.xls', '.xlsx')):
        try:
            df = pd.read_excel(file)
            print("Uploaded file preview:\n", df.head())
            return jsonify({'message': 'Book list processed successfully!'}), 200
        except Exception as e:
            return jsonify({'error': str(e)}), 500
    return jsonify({'error': 'Invalid file type'}), 400

if __name__ == '__main__':
    app.run(port=5000, debug=True)
Install Dependencies:
bash
Copy
Edit
pip install Flask pandas openpyxl Flask-Cors
Run Server:
bash
Copy
Edit
python app.py
🌐 Accessing the Application
Login Page: http://localhost/schoolmart/login.html

Registration: http://localhost/schoolmart/register.html

Upload Booklist: http://localhost/schoolmart/fff.html

📖 Usage
Register as a User, Bookstore, or School.

Login to access your role-specific dashboard.

Upload Excel files with book lists via fff.html (Python backend must be running).

Place Orders as a user (books, school, quantity).

Manage Orders as a bookstore (Accept/Reject orders).

Receive Notifications when order status changes.

📁 Project Structure
bash
Copy
Edit
schoolmart/
├── buy_books.php           # Handles book purchases
├── db.php                  # Database connection
├── fff.html                # Upload book lists
├── get_notifications.php   # Fetch notifications
├── load_schools.php        # Load registered schools
├── login.html              # Login UI
├── login.php               # Login logic
├── login.png               # Background image
├── place_order.php         # Place orders with bookstore
├── process_order.php       # Bookstore updates orders
├── register.html           # Registration UI
├── register.php            # Registration logic
├── schoolmart.sql          # MySQL schema
├── styles.css              # CSS styles
└── app.py (optional)       # Flask backend for file uploads
🤝 Contributors
Khushbu Poul (Project Owner)

Additional contributions welcome — feel free to fork and submit pull requests.

📜 License
This project is open-source and available under the MIT License.

yaml
Copy
Edit

---

Let me know if you'd also like a `LICENSE`, `.gitignore`, or want me to auto-generate and bundle t
