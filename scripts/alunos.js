document.addEventListener("DOMContentLoaded",carregaDadosAluno());

async function carregaDadosAluno(){

    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');

    let dados = await fetch(`/trabalhoFinal/controllers/usuarios_controller.php?id=${id}`);
    let professor = await dados.json(); 
    
    boasVindas(professor);
}

function boasVindas(professor){
    let nome = document.createElement(`h2`);
    nome.innerHTML = `Bem vindo ${professor.nome}`;
    document.getElementById(`cabecalho`).appendChild(nome);
}