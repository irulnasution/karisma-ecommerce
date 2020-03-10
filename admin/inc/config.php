<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "karisma_ecommerce";

$connect = mysqli_connect($host, $user, $pass) or die ("
Koneksi database gagal");

$select_db = mysqli_select_db($connect, $db) or die ("
Database tidak ditemukan");



?>