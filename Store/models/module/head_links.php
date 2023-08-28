<?php
    // session_start();
    if(isset($_SESSION["id_employee"]) && isset($_SESSION["type"])){
        if($_SESSION["type"] == 1){
            ?><ul>
                    <li ><a href="../../Pages/index.php">
                        <i class="fa-regular fa-chart-bar fa-fw"></i>
                        <span>المتجر</span>
                    </a></li>
                    <li><a href="../admin/employees.php">
                        <i class="fa-regular fa-user fa-fw"></i>
                        <span>الموظفين</span>
                    </a></li>
                    <li><a href="../admin/products.php">
                        <i class="fa-brands fa-product-hunt fa-fw"></i>
                        <span>المنتجات</span>
                    </a></li>
                    <li><a href="../admin/type_product.php">
                        <i class="fa-solid fa-box-open"></i>
                        <span>الأصناف</span>
                    </a></li>
                    <li><a class="active" href="profile.php">
                        <i class="fa-regular fa-circle-user fa-fw"></i>
                        <span>الحساب</span>
                    </a></li>
                    <li><a href="../../PHP/login.php?sign_out=1">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            <span>خروج</span>
                    </a></li>
                </ul> 
                <?php
                
            
        } else {
            ?>
                <ul>
                    <li ><a href="../../Pages/index.php">
                        <b ><i class="fa-brands fa-product-hunt fa-fw"></i>
                        <span>المتجر</span></b>
                    </a></li>
                    <li><a href="../user/products.php">
                        <i class="fa-brands fa-product-hunt fa-fw"></i>
                        <span>المنتجات</span>
                    </a></li>
                    <li><a class="active" href="profile.php">
                        <i class="fa-regular fa-circle-user fa-fw"></i>
                        <span>الحساب</span>
                    </a></li>
                    <li><a href="../../PHP/login.php?sign_out=1">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            <span>خروج</span>
                    </a></li>
                </ul> 
                <?php
        }
    }
?>