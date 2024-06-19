<?php
include("pdo.php");
session_start();
  if(isset($_POST["submit"])){


    // data validation
    if(strlen($_POST["name"]) < 1 || strlen($_POST["password"]) < 1){
      $_SESSION['error'] = "Missing Data";
      header("Location: signup.php");
      return;
    }
  
    if(strpos($_POST["email"],"@") === false){
      $_SESSION["error"] = "invalid email";
      header("Location: signup.php");
      return;
    }
    $password_hashed = password_hash($_POST["password"],PASSWORD_DEFAULT);
  
    $sql = "INSERT INTO users (name, email, password)
             VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt ->execute([
      ":name" => $_POST["name"],
      ":email" => $_POST["email"],
      ":password" => $password_hashed,
    ] ); 
    if(isset($stmt)){
      $_SESSION["success"] = "Record Added";
    header( "Location: index.php");
    return; 

    }
    else{
      $_SESSION["error"] = "no record found";
      header("Location: index.php");
      return;
    }
         
  
  }


// flash pattern
if(isset($_SESSION["error"])){
  echo '<p style="color:red">'.$_SESSION["error"]."</p>\n";
  unset($_SESSION["error"]);

}


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
  <div class = "container" style = "width:500px">
    <h1>Please Sign Up</h1>
    <form  method="post" >
      <label>Name:</label>
      <input type="text" name="name" class="form-control">
        <label >Email:</label>
        <input class="form-control" name="email">
        <label >Password:</label>
        <input class="form-control" name="password" >
      <br>
        <button type="submit" name="submit"  class="btn btn-info">Sign Up</button>
        <button type= "submit" name="cancel" class="btn btn-danger"> <a href="index.php"> Cancel</a></button>
    </form>
  </div>  
</body>
</html>