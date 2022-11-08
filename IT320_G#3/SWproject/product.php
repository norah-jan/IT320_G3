<?php
  include("dbcon.php");
  include("session.php");
  if(!isset($_GET['id']))
    header('location:category.php');
  $query = mysqli_query($con, "select product.*, category.name as cat from product
                        inner join category on category.id = product.category_id  
                        where product.id={$_GET['id']}");
  $pro = mysqli_fetch_assoc($query); 
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
    <link rel="stylesheet" href="./assets/css/ProductsStylesheet.css" />
    <title><?php echo $pro['name']?></title>
  </head>
  <body>
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
	  <main>
      <nav class="navigation">
        <ul class="nav-list">
         <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="shopping.php">Shop</a></li>
          <li class="nav-item"><a href="about-us.html">About us</a></li>
        </ul>
      </nav>

      <!-- PRODUCT -->
      <div class="productContainer">
        <h3 class="productName"><?php echo $pro['name']?></h3>
        <p class="productType"><?php echo $pro['cat']?></p>
        <p class="productPrice"><?php echo $pro['price']?> SAR </p>
       
        <div class="productTopContent">
          <div class="productPreviewItem">
            <div class="productPreviewItemContainer">
              <img
                id="productExpandedImg"
                src="<?php echo $pro['photo1']?>"
                style="width:24% ; margin-left: 38%;"
              />
            </div>
            <div class="productPreviewItemRow">
              <div class="productPreviewItemColumn">
                <img
                  src="<?php echo $pro['photo1']?>"
                  alt=""
                  style="width: 50%"
                  onclick="previewImage(this);"
                />
              </div>
              <div class="productPreviewItemColumn">
                <img
                  src="<?php echo $pro['photo2']?>"
                  alt=""
                  style="width: 50%"
                  onclick="previewImage(this);"
                />
              </div>
              <div class="productPreviewItemColumn">
                <img
                  src="<?php echo $pro['photo3']?>"
                  alt=""
                  style="width: 50%"
                  onclick="previewImage(this);"
                />
              </div>
            </div>
          </div>
          <div class="productGeneralInformation">
           
            <div class="productBtnActions">
              <?php if(isset($_SESSION['admin']))
                echo"<a href='Edit.php?id={$pro['id']}'><button class='productBtn productBtnAddToDreamBox'>Edit</button></a>";
              ?>
            </div>
          </div>
        </div>
        <div class="productBottomContent">
          <div class="productBottomContentLeft">
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">Origin</h4>
              <p class="productBottomInfo"><?php echo $pro['origin']?></p>
            </div>
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">Measurements</h4>
              <p class="productBottomInfo"><?php echo $pro['measurs']?></p>
            </div>
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">Brand</h4>
              <p class="productBottomInfo"><?php echo $pro['brand']?></p>
            </div>
          </div>
          <div class="productBottomContentRight">
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">
                <span>Material</span>
                <span class="productBottomIcon">
                  <i class="fa-solid fa-circle-info"></i>
                </span>
              </h4>
              <p class="productBottomInfo"><span><?php echo $pro['material']?></span></p>
            </div>
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">Condition</h4>
              <p class="productBottomInfo">
              <?php echo $pro['conditions']?> 
              </p>
            </div>
            <div class="productBottomContentItem">
              <h4 class="productBottomTitle">Era</h4>
              <p class="productBottomInfo">
              <?php echo $pro['era']?>
              </p>
            </div>
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
  <!-- JS SCRIPTS -->
  <script>
    function previewImage(imgs) {
      console.log(imgs);
      var expandImg = document.getElementById("productExpandedImg");
      expandImg.src = imgs.src;
      expandImg.parentElement.style.display = "block";
    }
  </script>
</html>
