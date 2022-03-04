<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Sign Up</title>
    
</head>
<body class="ReisterBackground"> 
    <div class="SignUpform">
        <form  action="" style="border:1px solid #ccc">
            <div class="container ">
              <h1 class="SignUpFormheader">Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>
          
              <label for="text"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="Username" required>
          <br>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>
          <br>
              <label style="position: relative; left: -30px" for="psw-repeat"><b>Repeat Password</b></label>
              <input style="position: relative; left: -30px" type="password" placeholder="Repeat Password" name="psw-repeat" required>
          
              <div class="clearfix">
                <button style="position: relative; left: 30px;" type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
        </form>
    </div>
    
</body>
</html>