document.addEventListener("DOMContentLoaded",buscaDiciplinas());

async function cadastraDiciplina(){
    let params = new URLSearchParams(window.location.search);
    let id_professor = params.get('id');
    let codigo = document.getElementById(`codigo`).value;
    let nome = document.getElementById(`nome`).value;
    let curso = document.getElementById(`curso`).value;

    let dado = {
        codigo: codigo,
        nome: nome,
        curso: curso,
        id_professor: id_professor,
    };
    fetch(`/trabalhoFinal/controllers/diciplinas_controller.php`,{
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

async function buscaDiciplinas(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    let dados = await fetch(`/trabalhoFinal/controllers/diciplinas_controller.php?id=${id}`);
    let diciplinas = await dados.json(); 
    imprimeDiciplinas(diciplinas);

}

function imprimeDiciplinas(diciplinas){
    let select = document.getElementById(`diciplina`);
    let select2 = document.getElementById(`diciplina2`);
    for(let diciplina of diciplinas){
        let opcao = document.createElement(`option`);
        opcao.value = diciplina.id;
        opcao.innerHTML = `${diciplina.codigo}-${diciplina.nome}`;
        select.appendChild(opcao);
        select2.appendChild(opcao.cloneNode(true));
    }
}
