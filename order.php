<?php
include("navbar.php"); 
include("db.php");

if(isset($_POST['order'])){
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
        echo "<script>alert('ပစ္စည်းအရင်ရွေးပါ'); window.location='product.php';</script>";
        exit();
    }

    $cart = $_SESSION['cart'];
    $total_sum = 0;

    foreach($cart as $id){
        $id = intval($id);
        $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
        if($row = mysqli_fetch_assoc($res)){
            $total_sum += $row['price'];
        }
    }

    $sql_order = "INSERT INTO orders (total) VALUES ('$total_sum')";
    
    if(mysqli_query($conn, $sql_order)){
        $order_id = mysqli_insert_id($conn); 

        foreach($cart as $id){
            $id = intval($id);
            $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
            $row = mysqli_fetch_assoc($res);
            $p_price = $row['price'];

            $sql_item = "INSERT INTO order_items (order_id, product_id, price) 
                         VALUES ('$order_id', '$id', '$p_price')";
            mysqli_query($conn, $sql_item);
        }

        unset($_SESSION['cart']);
        echo "<script>alert('Order Successful! ID: $order_id'); window.location='product.php';</script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>