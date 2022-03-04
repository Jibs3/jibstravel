<?php require_once("inc/db.php"); ?>
<?php require_once("inc/functions.php"); ?>
<?php require_once("inc/sessions.php"); ?>

<?php 

if(isset($_SESSION["UserId"])){
  Redirect_to("my_story.php");
}

if (isset($_POST["Submit"])) {
  $Username = $_POST["Username"];
  //$Email = $_POST["Email"];
  $Password = $_POST["Password"];
  
  if (empty($Username)||empty($Password)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("login.php");
  }else {
    // code for checking username and password from Database
  
    $Found_Account=Login_Attempt($Username);
    if ($Found_Account && password_verify($_POST["Password"], $Found_Account["Password"])) {

      $_SESSION["UserId"]=$Found_Account["ID"];
      $_SESSION["Username"]=$Found_Account["Username"];     
      $_SESSION["SuccessMessage"]= "Welcome ". "<b>".$_SESSION["Username"]."</b>"."!";
      if (isset($_SESSION["TrackingURL"])) {
        Redirect_to($_SESSION["TrackingURL"]);
      }else{
      Redirect_to("my_story.php");
    }
    }else {
      $_SESSION["ErrorMessage"]="Incorrect Username OR Password";
      Redirect_to("login.php");
    }
  }
}

 ?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign Up</title>
    
</head>
<body class="LoginBackground"> 
<?php include("inc/header.php") ?>
    <div class="SignUpform">
         <?php
              echo ErrorMessage();
              echo SuccessMessage();                   
          ?>
        <form  action="login.php" method="POST" style="border:1px solid #ccc">
            <div class="container ">
              <h1 class="LoginFormheader">Login</h1>
              <hr>
           
              <label for="text"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="Username" required>
          <br>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="Password" required>
          <br>
              
          
              <div class="clearfix">
                <button name="Submit" style="position: relative; left: 30px;" type="submit" class="signupbtn">Login</button>
              </div>
            </div>
        </form>
    </div>
    
</body>
</html>