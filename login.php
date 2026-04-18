<?php include('db.php') ?> 
 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Document</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> 
    <script src="https://www.google.com/recaptcha/api.js"></script> 
</head> 
<body> 
    <?php include('navbar.php'); ?> 
    <?php  
        if(isset($_POST['submit'])){ 
            $secretKey = "6Lczt5wsAAAAAAmhtGXhRaDPoM7mOX0gsGjC6zTK"; 
            $responseKey = $_POST["g-recaptcha-response"]; 
            $userIP = $_SERVER['REMOTE_ADDR']; 
 
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP"; 
 
            $response = file_get_contents($url); 
            $responseData = json_decode($response); 
 
            if($responseData->success) { 
            $username=$_POST['username']; 
            $password=$_POST['password']; 
 
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?"); 
            $stmt->bind_param("s",$username); 
            $stmt->execute(); 
            $result = $stmt->get_result(); 
            $user = $result->fetch_assoc(); 
             
            if($user && password_verify($password,$user['password'])) { 
                $_SESSION['msg'] = "Login Successfully"; 
                $_SESSION['username'] = $user['username']; 
            }else{ 
                $_SESSION['msg'] = "Invalid user"; 
            } 
            header("location:index.php"); 
            exit(); 
        } 
     } 
?> 
 
    <div class="container"> 
        <form method="post" style="max-width: 500px;" class="mx-auto mt-5"> 
            <h1 class="text-center">Login</h1> 
            <div class="mb-3"> 
                <label class="form-label">Username</label> 
                <input type="text" class="form-control" name="username"> 
            </div> 
             <div class="mb-3"> 
                <label class="form-label">Password</label> 
                <input type="password" class="form-control" name="password"> 
            </div>  
            <div class="g-recaptcha" data-sitekey="6Lczt5wsAAAAAEj5tGBX2TBwZOFKP_Jr6uRPJ8lU"></div> 
            <button type="submit" class="btn btn-outline-success" name="submit">Login</button> 
        </form> 
        <p>Don't have account <a href="register.php">Register</a></p> 
    </div> 
    <!-- <p>Login</p> --> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
</body> 
</html>