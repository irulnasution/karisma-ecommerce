<section class="sidebar text-center">
    <div class="avatar">
        header.php
        BAGIAN ISI
        footer.php
        sidebar.php
        <a href="index.php">
            <img src="img/user.png" alt="Profil">
        </a>
    </div>

    <h1>Hai, <?php echo $_SESSION['nama']; ?></h1>

    <hr>

    <p><?php echo date('l, d F Y'); ?></p>

    <hr>

    <ul class="menu">
        <li><a href="product.php">Produk</a></li>
        <li><a href="product_category.php">Kategori Produk</a></li>
        <li><a href="order.php">Pesanan</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="member.php">Member</a></li>
        <li><a href="user.php">User</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</section>