<?php 
include("db.php"); 
include("navbar.php"); 

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

    // if(!empty($id)){
        // unset($_SESSION['cart']); 

        $_SESSION['cart'][] = $id;

        echo "<script>window.location='cart.php';</script>";
        exit();
    // }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-primary">Your Cart</h2>
    <table class="table table-bordered">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        <?php
        $total = 0;
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $id){
                $id = intval($id);
                $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
                if($row = mysqli_fetch_assoc($res)){
                    $total += $row['price'];
                    echo "<tr>
                            <td>{$row['title']}</td>
                            <td>" . number_format($row['price']) . " Ks</td>
                          </tr>";
                }
            }
        } else {
            echo "<tr><td colspan='2' class='text-center'>Your cart is empty!</td></tr>";
        }
        ?>
        <tr>
            <td><strong>Total</strong></td>
            <td><strong><?php echo number_format($total); ?> Ks</strong></td>
        </tr>
    </table>

    <?php if($total > 0): ?>
    <form action="order.php" method="POST">
        <button type="submit" name="order" class="btn btn-success w-100">Order Now</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>