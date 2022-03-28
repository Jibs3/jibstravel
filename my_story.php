<?php require_once("inc/db.php"); ?>
<?php require_once("inc/functions.php"); ?>
<?php require_once("inc/sessions.php"); ?>

<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login(); 

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
    <div class="container"> 
        <h1>Hello  <?php echo $_SESSION["Username"] ?></h1>
    </div>
    <div class="col-8 offset-md-2">
      <div class="mt-4">
        <h1>My Stories</h1>
        <div class="mt-3">
          <a class="btn btn-warning" href="create_story.php">Create Stories</a>
        </div>
      </div>

          <?php
              $my_id = $_SESSION["UserId"];
              global $ConnectingDB;
              $sql = "SELECT * FROM stories WHERE user_id = '$my_id' ORDER BY id asc";
              $Execute =$ConnectingDB->query($sql);
              $SrNo = 0;
              while ($DataRows=$Execute->fetch()) {
              $id                = $DataRows["id"];
              $user_id           = $DataRows["user_id"];               
              $story_title        = $DataRows["story_title"];
              $image              = $DataRows["image"];
              $travel_experience   = $DataRows["travel_experience"];
              $datetime           = $DataRows["datetime"];
              $username           = $DataRows["username"];              
          ?>
        <div class="card mb-3 mt-5">
          <img src="<?php echo htmlentities($image); ?>" class="card-img-top" height="500" alt="Story_Image">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlentities($story_title); ?></h5>
            <p class="card-text"><?php echo htmlentities($travel_experience); ?></p>
            <p class="card-text"><small class="text-muted"><?php echo htmlentities($datetime); ?></small></p>
            <p class="card-text">Posted By: <small class="text-muted"><i><?php echo htmlentities($username); ?> </i></small></p>
          </div>
        </div>
        <?php }?>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>