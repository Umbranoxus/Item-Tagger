<?php
$public_handler = null;
try {
    $public_handler = new PDO('mysql:host=localhost;dbname=crowd;', 'root', '');
    $public_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
