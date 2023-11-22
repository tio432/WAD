<?php 
// (1) Hapus cookie dengan key id 
setcookie('id', '', time() + 3600, '/');
// 

// (2) Mulai session
session_start();
//

// (3) Hapus semua session yang berlangsung
session_destroy();
//

// (4) Lakukan redirect ke halaman login awal
//
session_start();
$_SESSION["message"] = "Anda berhasil melakukan logout";
$_SESSION['color'] = "success";
$SESSION['from_logout'] = true;
header("Location: ../views/login.php");
exit;

?>