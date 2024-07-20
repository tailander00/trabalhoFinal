<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $dadosRecebidos = file_get_contents('php://input');
    $dadosDecodificados = json_decode($dadosRecebidos, true);
    cadastra_matricula($dadosDecodificados);
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
    lista_matriculas();
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    altera_matricula($_SERVER['PATH_INFO']);
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    deleta_matricula($_SERVER['PATH_INFO']);
}

function cadastra_matricula($matricula){
    $id_diciplina = $matricula['id_diciplina'];
    $id_aluno = $matricula['id_aluno'];
    $id_diciplina = intval($id_diciplina);
    $id_aluno = intval($id_aluno);

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $query = "INSERT INTO diciplina_aluno (id_diciplina, id_aluno) VALUES ($id_diciplina, $id_aluno);";
    
    $result = mysqli_query($con, $query);

    echo json_encode(array('erro'=>mysqli_error($con),'resultado'=>$result));
    mysqli_close($con);
}

function lista_matriculas(){

    $con = mysqli_connect('localhost','root','');
    mysqli_select_db($con,'Atividades');

    $id_aluno = $_GET['id'];
    $query = "SELECT nome, codigo, id FROM diciplinas,diciplina_aluno WHERE diciplina_aluno.id_aluno = $id_aluno AND diciplina_aluno.id_diciplina = diciplinas.id;";

    
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

function altera_matricula($diciplina){

}

function deleta_matricula($diciplina){
    
}


?>