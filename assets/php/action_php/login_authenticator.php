<?php
session_start();
include_once('../includes_php/connect_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    header('Content-Type: application/json');
    $request_body = file_get_contents('php://input');
    $data     = json_decode($request_body);
    $email    = $data->email;
    $password = $data->password;
    $response = array();
    if (empty($email)) {
        $response['error_email'] = 'O campo usuário não pode estar em branco!';
        $response['status'] = 'error';
    } else if (empty($password)){
        $response['error_password'] = 'O campo senha não pode estar em branco!';
        $response['status'] = 'error';
    }else{
    
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])){
                $response['status']     = 'success';
                $_SESSION['usuario']    = $row['username']; 
                $_SESSION['id_usuario'] = $row['id']; // adiciona o ID do usuário à variável de sessão
                $response['redirect']   = '/index.php'; // adiciona a propriedade 'redirect' com a URL do index.php

            } else {
                $response['error_password'] = 'A senha está incorreta!';
                $response['status'] = 'error';
            }
        } else {
             $response['error_email'] = 'Este e-mail não está cadastrado em nosso sistema!';
             $response['status'] = 'error';
        }
    }

    
    echo json_encode($response);
}
