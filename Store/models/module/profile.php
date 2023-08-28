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
            <?php include("head_links.php"); ?>
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
            <h3 class="title-main">Profile</h3>
            <div class=" profile">
                <div class="box">
                <?php 
                    $sql = "SELECT employees.id, employees.name, username, email, phone, password, type.name AS type FROM employees JOIN type ON type_id = type.id WHERE employees.id = {$_SESSION["id_employee"]}";
                        $q = $conn->prepare($sql);
                        $q->execute();
                        $result = $q->fetch(PDO::FETCH_OBJ);
                    ?>
                    <div class="input-box">
                        <label for="">الاسم :</label>
                        <h3><?= $result->name; ?></h3>
                    </div>
                    <div class="input-box">
                        <label for="">اسم المستخدم :</label>
                        <h3><?= $result->username; ?></h3>
                    </div>
                    <div class="input-box">
                        <label for="">البريد الإلكتروني :</label>
                        <h3><?= $result->email; ?></h3>
                    </div>
                    <div class="input-box">
                        <label for="">رقم الهاتف :</label>
                        <h3><?= $result->phone; ?></h3>
                    </div>
                    <div class="input-box">
                        <label for="">كلمة السر :</label>
                        <h3></h3>
                    </div>
                    <div class="input-box">
                        <label for="">النوع :</label>
                        <h3><?= $result->type; ?></h3>
                    </div>
                    <div class="input-box">
                        <a href="profile.php" class="disabled">تعديل</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../indexPanel.js"></script>
</body>
</html>