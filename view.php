<?php
include("pdo.php");
session_start();


if(isset($_GET["profile_id"])){
    $query = "SELECT * FROM profile WHERE profile_id=:profile_id";
    $stmt = $conn->prepare($query);
    $stmt->execute([":profile_id" => $_GET["profile_id"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<h2>Pofile Information</h2>
<br>
<p>First Name : <?= $row["first_name"]; ?> <p>
<p>Last Name : <?= $row["last_name"]; ?> <p>
<p>Headline : <?= $row["headline"]; ?> <p>
<p>Summary: <?= $row["summary"]; ?> <p>
<p>Email : <?= $row["email"]; ?> <p>
    <br>

<a href="index.php">Done</a>   