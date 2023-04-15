<?php
session_start();
include "constans.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";

try {
    $pdo = new PDO("mysql:host=$database_config->host;dbname=$database_config->db",$database_config->user,$database_config->pass);
    // echo "successfully connected to mysql";
} catch (PDOException $e) {
    diePage("PDO error: failed to coonect to mysql " . $e->getMessage() . " in line " . $e->getLine());
}


include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";
