<?php
    include("dbcon.php");
    session_start();
    if(!isset($_SESSION["id_employee"]) || 
    $_SESSION["id_employee"] == null || $_SESSION["type"] > 1){
        header("Location: ../../login.php");
        exit(0);
    }

    if($_SESSION["type"] == 1){
        $location = "Location: ../models/admin/type_product.php";
    } else {
        $location = "Location: ../models/user/employees.php";
    }

    if(isset($_POST["Add"])){ 
        $types = [
            ":name" => $_POST["name"]
        ];

        $q = $conn->prepare("INSERT INTO `type_product` VALUES (id, :name)");
        $q->execute($types);

        if($q)
            $_SESSION["Message"] = "تم الإضافة";
        else
            $_SESSION["Message"] = "فشلت عملية الإضافة" ;

        header($location);
            exit(0);
    }

    if(isset($_POST["Update"])){ 
        $types = [
            ":id" => $_POST["id"],
            ":name" => $_POST["name"]
        ];
        $q = $conn->prepare("UPDATE type_product SET name = :name WHERE id = :id");
        $q->execute($types);

        if($q)
            $_SESSION["Message"] = "تم التحديث";
        else
            $_SESSION["Message"] = "فشلت عملية التحديث" ;

        header($location);
            exit(0);
    }

    if(isset($_POST["Delete"])){
        $sql = $conn->prepare("DELETE FROM type_product WHERE id = {$_POST["Delete"]}");
        $sql->execute();

        if($sql)
            $_SESSION["Message"] = "تم الحذف";
        else
            $_SESSION["Message"] = "فشلت عملية الحذف" ;
            
        header($location);
        exit(0);
    }
?>