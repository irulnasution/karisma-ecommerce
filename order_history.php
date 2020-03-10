<?php $page = "DAFTAR PESANAN"; ?>

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

        <div id="order-history">
            <h1>Daftar Pesanan</h1>

            <table border="1">
                <tr>
                    <th>#</th>
                    <th>ID Pemesanan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
                <?php
                    // mendapatkan id_member
                    $query = mysqli_query($connect, "SELECT * FROM member WHERE email = '$_SESSION[email]' AND password = '$_SESSION[password]'");
                    $data = mysqli_fetch_array($query);
                    $id_member = $data['id_member'];
                    
                    //data pesanan
                    $i=0;
                    $order = mysqli_query($connect, "SELECT * FROM pesanan WHERE id_member = '$id_member' ORDER BY id_pesanan DESC");
                    while($hasil = mysqli_fetch_array($order)){
                        $i++;
                        
                        if($hasil['status'] == 1) {
                            $status = "<td class='finalized'>Finalized</td>";
                        } elseif($hasil['status'] == 2) {
                            $status = "<td class='pending'>Pending</td>";
                        } else {
                            $status = "<td class='aborted'>Aborted</td>";
                        }
                        
                        echo "
                            <tr>
                                <td>$i</td>
                                <td><a href='order_detail.php?id=$hasil[id_pesanan]'>$hasil[id_pesanan]</a></td>
                                <td>".date("d F Y", strtotime($hasil['tanggal']))."</td>
                                <td>Rp. ".number_format($hasil['harga'], 0, ',', '.')."</td>
                                $status
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </div>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>