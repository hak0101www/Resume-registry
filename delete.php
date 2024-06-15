<?php
include("pdo.php");
session_start();

if(isset($_POST["delete"])){
    $stmt = $conn->prepare("DELETE FROM profile WHERE profile_id = :zip");
    $stmt->execute([":zip" => $_POST["profile_id"]]);
    $_SESSION["success"] = "Record Deleted";
    header("Location: index.php");
    return;
}

// check if the user_id is present 
if(! $_GET["profile_id"]){
    $_SESSION["error"] = "the user_id not found";
    header("Locatoin: index.php");
    return;
}

    $stmt = $conn->prepare("SELECT first_name, profile_id, last_name FROM profile WHERE profile_id = :profile_id ");
    $stmt->execute([":profile_id" => $_GET["profile_id"]]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row === false){
        $_SESSION['error'] = "invalid user_id ";
        header("Location: index.php");
        return;
    }   

?>
<h1>Delete Profile</h1>
<p>first name : <?= htmlentities($row["first_name"]) ?></p> 
<p>last name : <?= htmlentities($row["last_name"]) ?></p> 

<form method = "post">
<input type="hidden" name="profile_id" value = "<?= $row["profile_id"]?>">
<button class="btn btn-danger" name="delete" value="delete">Delete</button>
<button class="btn btn-tertiary"><a href="index.php">Cancel</a></button>
</form>