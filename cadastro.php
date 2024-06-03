<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/cadastro.css">
    
    <title>Cadastre-se em JoiaRara</title>
</head>
<body>
<header>
     <nav class="navbar">
        <div class="logo">Joia Rara</div>
        <ul class="nav-links">
            <?php
              $menuItens = [
                'Início' => "index.php",
                'Procurar' => "#",
                'Carrinho' => "#",
                'login'    => "login.php"
              ];

              foreach ($menuItens as $name => $link){
                echo "<li><a href='$link'>$name</a></li>";
              }
            ?>
        </ul>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
     </nav>
    </header>
    <main>
        <div class="container">
            <div class="imagem">
               <img src="./images/display-shiny-luxurious-golden-chain (2).jpg">
            </div>
            <div class="cadastro"> 
             <h2> Cadastro de Usuário</h2><br>
             <?php
             if(isset($_SESSION['mensagem'])) {
               echo "<p style='color: red;'>" . $_SESSION['mensagem'] . "<p><br>";
               unset($_SESSION['mensagem']);
             }
             ?>
             <form action="./processa/processa_cadastro.php" method="post">
                <div class="input">
                 <label for="nome">Nome</label>
                 <input type="text" id="nome" name="nome" required><br><br>
                </div>
                
                <div class="input">
                 <label for="email">Email </label>
                 <input type="email" id="email" name="email" required><br><br>
                </div>
                
                <div class="input">
                 <label for="senha">Senha</label>
                 <input type="password" id="senha" name="senha" requerid><br><br>
                </div>
                
                <div class="cadastrar-botao">
                 <input type="submit" value="Cadastrar">
                </div>
             </form>
            </div>
        </div>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>