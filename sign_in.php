<?php $page = "SIGN IN"; ?>

<?php include('inc/header.php'); ?>
<?php
    if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
        header('location:account.php');
    }
?>

<!-- BAGIAN ISI -->
<section>
<section id="signin-form">
    <div class="container">
        <hr>
        <h1>Sign In</h1>
        <form action="sign_in.php?act=sign_in" method="post">
            <p>
                <img src="img/email.gif" alt="Email Address">
                <input type="email" name="email" placeholder="Email Address">
            </p>
            <p>
                <img src="img/password.gif" alt="Password">
                <input type="password" name="password" placeholder="password">
            </p>

            <button type="submit" class="secondary-cart-btn">SIGN IN</button>
            <?php
    if(isset($_GET['act']) AND $_GET['act']=='sign_in') {
        $query = mysqli_query($connect, "SELECT * FROM member WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
        
        if(mysqli_num_rows($query) == 1) {
            
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];

            header('location:account.php');
        } else {
            echo "<h1>Gagal login!</h1>";
        }
    }
?>
        </form>
    </div>
</section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>