<?php
$configFile = file_get_contents('Config/security.json');
$config = json_decode($configFile, true);

try {
    $strConnection = "mysql:host=" . $config['DB_HOST'] . ";dbname=" . $config['DB_NAME'] . ";port=" . $config['DB_PORT'];
    $pdo = new PDO($strConnection, $config['DB_USER'], $config['DB_PASSWORD'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    $msg = 'ERREUR PDO dans ' . $e->getMessage();
    die($msg);
}
