let postagens = []; // Armazena as postagens

function adicionarPostagem() {
    const titulo = prompt('Título da Postagem:');
    const conteudo = prompt('Conteúdo da Postagem:');
    
    if (titulo && conteudo) {
        postagens.push({ titulo, conteudo });
        atualizarPostagens();
    }
}

function atualizarPostagens() {
    const postagensDiv = document.getElementById('postagens');
    postagensDiv.innerHTML = ''; // Limpa a área antes de atualizar

    postagens.forEach((post, index) => {
        const postElement = document.createElement('div');
        postElement.innerHTML = `<h3>${post.titulo}</h3><p>${post.conteudo}</p>`;
        postagensDiv.appendChild(postElement);
    });
}
