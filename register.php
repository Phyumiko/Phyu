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
        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            // $password = $_POST['password'];
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

            $check = $conn->query("SELECT * FROM users WHERE username='$username'");

            if($check->num_rows > 0) {
                echo "User already exist";
            } else {
                $stmt = $conn->prepare("INSERT INTO users(username,password)VALUES(?,?)");
                $stmt->bind_param("ss",$username,$password);

                if($stmt->execute()) {
                    $_SESSION['msg'] = "Register Successfully";
                }else{
                    echo "Register Fail";
                }
                $stmt->close();
                header("location:login.php");
            }
        }
    ?>
     <div class="container">
        <form style="max-width: 500px;" class="mx-auto mt-5" method="post">
            <h1 class="text-center">Register</h1>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
             <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div> 
            <button type="submit" class="btn btn-outline-success" name="submit">Register</button>
        </form>
        <p>Already have account <a href="login.php">Login</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>