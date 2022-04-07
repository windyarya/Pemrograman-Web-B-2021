<?php
function register_user($name, $email, $password) {
    global $conn;

    $nama = escape($name);
    $pass = escape($password);

    $enc_pass = md5($password);

    $query = "INSERT INTO users(username, email, password) VALUES('$nama', '$email', '$enc_pass')";
    $user_new = mysqli_query($conn, $query);
    if ($user_new) {
        $usr = "SELECT * FROM users WHERE username = '$nama'";
        $result = mysqli_query($conn, $usr);
        $user = mysqli_fetch_assoc($result);
        return $user;
    } else {
        return NULL;
    }
}

function escape($data){
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

function cek_nama($name){
    global $conn;
    $query = "SELECT * FROM users WHERE username = '$name'";
    if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
}

function cek_data_user($name, $password){
    global $conn;
    //mencegah sql injection
    $nama = escape($name);
    $password = escape($password);
     
    $query  = "SELECT * FROM users WHERE username = '$nama'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    $encrypted_password = $data['password'];
    $enc = md5($password);
    if($encrypted_password == $enc) {
        return $data;
    }else{
        return false;
    }
}

function cek_password($password1, $password2){
    global $conn;
    if ($password1 == $password2) {
        return 0;
    } else {
        return 1;
    }
}
?>