<?php $page = "BERANDA"; ?>
<?php include('inc/header.php'); ?>

<!-- BAGIAN ISI -->
<section>
<section id="promo">
    <div class="container">
        <div id="promo-details">
            <h1>Penawaran Hari Ini</h1>
            <p>Lihat bagian produk kami <br>dengan harga diskon.</p>
            <a href="#" class="default-btn">Belanja Sekarang</a>
        </div>
        <img src="img/promo.png" alt="Promotional Ad">
    </div>
</section>
</section>
<section id="main-content">
    <div class="container">
        <h2>Produk Pilihan</h2>

        <hr>

        <div id="products">             
            <?php 
            $query = mysqli_query($connect, "select * from produk limit 0,4");
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['stok'] == 1) {
                        $stok = "<span class='instok'>Stok Tersedia</span";
                    } else {
                        $stok = "<span class='outofstock'>Stok Habis</span>";
                    } ?>
                        <div class="product">
                            <a href="product_detail.php?id=<?php $data['id_produk']?>">
                                <img src="admin/uploads/product/<?php echo $data['gambar'] ?>" alt=<?php echo $data['judul'] ?> class="future">
                            </a>
                            <h3>
                                <a href="product_detail.php?id=<?php $data['id_produk']?>"><?php echo $data['judul'] ?></a>
                            </h3>
                            <p><?php $data['deskripsi'] ?></p>
                            <p>
                            <a href='cart.php?id=$data[id_produk]' class='cart-btn'>
                                <span class='price'> <?php  echo "Rp. ".number_format($data['harga'])?></span>
                                <img src='img/white-cart.gif' alt='Add to Cart'>BELI
                            </a>
                            </p>
                        </div>
                        
                            
                        
                   <?php } ?>
                <?php } ?>
        </div>
    </div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>

