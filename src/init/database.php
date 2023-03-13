<?php

/**
 * 1. Create database if not exist
 * 2. Create tables if not exist
 */

function init_db(): void
{
    try {
        $db_conn = new PDO(
            "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8;",
            DB_USER,
            DB_PASSWORD
        );
        // set the PDO error mode to exception
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create db
        $init_db_query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        $db_conn->exec($init_db_query);
        // echo "Database created successfully";

        // create tables
        $db_conn->query("USE " . DB_NAME);
        $init_tables_query = file_get_contents(__DIR__ . '/tables.sql');
        if ($init_tables_query === FALSE) {
            die("Cannot find tables.sql file inside \"init\" directory. Tables initialization query must be loaded through this file to run this app.");
        }
        $db_conn->exec($init_tables_query);
    } catch (PDOException $e) {
        echo "Check database configurations in configs.php \n";
        die($e->getMessage());
    }

    // close this connection
    $db_conn = null;
}
