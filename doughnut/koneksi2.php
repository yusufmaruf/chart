<?php
// Deklarasi variabel untuk nama server, username, password, dan database
$servername	="localhost";
$username	="root";
$password	="";
$database	="db_covid19";

// Perintah PHP untuk akses ke database
$koneksi=mysqli_connect($servername, $username, $password, $database);
?>