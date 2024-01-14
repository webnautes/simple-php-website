<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);

function is_login(){

    global $con;

    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ){

        $stmt = $con->prepare("select username from users where username=:username");
        $stmt->bindParam(':username', $_SESSION['user_id']);
        $stmt->execute();
        $count = $stmt->rowcount();

        if ($count == 1){
     
            return true; //로그인 상태
        }else{
            //사용자 테이블에 없는 사람
            return false;
        }
    }else{

        return false; //로그인 안된 상태
    }
}

//https://stackoverflow.com/a/46872528

function encrypt($plaintext, $salt) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $salt, true);
    $iv = openssl_random_pseudo_bytes(16);

    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext, $key, true);

    return $iv . $hash . $ciphertext;
}

function decrypt($ivHashCiphertext, $salt) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $salt, true);

    if (hash_hmac('sha256', $ciphertext, $key, true) !== $hash) return null;

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}


?>