<?php $page = "USER"; ?>
<?php include('inc/header.php'); ?>
HALAMAN USER
<?php include('inc/sidebar.php'); ?>
<section class="main">
    <h1>Manajemen User</h1>

    <hr>
    <?php
    if (isset($_GET['act']) and $_GET['act'] == 'tambah') {
        echo "
 <h3>Tambah Data</h3>
 
 <form name='tambah' action='?act=proses_tambah' 
method='post'>
 <p><input type='text' name='nama' 
placeholder='Nama'></p>
 <p><input type='password' name='password' 
placeholder='Password'></p>
 <p><input type='submit' name='proses' value='Simpan' 
class='btn biru'></p>
 </form>
 
 <hr>
 ";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'edit') {
        $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM user WHERE 
       id_user = '$_GET[id]'"));

        echo "
        <h3>Edit Data</h3>
        
        <form name='edit' action='?act=proses_edit' method='post'>
        <input type='hidden' name='id' value='$isi[id_user]'>
        <p><input type='text' name='nama' value='$isi[nama]' 
       placeholder='Nama'></p>
        <p><input type='password' name='password' 
       value='$isi[password]' placeholder='Password'></p>
        <p><input type='submit' name='proses' value='Simpan' 
       class='btn biru'></p>
        </form>
        
        <hr>
        ";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'proses_edit') {
        $edit = mysqli_query($connect, "UPDATE user SET nama = '$_POST[nama]', 
       password = '$_POST[password]'
        WHERE id_user = '$_POST[id]'");

        if ($edit) {
            echo "Data berhasil diperbaharui!";
        } else {
            echo "Data gagal diperbaharui!";
        }

        echo "<hr>";
    } elseif (isset($_GET['act']) and $_GET['act'] == 'hapus') {
        $hapus = mysqli_query($connect, "DELETE FROM user
        WHERE id_user = '$_GET[id]'");

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
    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Password</th>
                <th>Aksi</th>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM user");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
                    echo "
 <tr>
 <td>$data[id_user]</td>
<td>$data[nama]</td>
 <td>$data[password]</td>
<td>
 <a 
href='?act=edit&id=$data[id_user]'>
 <button type='button' class='btn 
kuning'>Edit</button>
 </a>
<a 
href='?act=hapus&id=$data[id_user]' OnClick=\"return confirm('Anda 
yakin menghapus data?');\")>
 <button type='button' class='btn 
merah'>Hapus</button>
 </a>
 </td>
 </tr>
 ";
                }
            } else {
                echo "
 <tr>
 <td colspan='4'>Tidak ada data.</td>
 </tr>
 ";
            }
            ?>
        </tbody>
    </table>

</section>
<?php include('inc/footer.php'); ?>