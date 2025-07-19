# Civil Status Registry (Web Version)

&#x20;&#x20;

## 📌 Overview

The **Civil Status Registry (Web version)** is a secure, modular web-based system designed to manage and maintain civil status records like birth and marriage certificates. It makes vital records management more efficient, transparent, and citizen-centric by providing secure online access and automating key processes.

## ✨ Features

- User registration and secure login
- Apply for birth and marriage certificates online
- Generate and download certificates as PDF
- Data validation and sanitization to ensure data integrity
- Modular architecture for scalability and maintainability
- Protection against session hijacking
- User-friendly interface with responsive design

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript 
- **Backend**: PHP with libraries like PhpSpreadsheet, PHPMailer
- **Database**: MySQL
- **PDF Generation**: LibreOffice command line integration
- **Security**: Prepared statements, data sanitization, secure cookies, session management

## 📂 Project Structure

```
project-root/
├── index.html                # Home page
├── signup.html               # User registration page
├── login.html                # Login page
├── dashboard.html            # User dashboard
├── Birth.php                 # Handles birth certificate data
├── Marriage.php              # Handles marriage certificate data
├── assets/                   # CSS, JS, images
├── database/                 # Database scripts or config
├── LICENSE                   # License file
├── .gitignore                # Git ignore file
└── README.md                 # Project documentation
```

## ⚙️ Installation & Setup

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Drax_/civil-status-registry.git
   cd civil-status-registry
   ```

2. **Configure database:**

   - Import the database schema into your MySQL server.
   - Update database connection credentials in PHP files.

3. **Install PHP dependencies:**

   ```bash
   composer install
   ```

4. **Set up LibreOffice (for PDF generation):** Ensure `libreoffice` is installed and accessible via cmd.

5. **Run the project:** Deploy on XAMPP, WAMP, or any PHP server, and open `index.html` in your browser.

## 🔒 Security

- Session hijacking protection with user agent and IP checks.
- Secure cookies with `HttpOnly`, `Secure`, and `SameSite` attributes.
- Data sanitization to prevent XSS.
- Prepared SQL statements to prevent SQL injection.

## ✅ Functional Requirements

- Users can register and securely log in.
- Create, view, and print civil status records.
- Generate certificates in PDF format.

## ⚡ Non-Functional Requirements

- User-friendly, responsive interface.
- Scalability to handle large data volumes.
- Automatic backups and secure authentication.

## 📈 Future Improvements

- Email verification and password recovery.
- Bulk CSV uploads for records.
- Allow users to choose specific records to print.
- Validate if an email exists before sending an identifier.

## 📃 License

This project is licensed under the MIT License. See the `LICENSE` file for details.

## 📚 References

- Buea Council Civil Status: [Website](https://bueacouncil.com/?page_id=6825)
- UNICEF CRVS Data: [Link](https://data.unicef.org/crvs/cameroon/)
- Limbe Council: [Birth certificates](http://www.limbe.cm/birth-certificates.html)

## 🙌 Author

>  [Drax_@example.com](mailto\:Drax_@gmail.com) • [GitHub](https://github.com/Drax_)

---

## 📦 Extra Files

### LICENSE (MIT License)

```


Copyright (c) 2025 Drax_

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
In the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS ARE LIABLE FOR ANY CLAIM, DAMAGES, OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT, OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OF OTHER DEALINGS IN THE
SOFTWARE.
```

### .gitignore

```
/vendor/
/node_modules/
.env
*.log
*.tmp
.DS_Store
*.bak
*.swp
.idea/
.vscode/
```
