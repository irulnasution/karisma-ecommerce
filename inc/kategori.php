<?php include "admin/inc/config.php" ?>
<aside id="categories-menu">
    <h3>Kategori</h3>
    <ul>
    <?php
            $query = mysqli_query($connect, "select * from kategori");
            
            while($data = mysqli_fetch_array($query)) {
                echo "<li><a href='product.php?kategori=$data[id_kategori]'>$data[kategori]</a></li>";
            }
        ?>
    </ul>
</aside>