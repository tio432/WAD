<?php

require 'connect.php';

// function untuk melakukan login
function login($input) {

    // (1) Panggil variabel global $db dari file config
    
    global $db;


    // (2) Ambil nilai input dari form login
        // a. Ambil nilai input email
        $email = $input['email'];
        
        // b. Ambil nilai input password
        $password = $input['password'];
        
    // 

    // (3) Buat dan lakukan query untuk mencari data dengan email yang sama
    // 
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db,$query);

    // (4) Buatlah perkondisian ketika email ditemukan ( gunakan mysqli_num_rows == 1 )
    if(mysqli_num_rows($result) == 1){

   

        // a. Simpan hasil query menjadi array asosiatif menggunakan fungsi mysqli_fetch_assoc
        
        // 
        $user = mysqli_fetch_assoc($result);
      

        // b. Lakukan verifikasi password menggunakan fungsi password_verify
        if(password_verify($password,$user['password'])){
          
           
            
            // c. Set variabel session dengan key login untuk menyimpan status login
            $_SESSION['login'] = true;
            // d. Set variabel session dengan key id untuk menyimpan id user
            
            //
            $_SESSION['id'] = $user['id'];

            // e. Buat kondisi untuk mengecek apakah checkbox "remember me" terisi kemudian set cookie dan isi dengan id
            
            // 
            if(isset($_COOKIE['id'])) {
                rememberMe($_COOKIE);
            }
            header("Location: ../views/home.php");
        }
        // f. Buat kondisi else dan isi dengan variabel session dengan key message untuk meanmpilkan pesan error ketika password tidak sesuai
        else{
            $_SESSION['message'] = 'Password yang dimasukkan salah!';
            $_SESSION['color'] = 'danger';
        }
        // 
    // 

    // (5) Buat kondisi else, kemudian di dalamnya
    //     Buat variabel session dengan key message untuk menampilkan pesan error ketika email tidak ditemukan
    
    // 
    }else{
        $_SESSION['message'] = 'Email yang anda masukkan tidak dapat ditemukan';
        $_SESSION['color'] = 'danger';
    }
}
// 

// function untuk fitur "Remember Me"
function rememberMe($cookie)
{
    // (6) Panggil variabel global $db dari file config
    
    // 
    global $db;

    // (7) Ambil nilai cookie yang ada
    
    // 
    $id = $cookie['id'];

    $query = "SELECT * FROM users WHERE id = '$id'";

    // (8) Buat dan lakukan query untuk mencari data dengan id yang sama
    
    // 
    $result = mysqli_query($db,$query);

    // (9) Buatlah perkondisian ketika id ditemukan ( gunakan mysqli_num_rows == 1 )
    if(mysqli_num_rows($result) == 1){

        // a. Simpan hasil query menjadi array asosiatif menggunakan fungsi mysqli_fetch_assoc
        $user  = mysqli_fetch_assoc($result);

        // b. Set variabel session dengan key login untuk menyimpan status login
        $_SESSION['login'] = true;
        // c. Set variabel session dengan key id untuk menyimpan id user
        $_SESSION['username'] = $user['username'];
    
    // 
    }
}
// 

?>