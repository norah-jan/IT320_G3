<?php
  include('session.php');
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
    
    <link rel="stylesheet" href= "IpadCSS1.css">
    <title>Homepage</title>
  </head>
  <body>

  <main>
    <div class="container">
    <header class="header-container">
        <?php
          if(!isset($_SESSION['admin']))
            echo "<a href='login.php' class='login'><i class='fa-solid fa-user user-icon'></i> Log In</a>";
          else
          echo "<a href='api.php?logout=1' class='login'><i class='fa-solid fa-user user-icon'></i> Log Out</a>";
        ?>
        <a href="index.php"><img src="./assets/img/logo.jpg" class="header-logo" /></a>
        
        <?php
          if(!isset($_SESSION['admin']))
            echo "<a href='cart.php' class='shopping'><i class='fa-sharp fa-solid fa-bag-shopping'></i></a>";
          else
            echo "<a style='opacity:100%'></a>";
        ?>
      </header>
      <nav class="navigation">
        <ul class="nav-list">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="shopping.php">Shop</a></li>
          <li class="nav-item"><a href="about-us.html">About us</a></li>
        </ul>
      </nav>
      
      <div class="advertise">
        <a href="##">Free delivery on orders over 250 SR</a>
        <section class="slider">
          <div class="button-container">
            <div class="shop-now">
              <span class="main-header">Fashion not changing always</span>
              <a class="shop-btn" href="shopping.php">Shop now</a>
            </div>
            <a href="##" class="button" id="previous"
              ><i class="fa-solid fa-chevron-left"></i
            ></a>
            <a href="##" class="button" id="next"
              ><i class="fa-solid fa-chevron-right"></i
            ></a>
          </div>
          <div class="slider-container">
            <div class="slide" id="slide1"></div>
            <div class="slide" id="slide2"></div>
            <div class="slide" id="slide3"></div>
          </div>
        </section>
      </div>
      <div class="delivery">
        <div class="delivery__item">
          <span class="delivery__icon-fa">
            <i class="fa-solid fa-cart-shopping"></i>
          </span>
          <h3 class="delivery__title">Fast Delivery</h3>
          <p class="delivery__subTitle">Fast delivery for all orders</p>
        </div>
        <div class="delivery__item">
          <span class="delivery__icon">
            <img src="./assets/img/icons/payment.webp" alt="Payment method" />
          </span>
          <h3 class="delivery__title">Secure Payment</h3>
          <p class="delivery__subTitle">Secure payment for all orders</p>
        </div>
        <div class="delivery__item">
          <span class="delivery__icon">
            <img src="./assets/img/icons/247.webp" alt="247" />
          </span>
          <h3 class="delivery__title">24/7 Support</h3>
          <p class="delivery__subTitle">Support all orders at all time</p>
        </div>
      </div>
	  <br> <br> <br>
	  </main>
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
