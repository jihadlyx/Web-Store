<?php 

    $sql = "SELECT * FROM type_product";
    $query = $conn->prepare($sql);
    $query->execute();
    $links = "";
    while($rows = $query->fetchAll(PDO::FETCH_OBJ)){
        foreach($rows as $row){
            $links .= "<li><a href='tab.php?id={$row->id}'>$row->name</a></li>";
        }
    }
     ?>
        <header>
            <div>
                <div class='content-box first'>
                    <div class='container'>
                        <ul>
                            <li><a href='#'><i class='fa-brands fa-facebook'></i></a></li>
                            <li><a href='#'><i class='fa-brands fa-twitter'></i></a></li>
                            <li><a href='#'><i class='fa-brands fa-instagram'></i></a></li>
                            <li><a href='#'><i class='fa-brands fa-whatsapp'></i></a></li>
                        </ul>
                    </div>
                </div>
                <div dir='ltr' class='content-box second'>
                    <div class='container'>
                        <div class='logo'>
                            <a href='index.php' style='display: block;' id='mainPage'></a>
                            <img src='../images/logo-1.png' alt='logo.png'>
                        </div>
                        <div class='search-box'>
                            <i class='fa-solid fa-magnifying-glass'></i>
                            <form method='POST' action='search.php'>
                                <input type='text' name='search' placeholder='بحث عن منتج'>
                            </form>
                        </div>
                        <nav dir='rtl'>
                            <i class='fa-solid fa-bars toggle-menu'></i>
                            <ul class='links'>
                                <li><a href='index.php'>الرئيسية</a></li>
                                <li><a href='shop.php'>المتجر</a></li>
                                <li><a href='#'>تواصل معنا</a></li>
                                <li><a href='login.php'><i class='fa-regular fa-user'></i></a></li>
                                <!-- <li><a href='#'><i class='fa-solid fa-cart-shopping'></i></a></li> -->
                            </ul>
                            <div>
                                <a ><i class='fa-solid fa-cart-shopping cart-shopping'></i></a>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class='content-box third'>
                    <div class='container'>
                        <nav>
                            <a href='#' class='menu-list'>قائمة</a>
                            <ul class='list-items'>
                                <li><a href='#' class='close'>إغلاق</a></li>
                                <?php
                                echo $links ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
