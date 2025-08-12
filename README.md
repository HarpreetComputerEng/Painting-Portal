## Homepage
<img width="1902" height="1011" alt="Screenshot 2025-08-10 204734" src="https://github.com/user-attachments/assets/74fc9729-d2fe-46c1-aa7a-3c31b8c5eb74" />
## Funtions
<img width="1908" height="994" alt="Screenshot 2025-08-10 205421" src="https://github.com/user-attachments/assets/fa8d3a24-db25-4413-9987-89dfc71b0c1f" />
<img width="1906" height="937" alt="Screenshot 2025-08-10 205237" src="https://github.com/user-attachments/assets/023b059d-3485-451d-9d04-5f535b779c6f" />



# 🎨 Painting Portal

Painting Portal is an online art gallery web application built with **PHP**, **MySQL**, **Bootstrap**, and **JavaScript**.  
It allows users to browse paintings by genre, view details, and explore an interactive art catalog.

---

## 📌 Features
- 🖼 **Browse Paintings by Category** (Computer, Fantasy, Romance, Horror, Science Fiction, etc.)
- 🔍 **AJAX-based Search** for books/paintings
- 📱 **Responsive Design** using Bootstrap
- 🎯 **Dynamic Content** with PHP & MySQL
- 🗂 **Modular Includes** for header, footer, and menus

---

## 📂 Project Structure
project-root/
│
├── admin/ # Admin panel for managing paintings
├── assets/ # CSS, JS, Images
│ ├── css/ # Stylesheets
│ ├── js/ # JavaScript files
│ └── images/ # Image assets
├── includes/ # Header, Footer, Menu files
│ ├── top-header.php
│ ├── main-header.php
│ ├── menu-bar.php
│ ├── side-menu.php
│ └── footer.php
├── index.php # Homepage
├── Books.php # AJAX backend for book/painting details
├── config.php # Database connection settings
└── README.md # Project documentation

yaml
Copy
Edit

---

## ⚙️ Installation
1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/painting-portal.git
   cd painting-portal
Set up the database

Import the .sql file (if provided) into MySQL.

Update includes/config.php with your database credentials.

Run the project locally

Place the folder in your XAMPP/Laragon/WAMP htdocs directory.

Start Apache and MySQL from your local server.

Visit: http://localhost/painting-portal

🖌 Customization
Footer color change → Edit includes/footer.php or your CSS to match body background.

Theme switch → Use assets/css/*.css for color variations.

📜 License
This project is for educational purposes. You can modify and use it as you like.

✨ Author
Developed by [Harpreet Singh] as part of a web development learning project.
