document.addEventListener("DOMContentLoaded",function(){buscaDiciplinas();buscaDiciplinasMatriculadas();});

async function buscaDiciplinas(){
    let dados = await fetch(`/trabalhoFinal/controllers/diciplinas_controller.php`);
    let diciplinas = await dados.json(); 
    console.log(diciplinas);
    id_select = `diciplina`;
    imprimeDiciplinas(diciplinas,id_select);
}

async function buscaDiciplinasMatriculadas(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    let dados = await fetch(`/trabalhoFinal/controllers/matriculas_controller.php?id=${id}`);
    let diciplinas = await dados.json(); 
    id_select = `diciplina2`;
    imprimeDiciplinas(diciplinas,id_select);
}


function imprimeDiciplinas(diciplinas,id_select){
    let select = document.getElementById(id_select);
    for(let diciplina of diciplinas){
        let opcao = document.createElement(`option`);
        opcao.value = diciplina.id;
        opcao.innerHTML = `${diciplina.codigo}-${diciplina.nome}`;
        select.appendChild(opcao);
    }
}

async function matricular(){
    let diciplina = document.getElementById(`diciplina`).value;
    const params = new URLSearchParams(window.location.search);
    const aluno = params.get('id');
    let dado = {
        id_diciplina: diciplina,
        id_aluno: aluno
    };
    console.log(JSON.stringify(dado));
    fetch(`/trabalhoFinal/controllers/matriculas_controller.php`,{
        method:`POST`,
        headers:{'Content-Type': 'application/json'},
        body: JSON.stringify(dado)
    }).then(response => response.json())
    .then(data => {
      console.log('Resposta do servidor:', data);
    })
    .catch(error => {
      console.error('Ocorreu um erro:', error);
    });

}