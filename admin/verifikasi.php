<?php

session_start();
 
 if(isset($_SESSION['nama']) AND isset($_SESSION['password'])){
 header('location:index.php');
 }

include ("inc/config.php");

$nama = $_POST['nama'];
$password = $_POST['password'];

// $nama = mysqli::escape_string($nama);
// $password = mysqli::escape_string($password);

$nama = mysqli_real_escape_string($connect, $nama);
$password = mysqli_real_escape_string($connect, $password);

$query = mysqli_query($connect, "SELECT * FROM user WHERE nama = '$nama' AND password = '$password'");

if(mysqli_num_rows($query) == 1) {
   session_start();

   $_SESSION['nama'] = $nama;
   $_SESSION['password'] = $password;

   header("location:index.php");
    } else {
        header("location:login.php"); 
    } 
?>