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
        if(isset($_GET['id'])) { 
            $id = $_GET['id']; 
             
            $products = $conn->query ("SELECT * FROM products WHERE id=$id"); 
            $product = $products->fetch_assoc(); 
             
        } 
    ?> 
 
    <?php 
        $media = "uploads/"; 
        if(!is_dir($media)) mkdir($media); 
 
        if(isset($_POST['submit'])) { 
            $id = $_POST['id']; 
            $title = $_POST['title']; 
            $price = $_POST['price']; 
            $image = $_FILES['old_image']; 
            if(isset($_FILES['image']) && $_FILES['image']['name'] !='') { 
            $image = time()."_".basename($_FILES['image']['name']); 
            move_uploaded_file($_FILES['image']['tmp_name'], $media.$image); 
           } 
 
           $conn->query("UPDATE products SET title='$title',price='$price',image='$image' WHERE id=$id"); 
           header("location:product.php"); 
        } 
    ?> 
     <div class="container"> 
        <form method="post" enctype="multipart/form-data" style="max-width: 500px;" class="mx-auto mt-5"> 
            <input type="hidden" name ="id" value="<?= $product['id'] ?>"> 
            <input type="hidden" name="old_image" value="<?= $product['image'] ?>"> 
            <div class="mb-3"> 
                <label class="form-label">Product title</label> 
                <input type="text" class="form-control" name="title" value="<?= $product['title'] ?>"> 
            </div> 
             <div class="mb-3"> 
                <label class="form-label">Product prices</label> 
                <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>"> 
            </div>  
            <div class="mb-3"> 
                <label class="form-label">Product image</label> 
                <input type="file" class="form-control" name="image"> 
            </div> 
            <button type="submit" class="btn btn-outline-success" name="submit">Save</button> 
        </form> 
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
</body> 
</html>