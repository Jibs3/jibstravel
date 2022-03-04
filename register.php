<?php require_once("inc/db.php"); ?>
<?php require_once("inc/functions.php"); ?>
<?php require_once("inc/sessions.php"); ?>

<?php

if(isset($_POST["Submit"])){
  $Username           = $_POST["Username"];
  $Email              = $_POST["Email"];
  $Password           = $_POST["Password"];
  $Confirm_Password   = $_POST["Confirm_Password"];
  $hash               = password_hash($Password, PASSWORD_BCRYPT); 
  date_default_timezone_set("Africa/Lagos");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %I:%M:%p",$CurrentTime);

  if(empty($Username)||empty($Password)||empty($Email)||empty($Confirm_Password)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("register.php");
  }elseif (strlen($Password)<4) {
    $_SESSION["ErrorMessage"]= "Password should be greater than 3 characters";
    Redirect_to("register.php");
  }elseif ($Password !== $Confirm_Password) {
    $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
    Redirect_to("register.php");
  }elseif (CheckEmailExistsOrNot($Email)) {
    $_SESSION["ErrorMessage"]= "Email Exists. Try Another One! ";
    Redirect_to("register.php");
  }elseif (CheckUserNameExistsOrNot($Username)) {
    $_SESSION["ErrorMessage"]= "Username Exists. Try Another One! ";
    Redirect_to("register.php");
  }else{
    // Query to insert new admin in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO users(datetime, Email, Username, Password)";
    $sql .= "VALUES(:dateTime, :eMail, :userName, :passworD)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':eMail',$Email);
    $stmt->bindValue(':userName',$Username);
    $stmt->bindValue(':passworD',$hash);   
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="Registeration Successfully";

      $Found_Account=Login_Attempt($Username);
      if ($Found_Account && password_verify($_POST["Password"], $Found_Account["Password"])) {
  
          $_SESSION["UserId"]=$Found_Account["ID"];
          $_SESSION["Username"]=$Found_Account["Username"];     
          $_SESSION["SuccessMessage"]= "Welcome " .$_SESSION["Username"]."!";
          if (isset($_SESSION["TrackingURL"])) {
            Redirect_to($_SESSION["TrackingURL"]);            
          }else{
            Redirect_to("my_story.php");
          }
      }     
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("register.php");
    }
  }
} //Ending of Submit Button If-Condition


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Sign Up</title>
    
</head>
<body class="ReisterBackground">
    <?php include("inc/header.php") ?>
    <div class="SignUpform">
              <?php
                    echo ErrorMessage();
                    echo SuccessMessage();                   
                ?>
        <form  action="register.php" method="POST" style="border:1px solid #ccc">
            <div class="container ">
              <h1 class="SignUpFormheader">Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>
              <label for="text"><b>Email </b></label>
              <input type="text" placeholder="Enter Email" name="Email" required>
              <br>
          
              <label for="text"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="Username" required>
          <br>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="Password" required>
          <br>
              <label style="position: relative; left: -30px" for="psw-repeat"><b>Repeat Password</b></label>
              <input style="position: relative; left: -30px" type="password" placeholder="Repeat Password" name="Confirm_Password" required>
          
              <div class="clearfix">
                <button name="Submit" style="position: relative; left: 30px;" type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
        </form>
    </div>
    
</body>
</html>
