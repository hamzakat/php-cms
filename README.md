# PHP Articles

This is submission for https://github.com/humansis/php-assignment

## Technologies

- PHP 7 (Pure PHP, without external libraries)
- MySQL (connection managed using PDO)
- Tailwind CSS for page styling

## Requirements

- PHP 7+
- MySQL 5

## Usage

Default database conigurations are stored in `configs.php`:

```php
define("DB_HOST", "127.0.0.1");
define("DB_PORT", "3306");
define("DB_NAME", "cms");
define("DB_USER", "user");
define("DB_PASSWORD", "password");
```

1. You must create user and database based on the configurations in `configs.php`.

   1. Login to MySQL shell as root:
   2. Create user:

   ```sql
    CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';
   ```

   3. Create database;

   ```sql
   CREATE DATABASE cms;
   ```

   4. Grant all Priviliges on `cms` database to the user we created (`user`);

   ```sql
   GRANT ALL PRIVILEGES ON cms.* TO 'user'@'localhost';
   ```

   5. Logout

   ```sql
   quit;
   ```

2. `index.php` is the entry point of this service.
3. Tables will be initialized on first run (if not created).
