<?php

    include('dbcon.php');
    if(!isset($_SESSION))session_start();
    
    if(isset($_POST['addcart'])){
        $id = $_POST['id'];
        $arr = [];
        if(isset($_SESSION['cart']))
            $arr = $_SESSION['cart'];
        array_push($arr, $id);
        $_SESSION['cart'] = $arr;
        echo 'f';
    }

    if(isset($_POST['removecart'])){
        $id = $_POST['id'];
        $all = $_POST['all'];
        if($all)
            $_SESSION['cart'] = array_diff($_SESSION['cart'], array($id));
        else
            unset($array[array_search($id,$array)]);
        echo 'ff';
    }

    if(isset($_POST['setcart'])){
        $id = $_POST['id'];
        $count = $_POST['count'];
        $map = array_count_values($_SESSION['cart']);
        $arr = array_diff($_SESSION['cart'], array($id));
        for($i=0; $i<$count; $i++) array_push($arr, $id);
        $_SESSION['cart'] = $arr;
        $newMap = array_count_values($_SESSION['cart']);
        if(array_key_exists($id, $newMap))
            echo ($newMap[$id] - $map[$id]);
        else echo -$map[$id];
    }

    if(isset($_POST['emptyCart'])){
        $_SESSION['cart'] = array();
    }

    if(isset($_GET['logout'])){
        unset($_SESSION['admin']);
        unset($_SESSION['cart']);
        header("location:index.php");
    }

    if(isset($_GET['delete'])){
        mysqli_query($con, "DELETE FROM `product` WHERE `id` = {$_GET['delete']}");
        echo "";
    }

    function getCart($arr){
        global $con;
        $map = array_count_values($arr);
        $ret = array();
        foreach(array_keys($map) as $id){
            $query = mysqli_query($con, "select * from product where id=$id");
            $row = mysqli_fetch_assoc($query);
            $row['count'] = $map[$id];
            array_push($ret, $row);
        }
        return $ret;
    }


?>