<?php $page = "BLOG"; ?>
<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<section class="main">
    <h1>Manajemen Blog</h1>

    <hr>
    <table class="tabel">
        <thead>

            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th width="15%">Aksi</th>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM blog");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?php echo $data['id_blog'] ?></td>
                    <td><?php echo $data['judul'] ?></td>
                    <td><?php echo $data['deskripsi'] ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    
                    <td>
                        <a href='?act=edit&id=<?php echo $data['id_blog'] ?>'><button type='button' class='btn kuning'>Edit</button></a>
                        <a href='?act=hapus&id=<?php echo $data['id_blog'] ?>' OnClick= "return confirm ('Anda yakin menghapus data?')">
                        <button type='button' class='btn merah'>Hapus</button>
                        </a>
                    </td>
                </tr>
 
            <?php }
            } else { ?>
                
                <tr>
                    <td colspan='5'>Tidak ada data.</td>
                </tr>
           <?php } ?>
        </tbody>
    </table>
    <?php
    if (isset($_GET['act']) and $_GET['act'] == 'tambah') { ?>
            <h3>Tambah Data</h3>
            
            <form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
                <p><input type='text' name='judul' placeholder='Judul'></p>
                <p><input type='text' name='deskripsi' placeholder='Deskripsi'></p>
                <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'></textarea></p>
                <p><input type='file' name='gambar'></p>
                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
            </form>
            
            <hr>

        <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_tambah') {
        if ($_FILES['gambar']['error'] != 0) {
            $tambah = mysqli_query($connect, "INSERT INTO blog (judul, deskripsi, 
       isi, tanggal)
        VALUES ('$_POST[judul]', 
       '$_POST[deskripsi]', '$_POST[isi]', NOW())");
        } else {
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];

            $destination = 'uploads/blog/' . $filename;

            if (move_uploaded_file($tmp_file, $destination)) {
                $gambar = $filename;
            }

            $tambah = mysqli_query($connect, "INSERT INTO blog (judul, deskripsi, 
       isi, tanggal, gambar)
        VALUES ('$_POST[judul]', 
       '$_POST[deskripsi]', '$_POST[isi]', NOW(), '$gambar')");
        }

        if ($tambah) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Data gagal ditambahkan!";
        }

        echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'edit') {
        $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM blog WHERE 
       id_blog = '$_GET[id]'")); ?>

        <h3>Edit Data</h3>
        
        <form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
            <input type='hidden' name='id' value='<?php echo $isi['id_blog'] ?>'>
            <p><input type='text' name='judul' value='<?php echo $isi['judul'] ?>' placeholder='Judul'></p>
            <p><input type='text' name='deskripsi' value='<?php echo $isi['deskripsi'] ?>' placeholder='Deskripsi'></p>
            <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'><?php echo $isi['isi']?></textarea></p>
            <p><img src='uploads/blog/<?php echo $isi['gambar'] ?>' alt='<?php echo $isi['judul']?>'><br> 
            <input type='file' name='gambar'>
            </p>
            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
        </form>
        
        <hr>
    
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_edit') {
        if ($_FILES['gambar']['error'] != 0) {
            $edit = mysqli_query($connect, "UPDATE blog SET judul = '$_POST[judul]', 
       deskripsi = '$_POST[deskripsi]', isi = '$_POST[isi]'
        WHERE id_blog = '$_POST[id]'");
        } else {
            $tmp_file = $_FILES['gambar']['tmp_name'];
            $filename = $_FILES['gambar']['name'];
            $filetype = $_FILES['gambar']['type'];
            $filesize = $_FILES['gambar']['size'];

            $destination = 'uploads/blog/' . $filename;

            if (move_uploaded_file($tmp_file, $destination)) {
                $gambar = $filename;
            }

            $edit = mysqli_query($connect, "UPDATE blog SET judul = '$_POST[judul]',
       deskripsi = '$_POST[deskripsi]', isi = '$_POST[isi]', gambar = 
       '$gambar'
        WHERE id_blog = '$_POST[id]'");
        }

        if ($edit) {
            echo "Data berhasil diperbaharui!";
        } else {
            echo "Data gagal diperbaharui!";
        }

        echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'hapus') {
        $hapus = mysqli_query($connect, "DELETE FROM blog
        WHERE id_blog = '$_GET[id]'");

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
