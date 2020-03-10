<?php $page = "BLOG DETAIL"; ?>

<?php include('inc/header.php'); ?>
<style>
    
</style>

<!-- BAGIAN ISI -->
<section>
    <section id="main-content" class="clearfix">
        <div class="container">
            <hr>
            <div id="blog-details">
                <?php
                $query = mysqli_query($connect, "SELECT * FROM blog WHERE id_blog = $_GET[id]");

                while ($data = mysqli_fetch_array($query)) {
                    echo "
                    <div id='blog-details'>
                        <h1>$data[judul]</h1>
                        
                        <p class='blog-date'>Tanggal: <span>" . date("d F Y", strtotime($data['tanggal'])) . "</span></p>
                        
                        <div id='blog-image'>
                            <img width='50%' src='admin/uploads/blog/$data[gambar]' alt='$data[judul]'>
                        </div>
                        
                        <p>$data[isi]</p>
                    </div>
                ";
                }
                ?>
                <div class="fb-comments" data-href="http://localhost/karisma_ecommerce/blog_detail.php?id=<?php echo $_GET['id']; ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
            </div>
        </div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=302332663189047&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </section>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>