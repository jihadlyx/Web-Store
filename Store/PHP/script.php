<?php

    include("dbcon.php");
    session_start();
    if(!isset($_SESSION["id_employee"]) || $_SESSION["id_employee"] == null){
        header("Location: login.php");
        exit(0);
    }
    $location = "Location: ../models/admin/employees.php";
    if(isset($_POST["Add"])){ 
        if($_FILES["file"]["tmp_name"] != ""){
            $file_type = $_FILES["file"]["type"];
            $file_name = $_FILES["file"]["name"];
            $file = $_FILES["file"]["tmp_name"];
            move_uploaded_file($file, "../image/employees/". $file_name);
            $position = "image/employees/". $file_name;
        } else
            $position = "image/employees/avatar.png";
        
        $emp = [
            ":name" => escapeshellcmd($_POST["name"]),
            ":username" => strtoupper($_POST["username"]),
            ":email" => $_POST["email"],
            ":phone" => $_POST["phone"],
            ":password" => md5($_POST["password"]),
            ":type" => $_POST["type"],
            ":position" => $position
        ];

        $q = $conn->prepare("INSERT INTO `employees` VALUES (id, :name, :username, :email, :phone, :password, :type, :position)");
        $q->execute($emp);

        if($q)
            $_SESSION["Message"] = "تم الإضافة";
        else
            $_SESSION["Message"] = "فشلت عملية الإضافة" ;

        header($location);
            exit(0);
    }
    if(isset($_POST["Update"])){
        $emp = [
            ":id" => $_POST["id"],
            ":name" => escapeshellcmd($_POST["name"]),
            ":username" => strtoupper($_POST["username"]),
            ":email" => $_POST["email"],
            ":phone" => $_POST["phone"],
            ":password" => md5($_POST["password"]),
            ":type" => $_POST["type"]
        ];
        
        if($_FILES["file"]["tmp_name"] != ""){
            if(isset($_POST["file"])){
                unlink("../". $_POST["file"]);
            }
            $file_type = $_FILES["file"]["type"];
            $file_name = $_FILES["file"]["name"];
            $file = $_FILES["file"]["tmp_name"];
            
            move_uploaded_file($file, "../image/employees/". $file_name);
            $position = "image/employees/". $file_name ;
            $sql = "UPDATE employees SET name=:name, username=:username, email=:email, phone=:phone, password=:password,  type_id=:type, position = '{$position}' WHERE id = :id";
        } else {
            $sql = "UPDATE employees SET name=:name, username=:username, email=:email, phone=:phone, password=:password, type_id=:type WHERE id = :id";
        }
        try{
            $q = $conn->prepare($sql);
            $q->execute($emp);

            if($q)
                $_SESSION["Message"] = "تم التحديث";
            else
                $_SESSION["Message"] = "فشلت عملية التحديث";

            header($location);
                exit(0);
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    if(isset($_POST["Delete"])){
        if(isset($_SESSION["id_employee"])){
            if($_SESSION["id_employee"] != $_POST["Delete"]){
                $sql = $conn->prepare("DELETE FROM employees WHERE id = {$_POST["Delete"]}");
                $sql->execute();

                if($sql)
                    $_SESSION["Message"] = "تم الحذف";
                else
                    $_SESSION["Message"] = "فشلت عملية الحذف" ;
            } else{
                $_SESSION["Message"] = "لا يمكنك حذف نفسك";
            }
        }
        header($location);
        exit(0);
    }



?>