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
        $counter =1;
    ?>
    <div class="container">
        <div class="py-5 container-fluid d-flex justify-content-end">
            <a href="product_create.php" class="btn btn-primary">+ Add Product</a>
        </div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php  while($product = $products->fetch_assoc()): ?>
    <tr>
      <th scope="row"><?php echo $counter?></th>
      <td><?php echo $product['title'] ?></td>
      <td><?php echo $product['price'] ?></td>
      <td>
         <a href="product_update.php?id=<?= $product['id'] ?>" class="btn btn-outline-warning">Update</a>
         <a href="product_delete.php?id=<?= $product['id'] ?>" class="btn btn-outline-danger">Delete</a>
         
    <a href="cart.php?id=<?php echo $product['id']; ?>" 
          class="btn btn-primary">
          Add to Cart
    </a>
      </td>
    </tr>
    <?php $counter++ ?>
    <?php  endwhile;?>
  </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
</body> 
</html>