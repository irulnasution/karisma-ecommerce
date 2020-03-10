<?php $page = "PESANAN"; ?>
<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<section class="main">
    <h1>Manajemen Pesanan</h1>

    <hr>
    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pemesan</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Status</th>
                <th width="15%">Aksi</th>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM pesanan, member ORDER BY id_pesanan DESC");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    $member = mysqli_fetch_array(mysqli_query($connect, "SELECT nama_depan, nama_belakang, alamat 
                    FROM member WHERE id_member = '$data[id_member]'"));

                    if ($data['status'] == 1) {
                        $status = "<span style='color:green'>Finalized</span>";
                    } elseif ($data['status'] == 2) {
                        $status = "<span style='color:orange'>Pending</span>";
                    } else {
                        $status = "<span style='color:red'>Aborted</span>";
                    } ?>
                        <tr>
                            <td><?php echo $data['id_pesanan'] ?></td>
                            <td><?php echo $data['nama_depan'] ?></td>
                            <td><?php echo $data['alamat'] ?></td>
                            <td><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['harga'] ?></td>
                            <td><?php echo $status ?></td>
                            <td>
                                <a href='?act=finalized&id=<?php echo $data['id_pesanan']?>'>
                                <button type='button' class='btn hijau'>F</button>
                                </a>
                                <a href='?act=pending&id=<?php echo $data['id_pesanan']?>'>
                                <button type='button' class='btn kuning'>P</button>
                                </a>
                                <a 
                                href='?act=aborted&id=<?php echo $data['id_pesanan']?>'>
                                <button type='button' class='btn merah'>A</button>
                                </a>
                            </td>
                        </tr>
              <?php  }
            } else {
                echo "
                    <tr>
                        <td colspan='7'>Tidak ada data.</td>
                    </tr>
                    ";
            }
            ?>
        </tbody>
        <?php
        if (isset($_GET['act']) and $_GET['act'] == 'finalized') {
            $status = mysqli_query($connect, "UPDATE pesanan SET status = 1 WHERE id_pesanan = '$_GET[id]'");

            if ($status) {
                echo "Data berhasil disimpan!";
            } else {
                echo "Data gagal disimpan!";
            }

            echo "<hr>";
        } elseif (isset($_GET['act']) and $_GET['act'] == 'pending') {
            $status = mysqli_query($connect, "UPDATE pesanan SET status = 2 WHERE id_pesanan = '$_GET[id]'");

            if ($status) {
                echo "Data berhasil disimpan!";
            } else {
                echo "Data gagal disimpan!";
            }

            echo "<hr>";
        } elseif (isset($_GET['act']) and $_GET['act'] == 'aborted') {
            $status = mysqli_query($connect, "UPDATE pesanan SET status = 3 WHERE id_pesanan = '$_GET[id]'");

            if ($status) {
                echo "Data berhasil disimpan!";
            } else {
                echo "Data gagal disimpan!";
            }

            echo "<hr>";
        }
        ?>
    </table>
</section>
<?php include('inc/footer.php'); ?> 