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
    <?php include("header.php"); ?>
    <!-- End Header -->
    <!-- Start Cart -->
    <?php include("cart.php"); ?>
    <!-- End Cart -->
    <!-- Start Landing -->
    <div class="landing">
        <div class="container">
            <div class="box">
                <img src="../images/background-1.png" class="bg-img" alt="">
                <div class="info">
                    <div class="text-info">
                        <h1>شراء أجهزة متميزة مع قلم</h1>
                        <p>
                            الأن من شركة سامسونج يمكنك شراء تابلت مع قلم خاص بسعر مميز
                        </p>
                        <button>تسوق الأن</button>
                    </div>
                    <img src="../images/ipad.png" alt="">
                </div>
            </div>
            <div class="box">
                <div class="box-content">
                    <img src="../images/background-2.png" class="bg-img" alt="">
                    <div class="info-box">
                        <img src="../images/smartwatch.png" class="image" alt="">
                        <h3>ساعة ذكية</h3>
                        <h6>تصفح</h6>
                    </div>
                </div>
                <div class="box-content">
                    <img src="../images/background-3.png" class="bg-img" alt="">
                    <div class="info-box">
                        <img src="../images/headphones.png" class="image" alt="">
                        <h3>سماعة</h3>
                        <h6>تصفح</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Landing -->
    <!-- Start Section -->
    <section class="section">
        <div class="container">
            <h2 class="main-text">وصل حديثا</h2>
            <p>
                
            </p>
            <div class="content-section">
                
            <?php
                $sql = "SELECT products.id, products.name, price, company, quantity, details, path, phone, type_product.name AS type FROM `products` JOIN employees ON employees.id = id_employee JOIN type_product ON type_product.id = products.type_id";
                $query = $conn->prepare($sql);
                $query->execute();
                $result = $query->fetchALL(PDO::FETCH_OBJ);
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
                ?>
            </div>
        </div>
    </section>
    <!-- End Section -->
    <!-- Start Section Two -->
    <section class="section-two">
        <div class="container">
            <div class="info-text">
                <h1>ساعة ذكية لنمط حياة ذكي</h1>
                <p>
                    <!-- Pellentesque in ipsum id orci porta dapibus. 
                    Vivamus magna justo, lacinia eget consectetur sed, 
                    convallis at tellus. Curabitur non nulla sit amet 
                    nisl tempus convallis quis ac lectus. -->
                </p>
                <button class="btn-book">احجز الأن</button>
            </div>
            <img src="../images/smartwatch.png" alt="">
        </div>
    </section>
    <!-- End Section Two -->
    <!-- Start Section Three -->
    <section class="section-three">
        <div class="container">
            <h2 class="main-text">صفقات لا تحيا</h2>
            <p>
                <!-- Letin semper gravida pretium convallis pellen vestibulum ac diam sit 
                amet quam vehiculased sit amet dui. Quisque velit nisi pretium ut lacinia in elementum id enim tesque. -->
            </p>
            <div class="content-section-three">
                <div class="products-boxes">
                    <div class="box">
                        <div class="image">
                            <span>بيع</span>
                            <img src="../images/gaming-laptop.png" alt="">
                        </div>
                        <h2 class="title"><a href="#">أجهزة ذكية</a></h2>
                        <h3 class="prices">
                            <span>$70.00</span>
                            <span>$50.00</span>
                        </h3>
                        <div class="stars">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <button class="btn-add">إضافة إالى السلة</button>
                    </div>
                    <div class="box">
                        <div class="image">
                            <span>بيع</span>
                            <img src="../images/gaming-laptop.png" alt="">
                        </div>
                        <h2 class="title"><a href="#">أجهزة ذكية</a></h2>
                        <h3 class="prices">
                            <span>$70.00</span>
                            <span>$50.00</span>
                        </h3>
                        <div class="stars">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <button class="btn-add">إضافة إالى السلة</button>
                    </div>
                    <div class="box">
                        <div class="image">
                            <span>بيع</span>
                            <img src="../images/gaming-laptop.png" alt="">
                        </div>
                        <h2 class="title"><a href="#">أجهزة ذكية</a></h2>
                        <h3 class="prices">
                            <span>$70.00</span>
                            <span>$50.00</span>
                        </h3>
                        <div class="stars">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <button class="btn-add">إضافة إالى السلة</button>
                    </div>
                    <div class="box">
                        <div class="image">
                            <span>بيع</span>
                            <img src="../images/gaming-laptop.png" alt="">
                        </div>
                        <h2 class="title"><a href="#">أجهزة ذكية</a></h2>
                        <h3 class="prices">
                            <span>$70.00</span>
                            <span>$50.00</span>
                        </h3>
                        <div class="stars">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <button class="btn-add">إضافة إالى السلة</button>
                    </div>
                </div>
                <div class="box-bumper">
                    <img src="../images/offer-smartphones.png" alt="">
                    <div class="info-text">
                        <h2>50% تخفيض</h2>
                        <h1>بيع الهواتف الذكية</h1>
                        <p>
                            <!-- Vivamus suscipit tortor eget felis porttitor volutpat. 
                            Curabitur non nulla sit amet nisl tempus convallis quis ac 
                            lectus sed porttitor lectus nibh. -->
                        </p>
                        <button class="btn-visit"><a href="#">زيارة المتجر</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Three -->


    <script src="main.js"></script>
</body>
</html>