<?php
$admin_handler = null;
try {
    $admin_handler = new PDO('mysql:host=localhost;dbname=adminpanel;', 'root', '');
    $admin_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
