<?php $page = "SIGN UP"; ?>

<?php include('inc/header.php'); ?>
<?php
    if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
        header('location:account.php');
    }
?>

<!-- BAGIAN ISI -->
<section>
<section id="main-content">
    <div class="container">
        
        <hr>
        
        <div id="new-account">
            <h1>Buat Akun Baru</h1>

            <form action="sign_up.php?act=sign_up" method="post">
                <p>
                    <label for="firstname">
                        <span class="required-field">*</span> NAMA DEPAN:
                    </label>
                    <input type="text" id="firstname" name="firstname" required>
                </p>
                <p>
                    <label for="lastname">
                        <span class="required-field">*</span> NAMA BELAKANG:
                    </label>
                    <input type="text" id="lastname" name="lastname" required>
                </p>
                <p>
                    <label for="lastname">
                        <span class="required-field">*</span> ALAMAT:
                    </label>
                    <input type="text" id="address" name="address" required>
                </p>
                <p>
                    <label for="email">
                        <span class="required-field">*</span> EMAIL:
                    </label>
                    <input type="email" id="email" name="email" required>
                </p>
                <p>
                    <label for="password">
                        <span class="required-field">*</span> PASSWORD:
                    </label>
                    <input type="password" id="password" name="password" required>
                </p>
                <p>
                    <label for="password_confirmation">
                        <span class="required-field">*</span> KONFIRMASI PASSWORD:
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </p>
                <p>
                    <label for="telephone">
                        <span class="required-field">*</span> TELEPON:
                    </label>
                    <input type="text" id="telephone" name="telephone" required>
                </p>

                <p><span class="required-field">*</span> wajib diisi.</p>

                <hr>

                <input type="submit" value="BUAT AKUN" class="secondary-cart-btn">
                <?php
    if(isset($_GET['act']) AND $_GET['act']=='sign_up') {  


        if($_POST['password'] == $_POST['password_confirmation']){
            $tambah = mysqli_query($connect, "INSERT INTO member (nama_depan, nama_belakang, alamat, email, password, telepon)
                                    VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[address]', '$_POST[email]',
                                    '$_POST[password]', '$_POST[telephone]')");
                                    echo $tambah; 
                                    die();
            
            if($tambah) {
                echo "<h4>Data berhasil disimpan.</h4>";
            } else {
                echo "<h4>Data gagal disimpan.</h4>";
            }
        } else {
            echo "<h4>Password harus sama!</h4>";
        }
    }
?>
            </form>
        </div>
    </div>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>