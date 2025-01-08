<?php
$connection = new mysqli("localhost", "root", "", "kosan");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
