<?php
session_start();
if(!isset($_SESSION['cart']))
    $_SESSION['cart'] = array();
else foreach($_SESSION['cart'] as $item){
    echo "<script>console.log($item)</script>";
}


