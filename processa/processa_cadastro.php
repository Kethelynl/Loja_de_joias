<?php
// processa_cadastro.php
session_start();
// Configuração do banco de dados
$servername = "localhost";
$username = "root";  // Substitua pelo seu nome de usuário do MySQL
$password = "";  // Substitua pela sua senha do MySQL
$dbname = "cadastro_usuario";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    $_SESSION['mensagem'] = "Conexão falhou: " . $conn->connect_error;
    header('Location: ../cadastro.php');
    exit();
}

// Obter dados do formulário e validar
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

if (empty($nome) || empty($email) || empty($senha)) {
    $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
    header("Location: ../cadastro.php");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensagem'] = "Email inválido.";
    header("Location: ../cadastro.php");
    exit();
}


// Verificar se o email já está registrado
$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();


if ($stmt->num_rows > 0) {
    $_SESSION['mensagem'] = "Este email já está registrado.";
    header("Location: ../cadastro.php");
    exit();
}

$stmt->close();

// Inserir dados na tabela usando prepared statements
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";


$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
} else {
    $_SESSION['mensagem'] = "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../cadastro.php");
exit();
?>