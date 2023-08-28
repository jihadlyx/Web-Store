<?php 
    include("../../PHP/dbcon.php");
    session_start();
    if(!isset($_SESSION["id_employee"]) || 
    $_SESSION["id_employee"] == null || $_SESSION["type"] > 1){
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
                <li><a href="employees.php">
                    <i class="fa-regular fa-user fa-fw"></i>
                    <span>الموظفين</span>
                </a></li>
                <li><a class="active" href="products.php">
                    <i class="fa-brands fa-product-hunt fa-fw"></i>
                    <span>المنتجات</span>
                </a></li>
                <li><a href="type_product.php">
                    <i class="fa-solid fa-box-open"></i>
                    <span>الأصناف</span>
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
            <div class="wrapper-two">
                <?php if(isset($_SESSION["Message"]) && $_SESSION["Message"] != null) : ?>
                    <div class="alert alert-successfully"><?= $_SESSION["Message"] ?></div>
                <?php $_SESSION["Message"] = null; endif; ?>
                <div class="content-wrapper">
                    <div class="card-header">
                        <h1 class="title">كل المنتجات</h1>
                        <a href="addProduct.php">إضافة منتج</a>
                    </div>
                    <div class="box-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>الإسم</th>
                                    <th>السعر</th>
                                    <th>الشركة</th>
                                    <th>الكمية</th>
                                    <!-- <th>التفاصيل</th> -->
                                    <th>النوع</th>
                                    <th>المشرف</th>
                                    <th>الصورة</th>
                                    <th>تعديل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $q = $conn->prepare("SELECT products.id, products.name, price, company, quantity, details, path, employees.name AS employee_name, type_product.name As type FROM products JOIN employees ON id_employee = employees.id JOIN type_product ON products.type_id = type_product.id ORDER BY products.id DESC");
                                    $q->execute();
                                    $result = $q->fetchAll(PDO::FETCH_OBJ);
                                    
                                    if($result){
                                        foreach($result as $item){
                                            ?>
                                            <tr>
                                                <td><?= $item->id ?></td>
                                                <td><?= $item->name ?></td>
                                                <td><?= $item->price ?></td>
                                                <td><?= $item->company ?></td>
                                                <td><?= $item->quantity ?></td>
                                                <td><?= $item->type ?></td>
                                                <td><?= $item->employee_name ?></td>
                                                <td><a href="<?= "../../". $item->path; ?>" class="edit">عرض</a></td>
                                                <td><a href="editProduct.php?id=<?= $item->id; ?>" class="edit">تعديل</a></td>
                                                <td><form action="../../PHP/products.php" method="POST">
                                                    <button type="submit" style="border:none; outline:none" class="delete" name="Delete" value="<?= $item->id; ?>" >حذف</button>
                                                </form></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../indexPanel.js"></script>
</body>
</html>