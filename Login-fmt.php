<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['Username'] === $uname && $row['Password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['Username'];

                $_SESSION['name'] = $row['Username'];

                $_SESSION['id'] = $row['ID'];

                header("Location: index.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

 }
// else{

//     header("Location: index.php");

//     exit();

// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Sign Up</title>
    
</head>
<body class="LoginBackground"> 
    <div class="SignUpform">
        <form  action="Login.php" method="post" style="border:1px solid #ccc">
            <div class="container ">
              <h1 class="LoginFormheader">Login below</h1>
              <hr>
              <?php if (isset($_GET['error'])) { ?>

                <p class="error"><?php echo $_GET['error']; ?></p>
    
            <?php } ?>
              <label for="text"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required>
          <br>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
          <br>
              
          
              <div class="clearfix">
                <button name="submit" style="position: relative; left: 30px;" type="submit" class="signupbtn">Login</button>
              </div>
            </div>
        </form>
    </div>
    
</body>
</html>