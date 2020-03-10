<?php $page = "KERANJANG BELANJA"; ?>

<?php include('inc/header.php'); ?>

<!-- BAGIAN ISI -->
<section>
<section id="main-content" class="clearfix">
    <div class="container">
        
        <hr>
        
        <div id="shopping-cart">
    <h2>Keranjang Belanja</h2>

    <form action="cart.php?act=checkout" method="post">
        <table border="1">
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
                <?php
                    if(!empty($_SESSION['cart'])) {
                        $produk = join(',', array_keys($_SESSION['cart']));
                        $i = 0;
                        $total = 0;
                    
                        $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk IN ($produk)");
                        
                        while($data = mysqli_fetch_array($query)) {
                            $i++;
                            $jumlah_barang = $_SESSION['cart'][$data['id_produk']];
                            $subtotal = $jumlah_barang * $data['harga'];
                            
                            echo "
                                <tr>
                                    <td>$i</td>
                                    <td><a href='product_detail.php?id=$data[id_produk]'><img src='admin/uploads/product/$data[gambar]' alt='$data[judul]'>$data[judul]</a></td>
                                    <td>Rp. ".number_format($data['harga'], 0, ',', '.')."</td>
                                    <td>$jumlah_barang</td>
                                    <td>
                                        Rp. ".number_format($subtotal, 0, ',', '.')."
                                        <a href='cart.php?act=hapus&produk=$data[id_produk]'>
                                            <img src='img/remove.gif' class='remove' alt='Hapus'>
                                        </a>
                                    </td>
                                </tr>
                            ";
                            
                            $total = $total + $subtotal;
                        }
                        
                        echo "<tr class='total'>
                                <td colspan='5'>
                                    <span>Total: Rp. ".number_format($total, 2, ',', '.')."</span>
                                    <br>
                                    <a href='product.php' class='tertiary-btn'>KEMBALI BELANJA</a>
                                    <a href='cart.php?act=checkout' class='secondary-cart-btn'>LAKUKAN PEMBAYARAN</a>
                                </td>
                            </tr>
                        ";
                    } else {
                        echo "<tr class='total'>
                                <td colspan='5'>
                                    <span>Keranjang belanja Anda kosong</span>
                                </td>
                            </tr>
                        ";
                    }
                ?>
        </table>
    </form>
</div>
<?php
    // penambahan keranjang belanja
    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        if(isset($_GET['qty'])) {
            $qty = intval($_GET['qty']);
            $_SESSION['cart'][$id] = $qty;
        } else {
            if(!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = 1;
            } else {
                $_SESSION['cart'][$id] = $_SESSION['cart'][$id] += 1;
            }
        }
    } elseif(isset($_GET['act']) AND $_GET['act']=='hapus') {
        unset($_SESSION['cart'][$_GET['produk']]);
    }elseif(isset($_GET['act']) AND $_GET['act']=='checkout') {
        if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
            // mendapatkan id_member
            $query_member = mysqli_query($connect, "SELECT * FROM member WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
            $data_member = mysqli_fetch_array($query_member);
            
            // mendapatkan data produk
            $produk = join(',', array_keys($_SESSION['cart']));
            
            $harga = 0;
            $query_harga = mysqli_query($connect, "SELECT id_produk, harga FROM produk WHERE id_produk IN ($produk)");
            while($data_harga = mysqli_fetch_array($query_harga)){
                $harga = $harga + ($data_harga['harga'] * $_SESSION['cart'][$data_harga['id_produk']]);
            }
            
            $pesanan = mysqli_query($connect, "INSERT INTO pesanan (id_member, tanggal, harga, status)
                                    VALUES ('$data_member[id_member]', NOW(), '$harga', 2)");
            
            $id_pesanan = mysqli_query($connect, "SELECT LAST_INSERT_ID() INTO @pesanan");
            
            $detail_pesanan = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk IN ($produk)");
            while($data_pesanan = mysqli_fetch_array($detail_pesanan)) {
                $jumlah_barang = $_SESSION['cart'][$data_pesanan['id_produk']];
                mysqli_query($connect, "INSERT INTO pesanan_detail (id_pesanan, id_produk, jumlah)
                                VALUES (@pesanan, '$data_pesanan[id_produk]', '$jumlah_barang')");
            }
                                    
            if($pesanan){
                unset($_SESSION['cart']);
                echo "<h3 style='color: #f00;'>Data pesanan telah masuk. Silakan lakukan konfirmasi pembayaran.</h3>";
            } else {
                echo "<h3 style='color: #f00;'>Data pesanan gagal disimpan.";
            }
        } else {
            header('location:sign_in.php');
        }
    }
?>
    </div>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>