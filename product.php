<?php $page = "PRODUK"; ?>

<?php include('inc/header.php'); ?>

<!-- BAGIAN ISI -->
<section>
    <section id="promo-alt">
        <div class="container">
            <div id="promo1">
                <h1>The brand new MacBook Pro</h1>
                <p>With a special price, <span class="bold">today only!</span></p>
                <a href="product.php" class="secondary-btn">READ MORE</a>
                <img src="img/macbook.png" alt="MacBook Pro">
            </div>
            <div id="promo2">
                <h2>The iPhone 5 is now<br>available in our store!</h2>
                <a href="product.php">Read more <img src="img/right-arrow.gif" alt="Read more"></a>
                <img src="img/iphone.png" alt="iPhone">
            </div>
            <div id="promo3">
                <img src="img/thunderbolt.png" alt="Thunderbolt">
                <h2>The 27"<br>Thunderbolt Display.<br>Simply Stunning.</h2>
                <a href="product.php">Read more <img src="img/right-arrow.gif" alt="Read more" /></a>
            </div>
        </div>
    </section>
    <section id="main-content" class="clearfix">
        <div class="container">
            <h2>Produk</h2>

            <hr>

            <?php include('inc/kategori.php'); ?>


            <div id="listings">
                <?php
                $start = 0;
                $limit = 6;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $start = ($page - 1) * $limit;
                }

                if (!isset($_GET['kategori'])) {
                    $query = mysqli_query($connect, "SELECT * FROM produk LIMIT $start, $limit");
                } else {
                    $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_kategori = '$_GET[kategori]' LIMIT $start, $limit");
                }

                while ($data = mysqli_fetch_array($query)) {
                    
                    if ($data['stok'] == 1) {
                        $stok = "<span class='instock'>Stok Tersedia</span>";
                    } else {
                        $stok = "<span class='outofstock'>Stok Habis</span>";
                    }

                    echo "
                <div class='product'>
                    <a href='product_detail.php?id=$data[id_produk]'><img src='admin/uploads/product/$data[gambar]' alt='$data[judul]' class='feature'></a>

                    <h3><a href='product_detail.php?id=$data[id_produk]'>$data[judul]</a></h3>

                    <p>$data[deskripsi]</p>

                    <h5>Ketersediaan: $stok</h5>

                    <p>
                        <a href='cart.php?id=$data[id_produk]' class='cart-btn'>
                            <span class='price'>Rp. " . number_format($data['harga'], 0, ',', '.') . "</span>
                            <img src='img/white-cart.gif' alt='Add to Cart'>BELI
                        </a>
                    </p>
                </div>
            ";
                }
                ?>
            </div>
           
        </div>
    </section>
    <section id="pagination">
    <p>
        <?php
            if(!isset($_GET['kategori'] )) {
                $query = mysqli_query($connect, "SELECT * FROM produk");
            } else {
                $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_kategori = '$_GET[kategori]'");
            }
        
            $rows=mysqli_num_rows($query);
            $total=ceil($rows/$limit);
            
            echo "Halaman: ";
            
            for($i=1;$i<=$total;$i++) {
                if($i == $page OR (!isset($_GET['page']) AND $i == 1)) {
                    echo "<span class='current'>$i</span>";
                } else {
                    if(!isset($_GET['kategori'])) {
                        echo "<a href='product.php?page=$i'>$i</a>";
                    } else {
                        echo "<a href='product.php?kategori=$_GET[kategori]&page=$i'>$i</a>";
                    }
                }
                
                if($i != $total) {
                    echo " / ";
                }
            }
        ?>
    </p>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>