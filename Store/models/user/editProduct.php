<?php 
    include("../../PHP/dbcon.php");
    session_start();
    if(!isset($_SESSION["id_employee"]) || $_SESSION["id_employee"] == null){
        header("Location: ../../Pages/login.php");
        exit(0);
    }
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
        <link rel="icon" href="images/cropped-fav_icon-32x32.png">
        <link rel="shortcut" href="images/cropped-fav_icon-32x32.png">
        <link rel="apple-touch" href="images/cropped-fav_icon-32x32.png">
        <!-- Google Fonts 'Work sans' -->
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- Main File CSS -->
        <link rel="stylesheet" href="../../CSS/controlePanel.css">
        <link rel="stylesheet" href="../../CSS/store.css">
        <!-- Normalize File CSS -->
        <link rel="stylesheet" href="../../CSS/normalize.css">
        <!-- Font Awesome Library -->
        <link rel="stylesheet" href="../../CSS/all.min.css">
        <title>Gizmo</title>
    </head>
<body dir="rtl">
    <div class="page">
        <div class="sidebar">
            <h3>متجر جهاد</h3>
            <ul>
                <li ><a  href="../../Pages/index.php">
                    <i class="fa-regular fa-chart-bar fa-fw"></i>
                    <span>المتجر</span>
                </a></li>
                <!-- <li><a href="../admin/employees.php">
                    <i class="fa-regular fa-user fa-fw"></i>
                    <span>الموظفين</span>
                </a></li> -->
                <li><a class="active" href="products.php">
                    <i class="fa-brands fa-product-hunt fa-fw"></i>
                    <span>المنتجات</span>
                </a></li>
                <li><a href="../module/profile.php">
                    <i class="fa-regular fa-circle-user fa-fw"></i>
                    <span>الحساب</span>
                </a></li>
                <li><a href="../../PHP/login.php?sign_out=1">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    <span>خروج</span>
                </a></li>
            </ul>
        </div>
        <div id="hide"></div>
        <div class="content">
            <div class="head">
                <div class="input-box">
                    <input class="search" type="text" placeholder="Type A Keyword" name="" id="">
                </div>
                <div class="icons">
                    <span class="notification">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </span>
                    <?php
                        if(isset($_SESSION["id_employee"])){
                            $sql = "SELECT position FROM employees WHERE id = {$_SESSION["id_employee"]}";
                            $q = $conn->prepare($sql);
                            $q->execute();
                            $path = $q->fetch(PDO::FETCH_OBJ)->position;
                        }
                    ?>
                    <img src="<?= "../../". $path ?>" alt="">
                </div>
            </div>
            <h3 class="title-main">المنتجات</h3>
            <div class="wrapper">
                <div class="box">
                    <form action="../../PHP/products.php"  method="POST" enctype="multipart/form-data">
                        <?php
                            if(isset($_GET["id"])){
                                $sql = $conn->prepare("SELECT products.id, products.name, price, company, quantity, details, path, type_id, type_product.name AS type FROM `products` JOIN type_product ON type_id = type_product.id WHERE products.id = {$_GET["id"]}");
                                $sql->execute();
                                $prod = $sql->fetch(PDO::FETCH_OBJ);
                            }
                        ?>
                        <div class="input-box">
                            <label for="name">رقم المنتج</label>
                            <input type="text" name="id" value="<?= $prod->id ?>" placeholder="أدخل رقم المنتج " required >
                        </div>
                        <div class="input-box">
                            <label for="name">اسم المنتج</label>
                            <input type="text" name="name" value="<?= $prod->name ?>" placeholder="  أدخل اسم المنتج" required >
                        </div>
                        <div class="input-box">
                            <label for="name">السعر</label>
                            <input type="text" name="price" value="<?= $prod->price ?>" placeholder="ادخل سعرالمنتج" required >
                        </div>
                        <div class="input-box">
                            <label for="name" >الشركة المصنعة</label>
                            <input type="text" name="company" value="<?= $prod->company ?>" placeholder="اسم الشركة" required >
                        </div>
                        <div class="input-box">
                            <label for="name" >الكمية</label>
                            <input type="text" name="quantity" value="<?= $prod->quantity ?>" placeholder="ادخل الكمية" required >
                        </div>
                        <div class="input-box">
                            <label for="name">النوع</label>
                            <select name="type" id="">
                            <option value="<?= $prod->type_id ?>"><?= $prod->type; ?></option>
                                <?php 
                                    $q = $conn->prepare("SELECT * FROM type_product WHERE id != $prod->type_id");
                                    $q->execute();
                                    $selects = $q->fetchAll(PDO::FETCH_ASSOC);
                                    if($selects){
                                        foreach($selects as $item){
                                            ?>
                                            <option value="<?= $item["id"] ?>"  ><?= $item["name"]; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="name">تفاصيل المنتج</label>
                            <textarea name="details"  id="text-area" placeholder="معلومات عن المنتج " required > <?= $prod->details ?> </textarea>
                        </div>
                        <div class="input-box">
                            <label for="name">صورة المنتج</label>
                            <input type="file" name="file" value="<?= $prod->path ?>" id="upload-photo" accept="image/*" >                            
                            <div class="up-photo"> تحميل صورة <i class="fa-solid fa-upload"></i></div>
                        </div>                        
                        
                        <div class="btn-submit">
                            <input type="submit" style="background: #0169F6" value="تعديل" name="update-product" class="but">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../../indexPanel.js"></script>
</body>
</html>