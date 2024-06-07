function adicionarProduto() {
    var produtoId = document.getElementById('produto_id').value;
    var produtoNome = document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].text;
    var preco = document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].getAttribute('data-preco');
    var imposto = document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].getAttribute('data-imposto');
    var quantidade = parseFloat(document.getElementById('quantidade').value);

    if (!produtoId || !quantidade) {
        alert("Por favor, selecione um produto e insira a quantidade.");
        return;
    }

    var produto = {
        id: produtoId,
        nome: produtoNome,
        preco: parseFloat(preco),
        imposto: parseFloat(imposto),
        quantidade: quantidade
    };

    adicionarProdutoLista(produto);

    document.getElementById('produto_id').value = '';
    document.getElementById('quantidade').value = '';

    document.getElementById('produtos-selecionados-section').style.display = 'block';
    document.getElementById('registrar-venda-button').style.display = 'block';
}

function adicionarProdutoLista(produto) {
    var tabela = document.getElementById('produtos-selecionados');
    var rows = tabela.getElementsByTagName('tr');
    var encontrado = false;

    // Verifica se o produto já está na lista
    for (var i = 0; i < rows.length; i++) {
        var cols = rows[i].getElementsByTagName('td');
        if (cols[0].innerText === produto.id) {
            // Atualiza a quantidade e os valores se o produto já estiver na lista
            var novaQuantidade = parseFloat(cols[4].innerText) + produto.quantidade;
            var novoValorTotal = produto.preco * novaQuantidade;
            var novoValorImposto = (novoValorTotal * produto.imposto) / 100;

            cols[4].innerText = novaQuantidade;
            cols[6].innerText = "R$ " + novoValorTotal.toFixed(2);
            cols[8].innerText = "R$ " + novoValorImposto.toFixed(2);

            // Atualiza o campo hidden de quantidade no formulário
            var input = document.querySelector(`input[name="produtos_quantidades[${produto.id}]"]`);
            input.value = novaQuantidade;

            encontrado = true;
            break;
        }
    }

    // Se o produto não estiver na lista, adiciona uma nova linha
    if (!encontrado) {
        var valorTotal = produto.preco * produto.quantidade;
        var valorImposto = (valorTotal * produto.imposto) / 100;

        var produtoSelecionado = `
            <tr>
                <td>${produto.id}</td>
                <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
                <td>${produto.nome}</td>
                <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
                <td>${produto.quantidade}</td>
                <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
                <td>R$ ${valorTotal.toFixed(2)}</td>
                <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
                <td>R$ ${valorImposto.toFixed(2)}</td>
            </tr>
        `;

        tabela.innerHTML += produtoSelecionado;

        var inputProdutos = document.getElementById('produtos-quantidades');
        inputProdutos.innerHTML += `<input type="hidden" name="produtos_quantidades[${produto.id}]" value="${produto.quantidade}">`;
    }
}

function validarFormulario() {
    var produtosSelecionados = document.getElementById('produtos-selecionados').innerHTML.trim();
    if (!produtosSelecionados) {
        alert("Por favor, adicione pelo menos um produto antes de registrar a venda.");
        return false;
    }
    return true;
}
