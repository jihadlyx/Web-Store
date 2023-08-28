<?php
    include("../PHP/dbcon.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <style>
        body{
            
            font-family: 'Noto Sans Arabic', sans-serif;
        }
        header{
            padding: 20px;
            border-bottom: 2px solid;
        }
        header .image{
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        header .image img{
            width: 150px;
            height: 150px;
            border-radius: 5%;
        }
        header .image .title{
            font-size: 45px;
            font-weight: 600;
        }
        .info{
            display: flex;
            justify-content: space-around;
            margin: 20px 80px;
        }
        .info img{
            width: 100px;
            height: 100px;
        }
        .info div h1{
            margin-bottom: 15px;
            font-size: 20px;
            ;
        }
        .info div span{
            font-weight: 500;
            font-size: 18px;
        }
    </style>
</head>
<body dir="rtl">
    <header>
        <div class="image">
            <img src="../images/cropped-fav_icon-192x192.png" alt="logo">
            <div class="title">
                Gizmo Store
            </div>
        </div>
        
    </header>
    <div class="info">
        <?php
            if(isset($_GET["id"])){
                $q = $conn->prepare("SELECT employees.id, employees.name, username, email, phone, password, type.name AS type, type_id, position FROM employees JOIN type ON type_id = type.id WHERE employees.id = {$_GET["id"]}");
                $q->execute();
                $emp = $q->fetch(PDO::FETCH_OBJ);
            }
        ?>
        <div>
            <h1>الرقم : <span><?= $emp->id ?></span></h1>
            <h1>الاسم : <span><?= $emp->name ?></span></h1>
            <h1>الصفة : <span><?= "موظف" ?></span></h1>
            <h1>اسم المستخدم : <span><?= $emp->username ?></span></h1>
            <h1>البريد : <span><?= $emp->email ?></span></h1>
            <h1>الهاتف : <span><?= $emp->phone ?></span></h1>
            <h1>النوع : <span><?= $emp->type ?></span></h1>
            
        </div>
        <img src="../<?= $emp->position ?>" alt="">
        
    </div>
    <script>
        document.body.onload = () => {
            window.print();
        }
    </script>
</body>
</html>