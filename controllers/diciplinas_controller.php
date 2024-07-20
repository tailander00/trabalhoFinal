<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    cadastra_diciplina($dadosDecodificados);
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
    lista_diciplinas();
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    altera_diciplina($_SERVER['PATH_INFO']);
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    deleta_diciplina($_SERVER['PATH_INFO']);
}

function cadastra_diciplina($diciplina){
    $id = rand(0,999);
    $codigo = $diciplina['codigo'];
    $nome = $diciplina['nome'];
    $curso = $diciplina['curso'];
    $id_professor = $diciplina['id_professor'];

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "INSERT INTO diciplinas (id, codigo, nome, curso, id_professor) VALUES ($id, '$codigo', '$nome', '$curso', '$id_professor');";
    

    $result = mysqli_query($con, $query);

    echo json_encode(array('erro'=>mysqli_error($con),'resultado'=>$result));
    mysqli_close($con);

}

function lista_diciplinas(){

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    if(isset($_GET['id'])){
        $id_professor = $_GET['id'];
        $query = "SELECT id, codigo, nome FROM diciplinas WHERE id_professor = '$id_professor';";
    }else{
        $query = "SELECT id, codigo, nome FROM diciplinas;";
    }
    
    $result = mysqli_query($con, $query);

    if($result){
        $rows = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $rows[$i] = $row;
            $i += 1;
        }
        $json_dados = json_encode($rows);

        echo $json_dados;
    }else{
        echo "Ocorreu um erro na consulta: " . mysqli_error($con);
    }

    mysqli_close($con);
}

function altera_diciplina($diciplina){

}

function deleta_diciplina($diciplina){
    
}


?>