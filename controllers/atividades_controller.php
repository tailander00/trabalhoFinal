<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    cadastra_atividade($dadosDecodificados);
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
    lista_atividades();
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    altera_atividade($_SERVER['PATH_INFO']);
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    deleta_atividade($_SERVER['PATH_INFO']);
}

function cadastra_atividade($atividade){
    $id = rand(0,999);
    $id_diciplina = $atividade['id_diciplina'];
    $id_diciplina = intval($id_diciplina);
    $tipo = $atividade['tipo'];
    $descricao = $atividade['descricao'];
    $peso = $atividade['peso'];
    $data_entrega = $atividade['data_entrega'];

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "INSERT INTO atividades (id, id_diciplina, tipo, descricao, peso, data_entrega) VALUES ($id, $id_diciplina, '$tipo', '$descricao', '$peso', '$data_entrega');";
    
    $result = mysqli_query($con, $query);

    echo json_encode(array('erro'=>mysqli_error($con),'resultado'=>$result));
    mysqli_close($con);

}

function lista_atividades(){
    $id_diciplina = $_GET['id'];
    $id_diciplina = intval($id_diciplina);

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "SELECT * FROM atividades WHERE id_diciplina = $id_diciplina;";
    
    $result = mysqli_query($con, $query);

    $rows = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $rows[$i] = $row;
        $i += 1;
    }
    $json_dados = json_encode($rows);
    echo $json_dados;

    mysqli_close($con);
}

function altera_atividade($diciplina){

}

function deleta_atividade($diciplina){
    
}


?>