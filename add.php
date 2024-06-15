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
            if(strlen($_POST["fn"]) < 1 || strlen($_POST["ln"]) < 1 || strlen($_POST["email"]) < 1 || strlen($_POST["head"]) < 1 || strlen($_POST["summary"]) < 1){
                
                $_SESSION["error"] = "All Fields are requeired";
                header("Location: add.php");
                return;
            }
            if(strpos($_POST["email"],"@")===false){
                $_SESSION["error"] = "invalid email";
                header("Location: add.php");
                return;

            }
            
            
            else{
                $insert = "INSERT INTO profile (user_id, first_name, last_name, email, headline, summary)
                VALUES (:user_id, :fn, :ln, :email, :head, :summary)";
                $stmt = $conn->prepare($insert);
                $stmt = $stmt->execute([
                    ":user_id" => htmlentities($foreign_id) ,
                    ":fn" => htmlentities($_POST["fn"]) ,
                    ":ln" => htmlentities($_POST["ln"]) ,
                    ":email" => htmlentities($_POST["email"]),
                    ":head" => htmlentities($_POST["head"]) ,
                    ":summary" => htmlentities($_POST["summary"]) ,
                ]);
        
                // flash message
                $_SESSION["success"] = "Record Added";
                header( "Location: index.php");
                return;

            }
            
            
            
        }
    }
    // flash pattern
if(isset($_SESSION["error"])){
    echo '<p style="color:red">'.$_SESSION["error"]."</p>\n";
    unset($_SESSION["error"]);
  
  }
    

    ?>
 
    <div class= "container">
        <h1>Adding Profile For UMSI</h1>
        <form action="" method = "post">
            <input type="hidden" name="name" value = "<?= $_SESSION["user_id"];?>" class="form-control">
            <label>First Name:</label>
            <input type="text" name="fn" class="form-control" value="">
            <label>Last Name:</label>
            <input type="text" name= "ln" value="" class = "form-control">
            <label>Email:</label>
            <input type="text" name= "email" value="" class = "form-control">
            <label>Headline:</label>
            <input type="text" name= "head" value="" class = "form-control">
            <label>Summary:</label>
            <textarea type="text" name= "summary" value="" class = "form-control"></textarea>
<br>



            <button type="submit" class= "btn btn-primary" name="add">Add</button>
            <button type="submit" class= "btn btn-danger"> <a href="index.php">Cancel</a></button>

        </form>
    </div>
</body>
</html>