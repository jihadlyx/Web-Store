<?php 
    include("../PHP/dbcon.php");
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
<body dir="rtl">
    <!-- Start Header -->
    <?php include("header.php") ?>
    <!-- End Header -->
    <!-- Start Cart -->
    <?php include("cart.php") ?>
    <!-- End Cart -->
    <!-- Start Landing -->
    <div class="product">
        <div class="container">
            <?php
                if(isset($_GET["id"]))
                    $sql = "SELECT products.id, products.name, price, company, quantity, details, path, phone, type_product.name AS type FROM `products` JOIN employees ON employees.id = id_employee JOIN type_product ON type_product.id = products.type_id WHERE products.id = {$_GET["id"]}";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_OBJ);
            ?>
            <div class="image">
                <img src="../<?= $result->path ?>" alt="">
            </div>
            <div class="info-text">
                <h2 class="title"><?= $result->name ?></h2>
                <h2 class="price">$<?= $result->price ?></h2>
                <h2 class="company">الشركة: <?= $result->company ?></h2>
                <h2 class="company">النوع : <?= $result->type ?></h2>
                <p class="details">
                    
                    <?= $result->details ?>
                </p>
                <div class="request">
                    <input type="number" name="" min="0" max="<?= $result->quantity ?>" value="0" id="quantity">
                    <button class="add-cart">إضافة إلى السلة</button>
                </div>
            </div>
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>