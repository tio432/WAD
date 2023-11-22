<!-- File ini berisi koneksi dengan database MySQL -->
<?php 

// (1) Buatlah variable untuk connect ke database yang telah di import ke phpMyAdmin

$hostname = 'localhost:3308';
$username = 'root';
$password = '';
$db_name = 'modul4_wad';


// (2) Buatlah perkondisian untuk menampilkan pesan error ketika database gagal terkoneksi

$db = new mysqli($hostname,$username,$password,$db_name);

if($db->connect_error){
    die("Anda gagal untuk koneksi : " . $db->connect_error);
} 


 
?>