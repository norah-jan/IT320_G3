<?php
  include('dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Figtree:wght@500;600;700;800&family=IBM+Plex+Sans&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/css/HomepageStylesheet.css" />
    <title>Admin LogIn</title>
  </head>
  <body>
    <div class="container">
      <header class="header-container">
        <a href="" class="login"><i class="fa-solid fa-user user-icon"></i></a>
        <a href="index.php"><img src="./assets/img/logo.jpg" class="header-logo" /></a>
        <a href="cart.php" class="shopping">
          <i class="fa-sharp fa-solid fa-bag-shopping"></i>
        </a>
      </header>
	  <main>
      <nav class="navigation">
        <ul class="nav-list">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="shopping.php">Shop</a></li>
          <li class="nav-item"><a href="about-us.html">About us</a></li>
        </ul>
      </nav>

      <!-- START LOGIN -->
      <div class="loginWrapper">
        <div class="loginContainer">
          <div class="loginMyForm">
            <form action='' method='POST'>
              <h2>ADMIN LOGIN</h2>
              <input type="text" name='username' required placeholder="Admin UserName" />
              <input type="password" name='password' required placeholder="Password" />
              <input type='submit' type="submit" name='login' value='LOGIN'>  
            </form>
            <?php
              if(isset($_POST['login'])){
                $query = mysqli_query($con, "SELECT * FROM admin WHERE username='{$_POST['username']}'");
                $user = mysqli_fetch_assoc($query);
                if($user == null){
                  echo "<h3>incorrect username</h3>";
                }
                else if(!password_verify($_POST['password'], $user['password'])){
                  echo "<h3>incorrect password</h3>";
                }  
                else{
                  if(!isset($_SESSION))
                    session_start();
                  $_SESSION['admin'] = true;
                  header("location:shopping.php");
                }              
              }
            ?>

          </div>
          <div class="loginImage">
            <img  src="./Image/login2.jpg" style="height: 280px; width: 330px;" />
          </div>
        </div>
      </div>
	  </main>

      <!-- FOOTER -->
          <footer class="footer-container">
        <div class="socials">
          <a class="social" href="https://www.facebook.com/">
            <i class="fa-brands fa-square-facebook"></i>
          </a>
          <a class="social" href="https://twitter.com/">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a class="social" href="https://www.instagram.com/">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
        <span class="copyright">@2022, Vintage pieces</span>
      </footer>
    </div>
  </body>
  <script src="slider.js"></script>
</html>
