<?php 
    include("../PHP/dbcon.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Icon -->
    <link rel="icon" href="../images/cropped-fav_icon-32x32.png">
    <link rel="shortcut" href="../images/cropped-fav_icon-32x32.png">
    <link rel="apple-touch" href="../images/cropped-fav_icon-32x32.png">
    <!-- Google Fonts 'Work sans' -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Main File CSS -->
    <link rel="stylesheet" href="../CSS/store.css">
    <!-- Normalize File CSS -->
    <link rel="stylesheet" href="../CSS/normalize.css">
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="../CSS/all.min.css">
    <title>Gizmo</title>
</head>
<body dir="rtl" >
    <!-- Start Header -->
    <?php include("header.php") ?>
    <!-- End Header -->
    <!-- Start Cart -->
    <?php include("cart.php") ?>
    <!-- End Cart -->
    <!-- Start Landing -->
    <div class="login">
        <div class="container">
            <h1>تسجيل الدخول</h1>
            <form action="../PHP/login.php" method="POST" class="form">
                <?php 
                    if(isset($_SESSION["error_login"]) && $_SESSION["error_login"] != null) : ?>
                        <div class="alert alert-successfully"><?= $_SESSION["error_login"]; ?></div>
                    <?php $_SESSION["error_login"] = null; endif; ?>
                <div class="input-box">
                    <label for="username">اسم المستخدم أو البريد الإلكتروني *</label>
                    <input type="text" name="username" value="<?= isset($_COOKIE["user"]) ? $_COOKIE["user"] : '' ?>" id="username" required >
                </div>
                <div class="input-box">
                    <label for="pass">كلمة المرور *</label>
                    <input type="password" name="password" value="<?= isset($_COOKIE["password"]) ? $_COOKIE["password"] : '' ?>" id="pass" required >
                </div>
                <div class="check-rem">
                    <input type="checkbox" name="remember" value="true" <?php if(isset($_COOKIE["password"]) && isset($_COOKIE["user"])) echo "checked"?>  id="remember">
                    <label for="remember">ذكرني</label>
                </div>
                <div class="btn-submit">
                    <input type="submit" value="تسجيل الدخول" id="btn-click" name="login" >
                </div>
            </form>
        </div>
    </div>

    <script src="main.js"></script>
    
</body>
</html>