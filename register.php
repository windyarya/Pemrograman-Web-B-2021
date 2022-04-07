<?php
require_once ("config/init.php");

$response = array("error" => FALSE);

if (isset($_POST['reg_user'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password1 = $_POST['password_1'];
    $password2 = $_POST['password_2'];
    if (!empty($name) && !empty($email) && !empty($password1) && !empty($password2)) {
        if (cek_nama($name) == 0) {
            if (cek_password($password1, $password2) == 0) {
                $user = register_user($name, $email, $password1);
                if ($user) {
                    $response["error"] = FALSE;
                    $response["user"]["name"] = $user["username"];
                    $response["user"]["email"] = $user["email"];
                    $response["user"]["password"] = $user["password"];
                } else {
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Terjadi kesalahan saat melakukan registrasi";
                }
            } else {
                $response["error"] = TRUE;
                $response["error_msg"] = "Kombinasi password yang dimasukkan tidak sama!";
                $response["user"]["name"] = $name;
                $response["user"]["email"] = $email;
                $response["user"]["password1"] = $password1;
                $response["user"]["password2"] = $password2;
            }
        } else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Username telah digunakan";
        }
    } else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Isian form tidak boleh kosong!";
        $response["user"]["name"] = $name;
        $response["user"]["email"] = $email;
        $response["user"]["password1"] = $password1;
        $response["user"]["password2"] = $password2;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>