<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    cadastra_usuario($dadosDecodificados);
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
    lista_usuarios();
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    altera_usuario($dadosDecodificados);
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    deleta_usuario($dadosDecodificados);
}

function cadastra_usuario($usuario){
    $id = rand(0,999);
    $nome = $usuario['nome'];
    $matricula = $usuario['matricula'];
    $senha = $usuario['senha'];
    $tipo = $usuario['tipo'];
    $curso = $usuario['curso'];


    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "INSERT INTO usuario (id, nome, matricula, senha, tipo, curso) VALUES ($id, '$nome', '$matricula', '$senha', '$tipo', '$curso');";
    

    $result = mysqli_query($con, $query);

    echo json_encode(array('erro'=>mysqli_error($con),'resultado'=>$result));
    mysqli_close($con);
}

function lista_usuarios(){
    $id = $_GET['id'];
    $id = intval($id);

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "SELECT * from usuario WHERE id = $id";
    $result = mysqli_query($con,$query);

    $row = mysqli_fetch_assoc($result);
    $json_dados = json_encode($row);

    echo $json_dados;

    mysqli_close($con);
}

function altera_usuario($usuario){

}

function deleta_usuario($usuario){

}

?>