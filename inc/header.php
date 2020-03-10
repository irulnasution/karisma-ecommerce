<!DOCTYPE html>
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Karisma Academy">
    <meta name="description" content="Karisma Academy adalah toko online yang menjual berbagai macam alat elektronik.">
    <meta name="keyword" content="karisma academy, store, alat elektronik, toko online">
    <?php $page = "BERANDA"; ?>

    <title><?php echo $page . " - KARISMA ECOMMERCE" ?></title>

    <link rel="icon" href="img/favicon.ico">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    include "admin/inc/config.php";
    session_start();
    ?>
    <div id="wrapper">
        <header>
            <section id="top-area">
                <div class="container">
                    <p>Untuk pemesanan: 0341-299-5599 | Email kami: <a href="mailto:info@karismaacademy.com">info@karismaacademy.com</a></p>
                </div>
            </section>
            <section id="action-bar">
                <div class="container">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo.png"></a>
                    </div>

                    <div id="blog">
                        <a href="blog.php">Blog</a>
                    </div>

                    <nav class="dropdown">
                        <ul>
                            <li>
                                <a href="product.php">Produk <img src="img/down-arrow.gif" alt="Produk"></a>
                                <ul>
                                    <?php
                                    $query = mysqli_query($connect, "select * from kategori");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?> <li><a href="product.php?kategori=<?php $data['id_kategori'] ?>"><?php echo $data['kategori'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>

                    <div id="search-form">
                        <form action="search.php" method="get">
                            <input type="text" name="search" placeholder="Pencarian" class="search">
                            <input type="submit" value="Cari" class="search submit">
                        </form>
                    </div>

                    <div id="user-menu">
                        <nav id="signin" class="dropdown">
                            <ul>
                                <?php
                                if (isset($_SESSION['email']) and isset($_SESSION['password'])) {
                                ?>
                                    <li><a href="account.php"><img src="img/user-icon.gif" alt="Sign In" />
                                            <?php echo "Profil Saya" ?><img src="img/down-arrow.gif" alt="Produk"></a>
                                        <ul>
                                            <li><a href="account.php">Profil Saya</a></li>
                                            <li><a href="sign_out.php">Sign Out</a></li>
                                        </ul>

                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="sign_in.php"><img src="img/user-icon.gif" alt="Sign In" /> Sign In <img src="img/down-arrow.gif" alt="Sign In" /></a>
                                        <ul>
                                            <li><a href="sign_in.php">Sign In</a></li>
                                            <li><a href="sign_up.php">Sign Up</a></li>
                                        </ul>
                                    </li>

                                <?php } ?>

                            </ul>
                        </nav>
                    </div>

                    <div id="view-cart">
                        <a href="cart.php"><img src="img/blue-cart.gif" alt="View Cart">
                            (
                            <?php
                            if (empty($_SESSION['cart'])) {
                                echo "0";
                            } else {
                                echo array_sum($_SESSION['cart']);
                            }
                            ?>
                            )
                        </a>
                    </div>
                </div>
            </section>
        </header>