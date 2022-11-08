<?php
  include('session.php');
  include('dbcon.php');
  include('api.php');

  if(isset($_SESSION['admin'])){
    header("location:index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
    
    <link rel="stylesheet" href= "cartCSS.css">


    <style>span {
      display: inline;
    
    }
    a {display: inline;}</style>

    <title>Cart</title>
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
      

        
      
         
<form action="">
  <div class="container2">
  
      
    <h1 >Shopping Cart</h1>
      
  <br><br>
    <div class="cart">
  
      <div class="cart-products" id='cart-productss'>
        <?php
          $cart = getCart($_SESSION['cart']);
          $sum = 0;
          $total = 0;
          if(count($cart)==0) echo "<div class='product' data-id='2'><h2>No items in cart yet</h2></div>";
          foreach($cart as $item){
            $sum += $item['price'] * $item['count'];
            $total += $item['count'];
            echo"
            <div class='product' id='pro-{$item['id']}'> <img src='{$item['photo1']}'>
              <div class='product-info'>
                <h3 class='product-name'>{$item['name']}</h3>
                <h4 class='product-price' id='price-{$item['id']}'>{$item['price']} SR</h4>
                <p class='product-quantity'>Qnt: <input type='number' value='{$item['count']}' onchange='changeTotal(this)' class='cart-item-quantity'
                  id='qnt-{$item['id']}'> <a id='f-{$item['id']}'class='product-remove' onclick='remove(this)'> <i class='fa fa-trash' aria-hidden='true'></i> <span
                  class='remove'>Remove</span></a>
                </p>
              </div>
            </div>";
          }
        ?>
      </div>
      
      <script>
        function setprice(val){
          elem = document.getElementById('total-price')
          let num = 0
          num = parseInt(elem.innerHTML.split(' ')[0])
          num = num + parseInt(val)
          elem.innerHTML = `${num} SR`
        }
        function setcount(val){
          
          elem = document.getElementById('number-of-products')
          let num = 0
          num = parseInt(elem.innerHTML)
          num = num + parseInt(val)
          elem.innerHTML = `${num}`
        }

        function remove(elem){
          id = elem.id.split('-')[1];
          count = document.getElementById('qnt-'+id).value
          price = document.getElementById('price-'+id).innerHTML.split(' ')[0];
          setprice(-price*count);
          setcount(-count);
          document.getElementById('pro-'+id).remove();
          $.ajax({
            method:'POST',
            url : 'api.php',
            data: {
              removecart : true,
              all : true,
              id : id
            },
            success : (res) => console.log(res)
          })
        }

        function changeTotal(elem){
          if(elem.value < 1) elem.value = 1;
          id = elem.id.split('-')[1]
          console.log('price-'+id)
          price = document.getElementById('price-'+id).innerHTML.split(' ')[0];
          $.ajax({
            method:'POST',
            url : 'api.php',
            data: {
              setcart : true,
              id : id,
              count : elem.value
            },
            success : (res) => {
              console.log(res)
              res = parseInt(res)
              setcount(res)
              setprice(res*parseInt(price))
            }
          })
        }

        function removeAll(){
          document.getElementById('cart-productss').innerHTML = "<div class='product'><h2>No items in cart yet</h2></div>";
          document.getElementById('total-price').innerHTML = '0 SR';
          document.getElementById('number-of-products').innerHTML = '0';
          $.ajax({
            method:'POST',
            url : 'api.php',
            data: {emptyCart : true},
          })
        }
      </script>

      <div class="cart-total">
        <p>
          <span>Total Price</span>
          <span id="total-price"><?php echo $sum?> SR</span>
        </p>
        <p>
          <span>Number of Items</span>
          <span id="number-of-products"><?php echo $total?></span>
        </p>
  
        <a id="CC" href="#" onclick="removeAll()">Proceed to Checkout</a>
      </div>
    </div>
     <a class="removeall" onclick="removeAll()">
        Remove All
     </a>
  </div>
  </form>
        </main>

 
<br><br>
  
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
