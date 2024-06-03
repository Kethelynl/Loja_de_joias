<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Cadastro_usuario";

//criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

//verificando conexão
//No PHP, a propriedade connect_error é usada com a classe mysqli para verificar se ocorreu algum erro ao tentar estabelecer uma conexão com um banco de dados MySQL
if ($conn ->connect_error) {
    die("Conexão falhou" . $conn->connect_error);
}

//obtendo dados do formulário e validando
// a função trim() é usada para remover espaços em branco e outros caracteres específicos do início e do final de uma string
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

//A função empty() em PHP é usada para verificar se uma variável está vazia
if(empty($email) || empty($senha)){
    die("Todos os campos são obrigatórios");
}

//A função filter_var() no PHP é usada para filtrar variáveis com base em requisitos específicos, como validação de e-mail, validação de URL, remoção de caracteres indesejados etc. O operador ! usado antes de filter_var() inverte o resultado da função, ou seja, ele retorna true se filter_var() retornar false, e vice-versa.

//O filtro FILTER_VALIDATE_EMAIL é usado junto com a função filter_var() no PHP para validar se uma string é um endereço de e-mail válido de acordo com as regras de formatação definidas nas RFCs 
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email inválido. ");
}

//verificando se o email existe nos dados
// especifica que quero o item id e senha da tabela usuario
$sql = "SELECT id, senha FROM usuarios WHERE email = ?";
//A função prepare() em PHP é usada para preparar uma instrução SQL para execução
$stmt = $conn->prepare($sql);
//A função bind_param() é usada em conjunto com a função prepare() para vincular variáveis PHP aos parâmetros de uma instrução SQL preparada. Isso é especialmente útil quando você tem consultas SQL com parâmetros que são fornecidos dinamicamente, como consultas que dependem de entrada do usuário.
$stmt->bind_param("s", $email);
//A função execute() é usada em conjunto com instruções SQL preparadas para executar a consulta preparada com os parâmetros vinculados. Depois que você prepara uma consulta SQL e vincula os parâmetros usando bind_param(), você pode chamar execute() para realmente executar a consulta no banco de dados.
$stmt->execute();
//A função store_result() é usada em conjunto com instruções SQL preparadas quando você espera recuperar um conjunto de resultados de uma consulta SELECT. Ele armazena o conjunto de resultados do servidor na memória do cliente para posterior processamento.
$stmt->store_result();

//A função num_rows é usada para obter o número de linhas retornadas por uma consulta SELECT no MySQL quando você está usando a API MySQLi (MySQL Improved) em PHP.
if ($stmt->num_rows == 0) {
    die("Email ou senha incorretos.");
}
//A função bind_result() em PHP é usada em conjunto com instruções SQL preparadas (usando MySQLi) para vincular variáveis às colunas do conjunto de resultados de uma consulta SQL. Isso permite que você recupere os valores das colunas da consulta e armazene esses valores diretamente nas variáveis especificadas.
$stmt->bind_result($id, $senha_hash);
//A função fetch() em PHP, quando usada com uma instrução preparada (mysqli_stmt), recupera a próxima linha do conjunto de resultados de uma consulta e armazena os valores das colunas nas variáveis vinculadas por meio de bind_result().
$stmt->fetch();

//verificar a senha
//A função password_verify() em PHP é usada para verificar se um dado hash corresponde a uma senha fornecida. Essa função é útil para autenticação de usuários, onde a senha armazenada no banco de dados é armazenada como um hash seguro, e a senha fornecida pelo usuário precisa ser comparada com esse hash para validar a identidade do usuário.
if (!password_verify($senha, $senha_hash)) {
    die("email ou senha incorretos. ");
}

//reiniciar a sessão
//A função session_start() em PHP é usada para iniciar uma nova sessão ou retomar uma sessão existente. As sessões são uma maneira de armazenar informações sobre o usuário em várias páginas de um site.
session_start();
//$_SESSION é uma superglobal em PHP que é usada para armazenar informações de sessão do usuário. As sessões permitem que você armazene dados que persistem entre diferentes requisições HTTP. A superglobal $_SESSION é um array associativo que pode ser usado para guardar qualquer tipo de dado, como strings, números, arrays e objetos
$_SESSION['id'] = $id;
$_SESSION['email'] = $email;

header("location: index.php");
exit();

//A função close() em PHP geralmente se refere a métodos que encerram conexões ou recursos abertos previamente, como conexões de banco de dados, arquivos ou sessões. A função exata e seu uso específico dependem do contexto. Aqui estão alguns exemplos comuns de close() em diferentes contextos:
$stmt->close();
$conn->close();
?>