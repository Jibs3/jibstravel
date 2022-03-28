<?php require_once("inc/db.php"); ?>
<?php require_once("inc/functions.php"); ?>
<?php require_once("inc/sessions.php"); ?>

<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); 

?>

<?php

if(isset($_POST["Submit"])){
    $user_id            = $_SESSION["UserId"];
    $username            = $_SESSION["Username"];
    $story_title              = $_POST["story_title"];
    $travel_experience           = $_POST["travel_experience"];      
    $RandImGen                = ImageNameChange(20);
    $image                     = "uploads/story_images/". $RandImGen .'.jpg';
    $Temp_Image                 = $_FILES["image"]["tmp_name"];
    $Target_Image       = "uploads/story_images/".basename($image);
    date_default_timezone_set("Africa/Lagos");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %I:%M:%p",$CurrentTime);

  if(empty($story_title)||empty($travel_experience)||empty($Temp_Image)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("create_story.php");
  }else{
    // Query to insert new admin in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO stories(datetime, user_id, story_title, image, travel_experience, username)";
    $sql .= "VALUES(:dateTime, :userId, :storyTitle, :imaGe, :travel_experiencE, :userName )";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime', $DateTime);
    $stmt->bindValue(':userId', $user_id);
    $stmt->bindValue(':storyTitle', $story_title);
    $stmt->bindValue(':imaGe', $image);   
    $stmt->bindValue(':travel_experiencE', $travel_experience); 
    $stmt->bindValue(':userName', $username);   
    $Execute=$stmt->execute();
    move_uploaded_file($Temp_Image, $Target_Image);
    if($Execute){
      $_SESSION["SuccessMessage"]="Story Created";
      Redirect_to("create_story.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("create_story.php");
    }
  }
} //Ending of Submit Button If-Condition


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>My Stories</title>
  </head>
  <body class="ReisterBackground">
  <?php include("inc/header.php") ?>
   
    <div class="col-8 offset-md-2">
      <div class="mt-4">
        <h1>Create Story</h1>
        <div class="mt-3">
          <a class="btn btn-warning" href="my_story.php">My Stories</a>
        </div>
      </div>
                 <?php
                    echo ErrorMessage();
                    echo SuccessMessage();                   
                ?>
        <form method="post" action="create_story.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Story Title</label>
                <input name="story_title" type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input name="image" class="form-control" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea name="travel_experience" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>           
            <div class="mb-3">
                <button name="Submit" type="submit" class="btn btn-primary mb-3">Create Story</button>
            </div>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>