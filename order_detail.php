<?php $page = "DETAIL PESANAN"; ?>

<?php include('inc/header.php'); ?>
<?php
    if(!isset($_SESSION['email']) AND !isset($_SESSION['password'])){
        header('location:sign_in.php');
    }
?>

<!-- BAGIAN ISI -->
<section>
<section id="main-content">
    <div class="container">
        <hr>
        
        <h2>Pembelian Produk</h2>

        <hr>

        <?php include ('inc/kategori.php'); ?>

        <div id="order-details">
            <?php
                // mendapatkan id_member
                $query = mysqli_query($connect, "SELECT * FROM member WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
                $data = mysqli_fetch_array($query);
                
                //data pesanan
                $order = mysqli_query($connect, "SELECT * FROM pesanan WHERE id_pesanan = '$_GET[id]'");
                $hasil = mysqli_fetch_array($order);
            ?>
        
            <h1>Detail Pemesanan</h1>
            <h2>Order #<?php echo $hasil['id_pesanan']; ?></h2>
            <p>Tanggal: <?php echo date("d/m/Y", strtotime($hasil['tanggal'])); ?></p>
            
            <h2>Informasi Pembeli</h2>
            <p>
                Nama: <?php echo $data['nama_depan']." ".$data['nama_belakang']; ?><br>
                Telepon: <?php echo $data['telepon']; ?><br>
                Email: <?php echo $data['email']; ?>
            </p>
            
            <h2>Produk</h2>
            
            <table border="1">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <?php
                    $i = 0;
                    $subtotal = 0;
                    $total = 0;
                    $detail = mysqli_query($connect, "SELECT * FROM pesanan_detail WHERE id_pesanan = '$_GET[id]'");
                    while($list = mysqli_fetch_array($detail)){
                        $i++;
                        
                        $produk = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '$list[id_produk]'");
                        $hasil_produk = mysqli_fetch_array($produk);
                        
                        $subtotal = $hasil_produk['harga'] * $list['jumlah'];
                        
                        echo "
                            <tr>
                                <td>$i</td>
                                <td>$hasil_produk[judul]</td>
                                <td>Rp. ".number_format($hasil_produk['harga'], 0, ',', '.')."</td>
                                <td>$list[jumlah]</td>
                                <td>Rp. ".number_format($subtotal, 0, ',', '.')."</td>
                            </tr>
                        ";
                        
                        $total = $total + $subtotal;
                    }
                ?>
                <tr class="total">
                    <td colspan="5">
                        Subtotal: <?php echo "Rp. ".number_format($total, 0, ',', '.'); ?> <br />
                        <span>TOTAL: <?php echo "Rp. ".number_format($total, 0, ',', '.'); ?></span>
                    </td>
                </tr>
            </table>

            <a href="#" class="secondary-cart-btn" onclick="window.print();">CETAK</a>
        </div>
    </div>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>