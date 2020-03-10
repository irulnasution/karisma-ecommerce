<?php $page = "MEMBER"; ?>
<?php include('inc/header.php'); ?>
<?php include('inc/sidebar.php'); ?>
<section class="main">
    HALAMAN MEMBER
    <h1>Manajemen Member</h1>

    <hr>
    <?php
    if (isset($_GET['act']) and $_GET['act'] == 'tambah') { ?>

        <h3>Tambah Data</h3>
        
        <form name='tambah' action='?act=proses_tambah' method='post'>
        <p><input type='text' name='nama_depan' placeholder='Nama Depan'></p>
        <p><input type='text' name='nama_belakang' placeholder='Nama Belakang'></p>
        <p><input type='text' name='alamat' placeholder='Alamat'></p>
        <p><input type='text' name='email' placeholder='Email'></p>
        <p><input type='password' name='password' placeholder='Password'></p>
        <p><input type='text' name='telepon' placeholder='Telepon'></p>
        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
        </form>
 
 <hr>
    <?php } elseif(isset($_GET['act']) AND $_GET['act']=='proses_tambah') {
        $tambah = mysqli_query($select, "INSERT INTO member (nama_depan, 
       nama_belakang, alamat, email, password, telepon)
        VALUES ('$_POST[nama_depan]', 
       '$_POST[nama_belakang]', '$_POST[alamat]', '$_POST[email]', 
       '$_POST[password]', '$_POST[telepon]')");
        
        if($tambah) {
        echo "Data berhasil ditambahkan!";
        } else {
        echo "Data gagal ditambahkan!";
        }
        
        echo "<hr>";
    } elseif(isset($_GET['act']) AND $_GET['act']=='edit') {
        $isi = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM member WHERE 
       id_member = '$_GET[id]'")); ?>
        
        <h3>Edit Data</h3>
        
        <form name='edit' action='?act=proses_edit' method='post'>
            <input type='hidden' name='id' value='$isi[id_member]'>
            <p><input type='text' name='nama_depan' value='<?php echo $isi['nama_depan'] ?>' placeholder='Nama Depan'></p>
            <p><input type='text' name='nama_belakang' value='<?php echo $isi['nama_belakang'] ?>' placeholder='Nama Belakang'></p>
            <p><input type='text' name='alamat' value='<?php echo $isi['alamat'] ?>' placeholder='Alamat'></p>
            <p><input type='text' name='email' value='<?php echo $isi['email'] ?>' placeholder='Email'></p>
            <p><input type='password' name='password' value='<?php echo $isi['password'] ?>' placeholder='Password'></p>
            <p><input type='text' name='telepon' value='<?php echo $isi['telepon'] ?>' placeholder='Telepon'></p>
            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
        </form>
        
        <hr>
    <?php } elseif(isset($_GET['act']) AND $_GET['act']=='proses_edit') {
        $edit = mysqli_query($connect, "UPDATE member SET nama_depan = 
       '$_POST[nama_depan]', nama_belakang = '$_POST[nama_belakang]', 
       alamat = '$_POST[alamat]',email = '$_POST[email]', password = '$_POST[password]', 
       telepon = '$_POST[telepon]' WHERE id_member = '$_POST[id]'");
        
        if($edit) {
        echo "Data berhasil diperbaharui!";
        } else {
        echo "Data gagal diperbaharui!";
        }
        
        echo "<hr>";
    } elseif(isset($_GET['act']) AND $_GET['act']=='hapus') {
        $hapus = mysqli_query($select, "DELETE FROM member
        WHERE id_member = '$_GET[id]'");
        
        if($hapus) {
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
                <th>Alamat</th>
                <th>Email</th>
                <th>Password
                </th>
                <th>Telepon</th>
                <th width="15%">Aksi</th>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($connect, "SELECT * FROM member");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?php echo $data['id_member'] ?></td>
                    <td><?php echo $data['nama_depan']; $data['nama_belakang'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['email'] ?></td>
                    <td><?php echo $data['password'] ?></td>
                    <td><?php echo $data['telepon'] ?></td>
                    <td>
                    <a href='?act=edit&id=<?php echo $data['id_member']?>'>
                    <button type='button' class='btn kuning'>Edit</button>
                    </a>
                    <a href='?act=hapus&id=<?php echo $data['id_member']?>' OnClick="return confirm('Anda yakin menghapus data?');")>
                    <button type='button' class='btn merah'>Hapus</button>
                    </a>
                    </td>
                </tr>
            <?php    }
            } else {
                echo "
                <tr>
                    <td colspan='7'>Tidak ada data.</td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>

</section>
<?php include('inc/footer.php'); ?>