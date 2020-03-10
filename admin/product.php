<?php $page = "PRODUK"; ?>
<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<section class="main">
    <h1>Manajemen Produk</h1>

    <hr>
    <table class="tabel">
        <thead>

            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok
                </th>
                <th>Kategori</th>
                <th width="15%">Aksi</th>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM produk");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    if ($data['stok'] == 0) {
                        $stok = "Kosong";
                    } else {
                        $stok = "Ada";
                    } ?>                    
                    <tr>
                        <td><?php echo $data['id_produk']?></td>
                        <td><?php echo $data['judul']?></td>
                        <td><?php echo $data['deskripsi']?></td>
                        <td><?php echo $data['harga']?></td>
                        <td><?php echo $stok ?></td>
                        <td><?php echo $data['id_kategori']?></td>
                        <td>
                        <a 
                        href='?act=edit&id=<?php echo $data['id_produk']?>'>
                        <button type='button' class='btn kuning'>Edit</button>
                        </a>
                        <a 
                        href='?act=hapus&id=<?php echo $data['id_produk']?>' OnClick="return confirm('Anda yakin menghapus data?');")>
                        <button type='button' class='btn merah'>Hapus</button>
                        </a>
                        </td>
                    </tr>
                    
                    <?php }
                    } else {
                                    echo "
                        <tr>
                        <td colspan='7'>Tidak ada data.</td>
                        </tr>";
                        
                    }
                    ?>
                    </tbody>
        </table>
    <?php
    if (isset($_GET['act']) and $_GET['act'] == 'tambah') { ?>
        
    <h3>Tambah Data</h3>

    <form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
        <p><input type='text' name='judul' placeholder='Judul'></p>
        <p><input type='text' name='deskripsi' placeholder='Deskripsi'></p>
        <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'></textarea></p>
        <p><input type='text' name='harga' placeholder='Harga'></p>
        <p>
            Kategori:             
            <select name='id_kategori'>
                
            <?php $kategori = mysqli_query($connect, "SELECT * FROM kategori");
            while ($opsi = mysqli_fetch_array($kategori)) { ?>
                <option value='<?php echo $opsi['id_kategori'] ?>'><?php echo $opsi['kategori']?></option>";
            <?php } ?>
            
            </select>
        </p>
        <p>Stok: <input type='radio' name='stok' value='1'>Ada <input type='radio' name='stok' value='0'>Kosong</p>
        <p><input type='file' name='gambar'></p>
        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
    </form>

    <hr>
    
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_tambah') {
        if ($_FILES['gambar']['error'] != 0) {
            $tambah = mysqli_query($connect, "INSERT INTO produk (judul, deskripsi, 
       isi, harga, stok, tanggal, id_kategori) VALUES ('$_POST[judul]','$_POST[deskripsi]', '$_POST[isi]', '$_POST[harga]', '$_POST[stok]', 
       NOW(), '$_POST[id_kategori]')");
        } else {
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];

            $destination = 'uploads/product/' . $filename;

            if (move_uploaded_file($tmp_file, $destination)) {
                $gambar = $filename;
            }

            $tambah = mysqli_query($connect, "INSERT INTO produk (judul, deskripsi, 
       isi, harga, stok, tanggal, gambar, id_kategori) VALUES ('$_POST[judul]', 
       '$_POST[deskripsi]', '$_POST[isi]', '$_POST[harga]', '$_POST[stok]', NOW(),
        '$gambar','$_POST[id_kategori]')"); }

        if ($tambah) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Data gagal ditambahkan!";
        }

        echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'edit') {
        $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'"));

        if ($isi['stok'] == 1) {
            $ada = 'checked';
            $kosong = '';
        } else {
            $ada = '';
            $kosong = 'checked';
        } ?>

        
        <h3>Edit Data</h3>
        
        <form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='id' value='<?php $isi['id_produk']?>'>
            <p><input type='text' name='judul' value='<?php $isi['judul']?>' placeholder='Judul'></p>
            <p><input type='text' name='deskripsi' value='<?php $isi['deskripsi']?>' placeholder='Deskripsi'></p>
            <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'><?php $isi['isi']?></textarea></p>
            <p><input type='text' name='harga' value='<?php $isi['harga']?>' placeholder='Harga'></p>
            <p> Kategori: 
                <select name='id_kategori'>
            
                    <?php $kategori = mysqli_query($connect, "SELECT * FROM kategori");
                    while ($opsi = mysqli_fetch_array($kategori)) { ?>
                        <option value='<?php echo $opsi['id_kategori']?>'><?php echo $opsi['kategori']?></option>";
                    <?php } ?>
                
                </select>
            </p>
            <p>Stok: <input type='radio' name='stok' value='1' $ada>Ada 
            <input type='radio' name='stok' value='0' $kosong>Kosong</p>
            <p><img src='uploads/product/<?php $isi['gambar'] ?>' alt='<?php $isi['judul']?>'><br> 
            <input type='file' name='gambar'></p>
            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
        </form>
        
        <hr>
        
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_edit') {
        if ($_FILES['gambar']['error'] != 0) {
            $edit = mysqli_query($connect, "UPDATE produk SET judul = '$_POST[judul]', deskripsi = '$_POST[deskripsi]', isi = 
            '$_POST[isi]', harga = '$_POST[harga]', stok = '$_POST[stok]', id_kategori = '$_POST[id_kategori]'
            WHERE id_produk = '$_POST[id]'");
        } else {
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];

            $destination = 'uploads/product/' . $filename;

            if (move_uploaded_file($tmp_file, $destination)) {
                $gambar = $filename;
            }

            $edit = mysqli_query($connect, "UPDATE produk SET judul = '$_POST[judul]', deskripsi = '$_POST[deskripsi]', isi = 
                    '$_POST[isi]', harga = '$_POST[harga]', stok = '$_POST[stok]', gambar = '$gambar', id_kategori = 
                    '$_POST[id_kategori]' WHERE id_produk = '$_POST[id]'");
            }

            if ($edit) {
                echo "Data berhasil diperbaharui!";
            } else {
                echo "Data gagal diperbaharui!";
            }

            echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'hapus') {
        $hapus = mysqli_query($connect, "DELETE FROM produk WHERE id_produk = '$_GET[id]'");
        if ($hapus) {
            echo "Data berhasil dihapus!";
        } else {
            echo "Data gagal dihapus!";
        }
        echo "<hr>";
    }
    ?>
    <a href="?act=tambah">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

</section>
<?php include('inc/footer.php'); ?>