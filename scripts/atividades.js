async function cadastraAtividade(){
    let id_diciplina = document.getElementById(`diciplina`).value;
    let tipo = document.getElementById(`tipo`).value;
    let descricao = document.getElementById(`descricao`).value;
    let peso = document.getElementById(`peso`).value;
    let data_entrega = document.getElementById(`data_entrega`).value;
    let dado = {
        id_diciplina: id_diciplina,
        tipo: tipo,
        descricao: descricao,
        peso: peso,
        data_entrega: data_entrega
    };
    console.log(JSON.stringify(dado));
    fetch(`/trabalhoFinal/controllers/atividades_controller.php`,{
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

async function listaAtividades(){
    let id = document.getElementById(`diciplina2`).value;
    let dados = await fetch(`/trabalhoFinal/controllers/atividades_controller.php?id=${id}`);
    let atividades = await dados.json();
    console.log(atividades);
    imprimeAtividades(atividades);
}

function imprimeAtividades(atividades){
    let div = document.getElementById(`atividades`);
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
    for(let atividade of atividades){
        let quadro = document.createElement(`div`);
        quadro. innerHTML = `
        tipo: ${atividade.tipo}<br>
        descricao: ${atividade.descricao}<br>
        peso: ${atividade.peso}<br>
        data: ${atividade.data_entrega}<br>
        `;
        quadro.className = `post-it`;
        div.appendChild(quadro);
    }
}