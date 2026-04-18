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

    // ၁။ ဈေးနှုန်းပေါင်းမယ်
    foreach($cart as $id){
        $id = intval($id);
        $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
        if($row = mysqli_fetch_assoc($res)){
            $total_sum += $row['price'];
        }
    }

    // ၂။ orders table ထဲ ထည့်မယ် (ဒီမှာ product_id ထည့်စရာမလိုပါ၊ total ပဲ ထည့်ပါ)
    $sql_order = "INSERT INTO orders (total) VALUES ('$total_sum')";
    
    if(mysqli_query($conn, $sql_order)){
        $order_id = mysqli_insert_id($conn); // အခုပဲဝင်သွားတဲ့ Order ID ကို ယူတယ်

        // ၃။ order_items ထဲ ပစ္စည်းတွေ ခွဲထည့်မယ်
        foreach($cart as $id){
            $id = intval($id);
            $res = mysqli_query($conn, "SELECT price FROM products WHERE id=$id");
            $row = mysqli_fetch_assoc($res);
            $p_price = $row['price'];

            // ဒီမှာမှ order_id ရော product_id ရော တွဲထည့်တာပါ
            $sql_item = "INSERT INTO order_items (order_id, product_id, price) 
                         VALUES ('$order_id', '$id', '$p_price')";
            mysqli_query($conn, $sql_item);
        }

        // ၄။ အောင်မြင်ရင် Cart ကို ရှင်းထုတ်ပစ်မယ်
        unset($_SESSION['cart']);
        echo "<script>alert('Order Successful! ID: $order_id'); window.location='product.php';</script>";
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
}
?>