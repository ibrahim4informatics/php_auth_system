# **PHP Authentication System**
A simple authentication system with:
- **User Registration**
- **User Login**
- **Public Index Page**
- **Protected Profile Page**

---

## **🚀 Setup Guide**

### **1⃣ Prerequisites**
Ensure that you have PHP and MySQL installed on your system.

#### **Check PHP Installation**
```bash
php --version
```
#### **Check MySQL Installation**
```bash
mysql --version
```

---

### **2⃣ Clone the Repository**
```bash
git clone https://github.com/ibrahim4informatics/php_auth_system.git
cd php_auth_system
```

---

### **3⃣ Configure Database Connection**
Navigate to the `includes/` directory and create a `Config.php` file.

#### **Config.php (Database Configuration)**
Create a file named `Config.php` inside the `includes/` folder and add the following content:

```php
<?php
namespace conf;

class Config {
    // Database configuration
    private static string $db_user = "your_db_username";
    private static string $db_host = "your_db_host"; // Use "localhost" if running locally
    private static string $db_name = "your_db_name";
    private static int $db_port = 3306; // Default MySQL port, change if necessary
    private static string $db_pass = "your_db_password";
    private static int $port = 8000; // The port where the app will run

    /**
     * Get database credentials
     * @return array<string, string|int>
     */
    public static function getDbCred(): array {
        return [
            "username" => self::$db_user,
            "db_host"  => self::$db_host,
            "port"     => self::$db_port,
            "password" => self::$db_pass,
            "db_name"  => self::$db_name
        ];
    }

    /**
     * Get the configured port for the app
     * @return int
     */
    public static function getPort(): int {
        return self::$port;
    }

    /**
     * Get the base URL of the application
     * @return string
     */
    public static function getHost(): string {
        return "http://localhost:" . self::$port;
    }
}
```

---

### **4⃣ Start the PHP Development Server**
From the project root (`php_auth_system/`), start the built-in PHP server:

```bash
php -S localhost:8000
```

---

### **5⃣ Verify the Setup**
- Open your browser and visit:  
  ```bash
  http://localhost:8000
  ```
- Ensure the port in `includes/Config.php` matches the one you use in the command.

---

## **🛠 Troubleshooting**
### **Port Already in Use?**
If port `8000` is occupied, try a different one:
```bash
php -S localhost:8080
```
Then update `Config.php` accordingly.

### **Database Connection Issues?**
- Double-check your database credentials in `Config.php`.
- Ensure MySQL is running:  
  ```bash
  sudo systemctl start mysql  # Linux
  brew services start mysql   # macOS
  net start MySQL             # Windows
  ```

---

## **👨‍💻 Author**
Developed by **[Ibrahim4Informatics](https://github.com/ibrahim4informatics)**.

---

🎯 **Now your authentication system is ready to go!** 🚀

