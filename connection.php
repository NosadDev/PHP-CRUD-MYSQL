<?php
$con = new mysqli('localhost', 'php', 'php', 'php_crud');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
