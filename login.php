<?php 
require_once ("config/init.php");

$response = array("error" => FALSE);
 
//mengecek parameter post
if (isset($_POST['login_user'])) {
     
    //menampung parameter ke dalam variabel
    $nama  = $_POST['username'];
    $pass = $_POST['password'];
      
    $user = cek_data_user($nama,$pass); //validasi user
 
    if($user != false){
        //jika berhasil login
        $response["error"] = FALSE;
        $response["user"]["name"] = $user["username"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["password"] = $user["password"];
    }else{
        // user tidak ditemukan password/email salah
        $response["error"] = TRUE;
        $response["error_msg"] = "Login gagal. Username atau Password salah";
    }
 
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Username atau Password tidak boleh kosong!";
}

header('Content-Type: application/json');
echo json_encode($response);
?>