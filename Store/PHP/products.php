<?php
    include("dbcon.php");
    session_start();
    if(!isset($_SESSION["id_employee"]) || $_SESSION["id_employee"] == null){
        header("Location: login.php");
        exit(0);
    }

    if($_SESSION["type"] == 1){
        $location = "Location: ../models/admin/products.php";
    } else {
        $location = "Location: ../models/user/products.php";
    }

    if(isset($_POST["Add"])){ 
        try{
            $position = "";
            if($_FILES["file"]["tmp_name"] != ""){
                if(isset($_POST["file"])){
                    unlink("../". $_POST["file"]);
                }
                $file_type = $_FILES["file"]["type"];
                $file_name = $_FILES["file"]["name"];
                $file = $_FILES["file"]["tmp_name"];
                
                move_uploaded_file($file, "../image/products/". $file_name);
                $position = "image/products/". $file_name ;
            } 
            $product = [
                // ":id" => $_POST["id"],
                ":name" => $_POST["name"],
                ":price" => $_POST["price"],
                ":company" => $_POST["company"],
                ":quantity" => $_POST["quantity"],
                ":details" => $_POST["details"],
                ":path" => $position,
                ":type" => $_POST["type"],
                ":id_employee" => $_SESSION["id_employee"]
            ];
            $sql = "INSERT INTO products VALUES (id, :name, :price, :company, :quantity, :details, :path, :id_employee, :type)";
            $q = $conn->prepare($sql);
            echo "<br>{$sql} <br>";
            $q->execute($product);
        
            if($q)
                $_SESSION["Message"] = "تم الإضافة";
            else
                $_SESSION["Message"] = "فشلت عملية الإضافة" ;
        
            header($location);
            exit(0);
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    if(isset($_POST["update-product"])){
        
            $product = [
                ":id" => $_POST["id"],
                ":name" => $_POST["name"],
                ":price" => $_POST["price"],
                ":company" => $_POST["company"],
                ":quantity" => $_POST["quantity"],
                ":details" => $_POST["details"],
                ":type" => $_POST["type"]
            ];
            if($_FILES["file"]["tmp_name"] != ""){
                if(isset($_POST["file"])){
                    unlink("../". $_POST["file"]);
                }
                $file_type = $_FILES["file"]["type"];
                $file_name = $_FILES["file"]["name"];
                $file = $_FILES["file"]["tmp_name"];
                
                move_uploaded_file($file, "../image/products/". $file_name);
                $position = "image/products/". $file_name ;
                $sql = "UPDATE products SET name=:name, price=:price, company=:company, details=:details, quantity=:quantity, type_id = :type, products.path = '{$position}' WHERE id = :id";
            } else {
                $sql = "UPDATE products SET name=:name, price=:price, company=:company, details=:details, quantity=:quantity, type_id = :type  WHERE id = :id";
            }
        try{
            $q = $conn->prepare($sql);
            $q->execute($product);
    
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
        $sql = $conn->prepare("DELETE FROM products WHERE id = {$_POST["Delete"]}");
        $sql->execute();
    
            if($sql)
                $_SESSION["Message"] = "تم الحذف";
            else
                $_SESSION["Message"] = "فشلت عملية الحذف" ;
    
                header($location);
                exit(0);
    }
    

?>
