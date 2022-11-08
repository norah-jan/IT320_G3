<?php
  include("dbcon.php");
  include("session.php");
  if(!isset($_GET['id']))
    header('location:shopping.php');
  
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Figtree:wght@500;600;700;800&family=IBM+Plex+Sans&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./assets/css/HomepageStylesheet.css" />
    
    <link rel="stylesheet" href= "IpadCSS1.css">
    <title>Vintage Clothing</title>
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
      
      

      <div class="filter">
        <p>Filter :</p>
        <select name="filter" size="1" onchange="sortItems(this)">
          <optgroup label="Products Type">
            <option selected value="all">All</option>
            <?php
              $query= mysqli_query($con, "select DISTINCT(tag) from product where category_id={$_GET['id']}");
              while($row = mysqli_fetch_row($query)){
                echo "<option value=$row[0]>$row[0]</option>";
              }
            ?>
          </optgroup>
        </select>
    </div>
    
    <script>
      function sortItems(elem){
        tag = elem.value;
        items = document.getElementById('alll').children;
        for(var i=0; i<items.length; i++){
          if(items[i].id.split('-')[1]!=tag && tag!='all')
            items[i].style.display = 'none';
          else 
            items[i].style.display = 'revert';
        }
      }
    </script>
 
    
    <!--Ipad images ----------------------------------------------------------------------->
    <div class="IpadTitle">
      <h1> Vintage Clothes </h1> 
      <div class="underline"></div>
    </div>
    
    
    <?php
      if(isset($_SESSION['admin']))
      echo "<a href='edit.php' style='text-align: right ;   font-size: 20px; text-decoration: underline;  color: #b87253; '> Add New Product</a>";
    ?>
    <!---ipad pro--------------------------------------------------------------------------->
    <div class="Products IpadCover" id='alll'>
      <?php
        $query = mysqli_query($con, "select * from product where category_id = {$_GET['id']}");
        if(mysqli_num_rows($query) == 0) echo "<h3>no products added to this category yet</h3>";
        while($row = mysqli_fetch_assoc($query)){
          echo"
            <div class='I-box' data-price='3692' id='div-{$row['tag']}'>
            <img src='{$row['photo1']}'  alt='photo'>
            <a href='product.php?id={$row['id']}' style='color:blue;font-size:10px;font-family: 'Courier New', Courier, monospace; '>
            <img src='Image/icon.png' alt='more detalis'style='width:42px;height:42px; position: relative; left: 180px; top: 50px;' ></a>
            <h3>{$row['name']}</h3>   
            <p>{$row['description']}</p>
            <h6>{$row['price']} SAR</h6>";

          if(isset($_SESSION['admin']))
            echo "<button class='add' id='pro-{$row['id']}' onclick='deletePro(this)'>Delete Product</button>";
          else
            echo "<button class='add' id='pro-{$row['id']}' onclick='addcart(this)'>Add To Cart</button>";
          
          echo "</div>";
        }
      ?>
    </div>
    
    <script>
      function deletePro(elem){
        let id = elem.id.split('-')[1];
        elem.innerHTML = '...'
        console.log(id);
        elem.parentElement.remove();
        $.ajax({
          method:'GET',
          url: 'api.php',
          data:{
            delete : id
          },
          success : elem.parentElement.remove()
        })
      }
      
      function addcart(elem){
        $.ajax({
          method:'POST',
          url : 'api.php',
          data: {
            addcart : true,
            id : elem.id.split('-')[1]
          },
          success : function(res){
            console.log(res);
            elem.innerHTML = 'Added Successfully!';
            setTimeout(()=>{
              elem.innerHTML = 'Add To Cart';
            }, 1000);
          }
        })
      }
    </script>
      
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

</html>