async function cadastraUsuario(){
    let nome = document.getElementById(`nome`).value;
    let matricula = document.getElementById(`matricula`).value;
    let tipo = document.getElementById(`tipo`).value;
    let senha = document.getElementById(`senha`).value;
    let senha2 = document.getElementById(`senha2`).value;
    let curso = document.getElementById(`curso`).value;

    if(senha == senha2){
        let dado = {
            nome: nome,
            matricula: matricula,
            tipo: tipo,
            senha: senha,
            curso: curso
        };
        fetch(`/trabalhoFinal/controllers/usuarios_controller.php`,{
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
}

async function fazerLogin(){
    let matricula = document.getElementById(`matricula`).value;
    let senha = document.getElementById(`senha`).value;
    let dado = {
        matricula: matricula,
        senha: senha
    };
    fetch(`/trabalhoFinal/controllers/login_controller.php`,{
        method:`POST`,
        headers:{'Content-Type': 'application/json'},
        body: JSON.stringify(dado)
    }).then(response => response.json())
    .then(data => {
      console.log('Resposta do servidor:', data);
      if(data.permicao != null){
        console.log(data.tipo);
        if(data.tipo == `Aluno`){
            window.location.href = `/trabalhoFinal/paginas/aluno.html?id=${data.id}`;
        }else if(data.tipo == `Professor`){
            window.location.href = `/trabalhoFinal/paginas/professor.html?id=${data.id}`;
        }
      }else{
        alert("Matricula ou senha incorretos.");
      }
    })
    .catch(error => {
      console.error('Ocorreu um erro:', error);
      alert("Matricula ou senha incorretos.");
    });
}