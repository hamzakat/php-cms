# PHP Guestbook
My personal guestbook (post wall for visitors!)

## Tech Stack

- PHP 7 (Pure PHP, without external libraries)
- MySQL (connection managed using PDO)
- TailwindCSS for page styling

## Demonstrated Design Patterns

- Strategy: I ensured to apply DRY principles by creating hierarchical classes.
- Singleton: Controller classes are singleton classes.
- Data Mapper: I designed a DAO (Data Access Object) for every data model, which is an abstract layer between the database and application.
- Factory: PHP does not support constructor overloading, so I used this pattern in model classes design.

## Requirements

- PHP 7+
- MySQL 5

## Setup

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
