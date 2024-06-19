<?php
$host = "localhost";
$dbname = "javascript";
$username = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname",$username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connected successfully";
} catch (PDOException $th) {
    echo "failed to connect".$th->getMessage();
}
?>