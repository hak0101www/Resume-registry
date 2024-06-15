<?php
include("pdo.php");
session_start();
  if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];


    // data validation
    if( strlen($password) < 1){
      $_SESSION['error'] = "Missing Data";
      header("Location: login.php");
      return;
    }
  
    if(strpos($email,"@") === false){
      $_SESSION["error"] = "invalid email";
      header("Location: login.php");
      return;
    }
  
    $sql = "SELECT email, password, user_id FROM users WHERE email = :email ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt ->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user["password"])){
      $_SESSION["email"] = $user["email"];
      $_SESSION["user_id"]= $user["user_id"];
      header("Location: index.php");
      exit;
    }
    else{
      $_SESSION["error"] = "invalid email or password";
      header("Location: login.php");
      exit;
  }
    
    
      



    // $_SESSION["success"] = "Record Added";
    // header( "Location: index.php");
    // return;      
  
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
    <h1>Please Log In</h1>
    <form  method="post" >
        <label >Email:</label>
        <input class="form-control" name="email" id= "email_123">
        <label >Password:</label>
        <input class="form-control" name="password" id="to_123" >
      <br>
        <button type="submit" name="submit"  class="btn btn-info" onclick= "return doValidate();">Log In</button>
        <button type= "submit" name="cancel" class="btn btn-danger"> <a href="inde.php"> Cancel</a></button>
    </form>
  </div> 
  <script>
//     function doValidate() {
//       console.log('Validating...');
//       try {
//           const pw = document.getElementById('to_123').value;
//           console.log("Validating pw=" + pw);
//           if (pw === "") {
//             alert("Both fields must be filled out");
//             return false;
//           }

//           const email = document.getElementById('email_123').value;
//           if (!validateEmail(email)) {
//             alert("Please enter a valid email address");
//             return false;
//           }

//           return true;
//       } catch (e) {
//          return false;
//         }
// }


// Example usage:
// Replace 'email' with your input's ID



  </script>
</body>
</html>
