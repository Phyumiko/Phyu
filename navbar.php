<?php session_start() ?>

<style>
    .custom-nav {
        background-color: #2c3e50 !important;
    }

    .custom-nav .nav-link, .custom-nav .navbar-brand {
        color: white !important;
    }

    .btn-primary, .btn-success, .btn {
        background-color: #e67e22 !important; 
        border: none !important;
        color: white !important;
    }

    .btn:hover {
        opacity: 0.8;
        background-color: #d35400 !important;
    }
</style>

<nav class="navbar navbar-expand-lg custom-nav">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Pizza Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="product.php" class="nav-link">Product</a>
                </li>
                <?php if(isset($_SESSION['username'])):?>
                    <li class="nav-item"><h5 class="nav-link text-white"><?php echo $_SESSION['username'] ?></h5></li>
                    <li class="nav-item">
                        <a href="logout.php?logout=1" class="nav-link">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<?php 
    if(isset($_SESSION['msg'])){
        echo "<div class='alert alert-info'>".$_SESSION['msg']."</div>";
        unset($_SESSION['msg']);
    }
?>