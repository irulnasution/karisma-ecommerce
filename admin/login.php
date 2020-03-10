<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>LOGIN ADMIN</title>
    <link rel="icon" href="img/favicon.ico">
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <section class="main">
        <h1>Silakan masukkan nama dan password Anda:</h1>

        <hr class="separator">

        <form name="login" action="verifikasi.php" method="post">
            <p><input type="text" name="nama" placeholder="Nama"></p>
            <p><input type="password" name="password" placeholder="Password"></p>
            <p><input type="submit" name="login" value="Login" class="btn hijau"></p>
        </form>
    </section>