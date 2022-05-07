<?php
$dsn = "mysql:host=localhost;dbname=projectweb";
$user = "root";
$pass = '';
$option = array(
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC
);

try {
    $pdo = new PDO($dsn, $user, $pass, $option);
} catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
