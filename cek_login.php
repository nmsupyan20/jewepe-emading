<?php 

// Buat bikin Password
// $pass = password_hash("supyan123", PASSWORD_DEFAULT);
// var_dump($pass);
// die;

include('admin/config_query.php');
$db = new database();

//inisialisasi session
session_start();

//cek session aktif
if(isset($_SESSION['username']) || isset($_SESSION['id_users'])){
    header("location: admin/index.php");
} else {
    if(isset($_POST['submit'])){
        //menghilangkan backslash
        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);

        // cek nilai username & password apakah kosong?
        if(!empty(trim($username)) && !empty(trim($password))){
            //select data dari tb_users
            $query = $db->get_data_users($username);

            if($query){
                $rows = mysqli_num_rows($query);
            } else {
                $rows = 0;
            }

            // var_dump($query);
            // die;

            //cek ketersediaan data username
            if($rows != 0){
                $getData = $query->fetch_assoc();

                if(password_verify($password, $getData['password'])){
                    $_SESSION['username'] = $username;
                    $_SESSION['id_users'] = $getData['id_users'];

                    header("location: admin/index.php");
                } else {
                    header("location: login.php?pesan=gagal");
                }
            } else {
                header("location: login.php?pesan=notfound");
            }

        } else {
            header("location: login.php?pesan=empty");
        }
    } else {
        header("location: login.php?pesan=empty");
    } 
}
?>