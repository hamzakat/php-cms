<?php

define('SITE_ROOT', __DIR__);

define("DB_HOST", "127.0.0.1");
define("DB_PORT", "3306");
define("DB_NAME", "cms");
define("DB_USER", "root");
define("DB_PASSWORD", "");

require_once "init/database.php";
init_db();
