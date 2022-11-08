<?php
  include('session.php');
  include('dbcon.php');
  if(!isset($_SESSION['admin'])){
    header('location:index.php');
  }
  if(!isset($_GET['id'])){
    $pro = array(
        "category_id" =>  "" , 
        "name"=>  "" , 
        "price" =>  "" , 
        "origin" =>  "" , 
        "measurs" =>  "" , 
        "brand" =>  "" , 
        "material" =>  "" ,  
        "conditions" =>  "" , 
        "era" =>  "" , 
        "tag" =>  "" , 
        "description" =>  "" , 
        "photo1" =>  "" ,  
        "photo2" =>  "" , 
        "photo3" =>  "" 
    );
  }
  else{
    $id = $_GET['id'];
    $query = mysqli_query($con, "select * from product where id=$id");
    $pro = mysqli_fetch_assoc($query);
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
     <link rel="stylesheet" href="./assets/css/addAndEditStylesheet.css" />
    <title><?php if(!isset($_GET['id'])) echo"Add"; else echo "Edit";?>Product</title>
  </head>
  <body>
    <div class="container">
      <header class="header-container">
        <a href='api.php?logout=1' class='login'><i class='fa-solid fa-user user-icon'></i> Log Out</a>
        <a href="index.php"><img src="./assets/img/logo.jpg" class="header-logo" /></a>
        <a href="##" class="shopping">
          
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


      <div class="loginWrapper">
        <div class="loginContainer">
          <div class="loginMyForm">
        <h1><?php if(!isset($_GET['id'])) echo"Add"; else echo "Edit"?> Product</h1>
        <br>
        <form method='POST' action="" enctype="multipart/form-data" class="container" style="text-align: left;">
            <fieldest class="input-group">
                <label >Product name: </label><input type="text" name="name" value="<?php echo $pro['name']?>">
                <br><br>
                <label >Product description: </label><input type="text" name="description" value="<?php echo $pro['description']?>">
                <br><br>
                
                <label>Product era: </label><input type="number" min="1000" max="3000" name="era" value="<?php echo $pro['era']?>"> 
                <br><br>
                <label>Measurements: </label>
                <textarea name="measurs" cols="75" rows="10" ><?php echo $pro['measurs']?></textarea>
                <br><br>
                <label>Category:</label>
                    <select name="category" id="measure">
                      <?php
                        $query = mysqli_query($con, "SELECT * FROM category");
                        $arr = mysqli_fetch_all($query);
                        foreach($arr as $cat){
                          if($cat[0] == $pro['category_id'])
                            echo "<option selected value='$cat[0]'>$cat[1]</option>";
                          else
                            echo "<option value='$cat[0]'>$cat[1]</option>";
                        }
                      ?>
                    </select>
                
                <br><br><br>
                <label>Tag: </label>
                <input name='tag' type="text" value="<?php echo $pro['tag']?>"> 
                <label>Condition: </label>
                <input name='conditions' type="text" value="<?php echo $pro['conditions']?>"> 
                <br><br>
                <label>Material: </label> 
                <input name='material' type="text" value="<?php echo $pro['material']?>"> 
                <br><br>
                <label>Origin:</label>
                 <input type="text" name='origin' value="<?php echo $pro['origin']?>"> 
                <br><br>
                <label>Product brand: </label>
                <input name='brand' type="text" value="<?php echo $pro['brand']?>"> 
                <br><br>
                <label>Product cost: </label>
                <input type="number" min="0" name="price" value="<?php echo $pro['price']?>">
                <br><br>
                <br><br>
            </fieldest>

            <fieldset class="input-group">
                <legend>Upload an Image: </legend>
                <br>
                <input type="file" name="photo1" value=<?php echo $pro['photo1']?>><br><br>
                <input type="file" name="photo2" value=<?php echo $pro['photo2']?>><br><br>
                <input type="file" name="photo3" value=<?php echo $pro['photo3']?>><br><br>
            </fieldset>
            <br><br>
            <input name='subb' type="submit" style="display:block;width:45%;background:black;color:white;cursor:pointer; margin:0; display:inline"
            value='<?php if(isset($_GET['id'])) echo "Edit Product"; else echo "Add Product";?>'>
            <button style="float:right;width:45%;"><a href="shopping.php" style="color:white ;">Cancel</a></button>
            <br><br><br><br>
        </form>
      </div>
    </div>
  </div>
</div>
	  </main>
    <?php
      if(isset($_POST['subb'])){
        if(!isset($_GET['id'])){
          $arr = array();
          for($i=1; $i<=3; $i++){
            $file = time()."-".$_FILES["photo".$i]["name"];
            $folder = "Image/".$file;
            $arr['photo'.$i] = $folder;
            move_uploaded_file($_FILES["photo".$i]["tmp_name"], $folder);
          }
          $query = mysqli_query($con, "
            INSERT INTO `product`(`category_id`, `name`, `price`, `origin`, `measurs`, `brand`, 
            `material`,`conditions`, `era`, `tag`, `description`, `photo1`, `photo2`, `photo3`)
            VALUES ({$_POST['category']}, '{$_POST['name']}', '{$_POST['price']}', '{$_POST['origin']}',
            '{$_POST['measurs']}', '{$_POST['brand']}', '{$_POST['material']}', '{$_POST['conditions']}', '{$_POST['era']}',
             '{$_POST['tag']}', '{$_POST['description']}', '{$arr['photo1']}', '{$arr['photo2']}', '{$arr['photo3']}');
          ");
          echo "<script>alert('Product added successfully!');window.location.href='shopping.php';</script>";
        }
        else{
          $arr = array();
          for($i=1; $i<=3; $i++){
            if($_FILES["photo".$i]["name"] == ""){
              $arr['photo'.$i] = $pro['photo'.$i];
            }
            else{              
              $file = time()."-".$_FILES["photo".$i]["name"];
              echo "<script>console.log('{$_FILES['photo'.$i]['name']}')</script>";
              if($_FILES["photo".$i]["name"] == "") $file = $pro['photo'.$i];
              $folder = "Image/".$file;
              $arr['photo'.$i] = $folder;
              move_uploaded_file($_FILES["photo".$i]["tmp_name"], $folder);
            }
          }
          $query = mysqli_query($con, "UPDATE `product` SET
            `category_id` = {$_POST['category']}, 
            `name`= '{$_POST['name']}', 
            `price` = '{$_POST['price']}', 
            `origin` = '{$_POST['origin']}', 
            `measurs` = '{$_POST['measurs']}',
            `brand` = '{$_POST['brand']}', 
            `material` =  '{$_POST['material']}',
            `conditions` = '{$_POST['conditions']}',
            `era` =  '{$_POST['era']}',
            `tag` = '{$_POST['tag']}', 
            `description` = '{$_POST['description']}', 
            `photo1` = '{$arr['photo1']}', 
            `photo2` = '{$arr['photo2']}',
            `photo3` = '{$arr['photo3']}'
            WHERE id = $id;
          ");
          echo "<script>alert('Product updated successfully!');window.location.href='shopping.php';</script>";          
        }
      }
    ?>
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
</html>
