<?php 

function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}

function ImageNameChange($length){
  $token = "StoryImage";
  $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++)
  {
      $token .= $codeAlphabet [random_int(0, $max-1)];
    }

    return $token;

}



function CheckUserNameExistsOrNot($Username){
  global $ConnectingDB;
  $sql    = "SELECT Username FROM users WHERE Username=:userName";
  $stmt   = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$Username);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}


function CheckEmailExistsOrNot($Email){
  global $ConnectingDB;
  $sql    = "SELECT Email FROM users WHERE Email=:eMail";
  $stmt   = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':eMail',$Email);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}


function Login_Attempt($Username){
  global $ConnectingDB;
  $sql = "SELECT * FROM users WHERE Email=:userName OR Username =:userName LIMIT 1";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$Username);
  // $stmt->bindValue(':PassworD',$hash);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}

function Confirm_Login(){
if (isset($_SESSION["UserId"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("login.php");
}
}
