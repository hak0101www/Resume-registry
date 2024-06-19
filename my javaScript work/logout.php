<?php
include("pdo.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emmanuel Hakizimana</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="container-fluid">
    <h1>Hakizimana Emmanuel's Resume Registry</h1>
    <a href="login.php">Log IN</a>
    <br>
    <?php
    if(isset($_SESSION["error"])){
        echo '<p style="color:red">'.$_SESSION["error"]."</p>\n";
        unset($_SESSION["error"]);
    }
    if(isset($_SESSION["success"])){
        echo '<p style ="color:green">'.$_SESSION["success"]."</p>\n";
        unset($_SESSION["success"]);
    }
    echo ('<table class="table table-bordered table-stripped">'."\n");
    echo ("<th>name</th>");
    echo ("<th>headline</th>");

    $stmt = $conn->query("SELECT first_name, last_name, headline, summary, profile_id FROM profile");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo ('<tr><td>');
        echo ('<a href="view.php?profile_id= '.$row["profile_id"].'">'.htmlentities($row["first_name"])."  ".htmlentities($row["last_name"]).'</a>');
        echo ('</td><td>');
        echo (htmlentities($row["headline"]));
        echo ('</td></tr>'."\n");
    
    }

    ?>
    </table>
    <a href="add.php">Add New Entry</a>
    </div>
    
    </div>
    
</body>
</html>