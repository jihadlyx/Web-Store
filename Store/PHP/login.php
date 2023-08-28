<?php
    include("dbcon.php");
    session_start();
    
    if(isset($_POST["login"])){
        $user = $_POST["username"];
        $pass = $_POST["password"];

        $sql = "SELECT `id`, `username`, `email`, `password`, type_id AS type FROM employees WHERE (username = '". strtoupper($user) ."' OR email = '$user') AND password = '". $pass ."'";
        $q = $conn->prepare($sql);
        $q->execute();
        $emp = $q->fetch(PDO::FETCH_OBJ);
        if($q->rowCount() > 0){
            $id = $emp->id;
            $_SESSION["id_employee"] = $id;
            $type = $emp->type;
            $_SESSION["type"] = $type;
            if($type == 1){
                $location = "Location: ../models/admin/employees.php";
            } else 
                $location = "Location: ../models/user/products.php";
            
            // Save Login
            if($_POST["remember"]){
                $data = array("user" => $user,"password" => $pass);
                setcookie("user", $user, time() + 60 * 60 * 24 * 30, "/");
                setcookie("password", $pass, time() + 60 * 60 * 24 * 30, "/");
            }
            header($location);
            exit(0);
        } else{
            $_SESSION["error_login"] = "البريد او كلمة المرور غير صحيحة";
            header("Location: ../Pages/login.php");
            exit(0);
        }
    }

    if(isset($_GET["sign_out"])){
        session_unset();
        session_destroy();
        header("Location: ../Pages/login.php");
        exit(0);
    }







?>