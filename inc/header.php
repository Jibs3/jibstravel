<nav id="navbar" class="navbar navbar-expand-lg">
    <a class="navbar-brand navtext" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">        
        <a class="navtext" href="about.php">About</a>
        <!-- <a class="navtext" href="#">Travel Story</a> -->
        <a class="navtext" href="login.php">Login</a>
        <a class="navtext" href="register.php">Register</a>
        <?php if(isset($_SESSION["UserId"])){ ?>
        <a class="navtext" href="logout.php">Logout</a>
        <?php }?>
        </div>
    </div>
</nav>

 