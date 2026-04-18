<?php include("db.php")?> 
<?php session_start()?> 
 
<?php  
    if(isset($_GET['logout'])){ 
        session_destroy(); 
        header("location:login.php"); 
        exit(); 
    } 
?>
