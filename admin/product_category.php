<?php $page = "KATEGORI PRODUK"; ?>
<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>

<section class="main">
    <h1>Manajemen Kategori Produk</h1>

    <hr>
    <?php
    if (isset($_GET['act']) AND $_GET['act'] == 'tambah') {
    ?>
    <h3>Tambah Data</h3>

    <form name='tambah' action='?act=proses_tambah' method='post'>
        <p><input type='text' name='kategori' placeholder='Kategori'></p>
        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
    </form>

    <hr>
    
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_tambah') { 
        $tambah = mysqli_query($connect, "INSERT INTO kategori (kategori)
            VALUES ('$_POST[kategori]')");

        if ($tambah) {
            echo "<script>            
                    alert('Data Berhasil ditambahkan');
                    window.location.href='product_category.php';
                </script>";
        } else {
            echo "Data gagal ditambahkan!";
        } ?>

        <hr>
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'edit') { 
        $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'"));
    ?>

        
        <h3>Edit Data</h3>
        
        <form name='edit' action='?act=proses_edit' method='post'>
        <input type='hidden' name='id' value='<?php echo $isi['id_kategori'] ?>'>
        <p><input type='text' name='kategori' value='<?php echo $isi['kategori'] ?>' placeholder='Kategori'></p>
        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
        </form>
        
        <hr>
        
    <?php } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_edit') {
        $kategori = $_POST['kategori'];
        $id = $_POST['id'];
        $edit = mysqli_query($connect, "UPDATE kategori SET kategori = '$kategori' WHERE id_kategori = '$id'");

        if ($edit) {
            echo "Data berhasil diperbaharui!";
        } else {
            echo "Data gagal diperbaharui!";
        }

        echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'hapus'){
        $hapus = mysqli_query($connect, "delete from kategori where id_kategori=$_GET[id]");
        if ($hapus) {
            echo "Data berhasil dihapus";
        } else {
            echo "Data gagal dihapus";
        }
    }
    ?>
    <a href="?act=tambah">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th width="15%">Aksi</th>
        </thead>
        <tbody>
            <?php
            // record dari tabel kategori
            $query = mysqli_query($connect, "SELECT * FROM kategori");
            if (mysqli_num_rows($query) > 0) {
                // ada record
                while ($data = mysqli_fetch_array($query)) { ?>
                   
                    <tr>
                        <td><?php echo $data['id_kategori']; ?></td>
                        <td><?php echo $data['kategori']; ?></td>
                        <td>
                            <a href='?act=edit&id=<?php echo $data['id_kategori']?>'>
                            <button type='button' class='btn kuning'>Edit</button>
                            </a>
                            <a href='?act=hapus&id=<?php echo $data['id_kategori']?>' 
                            OnClick="return confirm('Anda yakin menghapus data?');">
                            <button type='button' class='btn merah'>Hapus</button>
                            </a>
                        </td>
                    </tr>
                    
               <?php }
            } else {
                // tidak ada record
                echo "
                <tr>
                <td colspan='3'>Tidak ada data.</td>
                </tr>";
            }

            ?>
        </tbody>
    </table>

</section>
<?php include('inc/footer.php'); ?>