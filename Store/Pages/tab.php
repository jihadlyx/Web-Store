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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
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

    <!-- Start Section -->
    <section class="section">
        <div class="container">
            <?php 
                if(isset($_GET["id"])){
                    $sql = "SELECT products.id, products.name, price, company, quantity, details, path, phone, type_product.name AS type FROM `products` JOIN employees ON employees.id = id_employee JOIN type_product ON type_product.id = products.type_id WHERE products.type_id = {$_GET["id"]}";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchALL(PDO::FETCH_OBJ);
            ?>
            <h2 class="main-text" style="margin-top: 60px"><?= isset($result[0]) ? $result[0]->type : "هذا المنتج غير متوفر"?></h2>
            <p>
            </p>
            <div class="content-section">
                <?php
                    
                        foreach($result as $prodcut){
                                ?>
                                    <div class="box">
                                        <div class="image">
                                            <!-- <span>بيع</span> -->
                                            <img src="../<?= $prodcut->path ?>" alt="">
                                        </div>
                                        <h2 class="title"><a href="productPage.php?id=<?= $prodcut->id ?>"><?= $prodcut->name ?></a></h2>
                                        <h3 class="prices">
                                            <span><?= $prodcut->price ?></span>
                                            <!-- <span>$50.00</span> -->
                                        </h3>
                                        <div class="stars">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <button class="btn-add">إضافة إالى السلة </button>
                                    </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- End Section -->


    <script src="main.js"></script>
</body>
</html>