<?php include('db.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
 
<body>
    <?php include('navbar.php'); ?>

    <?php
    $products = $conn->query("SELECT * FROM products");
    ?>
    <h3>Welcome to Our Pizza Hut</h3>
    <div class="container mt-5 shadow">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4" >
            

            <?php while ($product = $products->fetch_assoc()): ?>
                <div class="col mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="uploads/<?php echo $product['image'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['title'] ?></h5>
                            <p class="card-text"><?php echo number_format($product['price'],2); ?></p>
                            <a href="cart.php?id=<?php echo $product['id'];?>"class="btn btn_primary">Order Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>