<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    confirma_login($dadosDecodificados);
}

function confirma_login($usuario){
    $matricula = $usuario['matricula'];
    $senha = $usuario['senha'];

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "SELECT id, tipo FROM usuario WHERE matricula = '$matricula' AND senha = '$senha';";
    
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    echo json_encode(array(
        'erro'=>mysqli_error($con),
        'permicao'=>$row,
        'tipo'=>$row['tipo'],
        'id'=>$row['id']));
    mysqli_close($con);
}


?>