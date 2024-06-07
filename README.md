Desafio técnico - Mercado.

Este é um sistema de mercado desenvolvido para gerenciar produtos, tipos de produtos e vendas. Ele fornece uma interface amigável para os funcionários do mercado registrarem vendas e calcularem os impostos sobre essas vendas.

1. Configuração do Ambiente
1.1. Instalação do PHP
Se você ainda não tem o PHP instalado, baixe e instale a versão adequada para o seu sistema operacional. Você pode encontrar o PHP no site oficial PHP.net.

1.2. Instalação do PostgreSQL (Opcional)
Se desejar usar o PostgreSQL como banco de dados, baixe e instale o PostgreSQL em postgresql.org.

2. Clone o repositório para sua máquina local:
git clone [git@github.com:felipe29j/mercado.git](https://github.com/felipe29j/mercado.git)

3. Desenvolvimento do Banco de Dados 
Lembrando que pode se pegar o dump e apenas criar o database para usá-lo, o dump está dentro da pasta raiz como a nomeação de 'mercado'.

Execução do Arquivo SQL:

Via Console (psql):

Abra o terminal.
Navegue até o diretório onde o arquivo SQL está localizado.
Use o comando psql -U <username> -d <database_name> -f mercado.sql, substituindo <username> pelo seu nome de usuário do PostgreSQL e <database_name> pelo nome do banco de dados que deseja usar.

Via pgAdmin:

Abra o pgAdmin e faça login.
Selecione o banco de dados para o qual deseja importar o mercado SQL.
Clique com o botão direito no banco de dados e escolha "Restore...". Isso abrirá uma janela onde você pode selecionar o arquivo SQL e iniciar o processo de restauração.

3.1. Criação do Banco de Dados e Tabelas(Opcional)
Crie um script SQL para criar o banco de dados "mercado" e as tabelas necessárias dentro dele. Você pode executar esse script usando o pgAdmin ou outro cliente PostgreSQL. Certifique-se de executar os comandos SQL dentro do banco de dados "mercado".

CREATE DATABASE mercado;

Nesse ponto acesse a database mercado e depois rode os seguintes comandos:

CREATE TABLE tipos_produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    imposto_percentual DECIMAL(5, 2) NOT NULL
);

CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo_id INT NOT NULL REFERENCES tipos_produtos(id),
    preco DECIMAL(10, 2) NOT NULL
);

CREATE TABLE vendas (
    id SERIAL PRIMARY KEY,
    produto_id INT NOT NULL REFERENCES produtos(id),
    quantidade INT NOT NULL,
    valor_total DECIMAL(10, 2) NOT NULL,
    valor_imposto DECIMAL(10, 2) NOT NULL,
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

4. Desenvolvimento do Backend em PHP
4.1. Conexão com o Banco de Dados
Crie um arquivo conexao.php na pasta api para estabelecer a conexão com o banco de dados.

$host = 'localhost';
$port = '5432'; // Altere para a porta correta, a porta 8080 foi usada para fins de teste.
$dbname = 'mercado'; //Ou o que preferir utilizar.
$username = 'username';
$password = 'password';

4.2. Criação dos Endpoints
Desenvolvi os arquivos PHP dentro da pasta api para lidar com as operações CRUD necessárias, como cadastrar produtos, tipos de produtos, listar produtos e registrar vendas.

5. Desenvolvimento do Frontend em HTML e CSS
5.1. Páginas HTML
Criei arquivos HTML para as diferentes páginas do projeto, como a página inicial (index.php), página de cadastro de produtos (cadastro_produto.php), página de cadastro de tipos de produtos (cadastro_tipo_produto.php), página de listagem de produtos (listar_produtos.php) e página de registro de vendas (registrar_venda.php).

5.2. Estilização com CSS
Criei um arquivo style.css na pasta css para estilizar as páginas HTML e tornar o projeto visualmente atraente.

6. Teste do Projeto
6.1. Execução do Servidor PHP
Abra o terminal, navegue até a pasta raiz do seu projeto (mercado/) e execute o seguinte comando para iniciar o servidor PHP embutido:

php -S localhost:8080

Lembrando que deve ter os dll do postgres habilitados para a execução correta.

6.2. Acesso às Páginas
Abra um navegador da web e acesse http://localhost:8080 para testar todas as funcionalidades do projeto.

7. Conclusão
Parabéns! Você concluiu a instalação do projeto do mercado. Agora, você tem um sistema funcional para cadastrar produtos, tipos de produtos, registro de vendas e listagem de produtos.