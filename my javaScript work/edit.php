<?php
include_once "pdo.php";
session_start();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emmaneul Hakizimana</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    
    if(isset($_SESSION["user_id"]) ){
      $foreign_id = $_SESSION["user_id"];
      if(isset($_POST["add"])){
            $update = "UPDATE profile SET profile_id=:profile_id, user_id=:user_id, first_name=:fn, last_name=:ln, email=:email, headline=:headline, summary=:summary WHERE profile_id=:profile_id";
            $stmt = $conn->prepare($update);
            $stmt->execute([
                ":profile_id" => htmlentities($_POST["profile_id"]),
                ":user_id" => htmlentities($foreign_id) ,
                ":fn" => htmlentities($_POST["fn"]) ,
                ":ln" => htmlentities($_POST["ln"]) ,
                ":email" => htmlentities($_POST["email"]),
                ":headline" => htmlentities($_POST["head"]) ,
                ":summary" => htmlentities($_POST["summary"]) ,
            ]);
    
            // flash message
            $_SESSION["success"] = "Record Added";
            header( "Location: index.php");
            return;
        }
        if(!isset($_GET["profile_id"])){
          $_SESSION["error"] = "profile id is not found";
          header("Location: index.php");
          return;
        }
        if(isset($_GET["profile_id"])){
          $update = "SELECT * FROM profile WHERE profile_id=:profile_id";
          $stmt = $conn->prepare($update);
          $stmt->execute([":profile_id" => $_GET["profile_id"]]);
          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if($row === false){
            $_SESSION["error"] = "not data found";
            header("Location: index.php");
            return;
            
          } 
          $pr = htmlentities($row["profile_id"]);
          $fn = htmlentities($row["first_name"]);
          $ln = htmlentities($row["last_name"]);
          $head = htmlentities($row["headline"]);
          $summary = htmlentities($row["summary"]);
          $e = htmlentities($row["email"]);
        }  
        
        
        
        
          


    }
    

    ?>
 
    <div class= "container">
        <h1>Adding Profile For UMSI</h1>
        <form action="" method = "post">
          <input type="hidden" class="form-control"  name="profile_id" value="<?= $pr ?>"> 
          <input type="hidden" class="form-control" name="user_id" value = "<?= $_SESSION["user_id"];?>" >
          <label>First Name:</label>
          <input type="text" name="fn" class="form-control" value="<?= $fn ?>">
          <label>Last Name:</label>
          <input type="text" name= "ln" value="<?= $ln ?>" class = "form-control">
          <label>Email:</label>
          <input type="text" name= "email" value="<?= $e ?>" class = "form-control">
          <label>Headline:</label>
          <input type="text" name= "head" value="<?= $head ?>" class = "form-control">
          <label>Summary:</label>
          <textarea type="text" name= "summary"  class = "form-control"> <?= $summary ?> </textarea>
<br>
          <button type="submit" class= "btn btn-primary" name="add">Add</button>
          <button type="submit" class= "btn btn-danger"> <a href="login.php">Cancel</a></button>

        </form>
    </div>
</body>
</html>