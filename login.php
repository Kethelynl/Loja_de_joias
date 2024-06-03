<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/login.css">
    <title>Document</title>
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
           <figure class="imagen_joia">
             <img src="./images/view-luxurious-golden-ring-felt-jewelry-display.jpg" width="10%">
           </figure>
           <div class="login">
             <h2>Login</h2><br>
             <?php
             if(isset($_SESSION['mensagem'])){
              echo "<p style='color:red;'>" . $_SESSION['mensagem'] . "<p>";
              unset($_SESSION['mensagem']);
             }
             ?>
             <form action="./processa/processa_login.php" method="post">
               <div class="recebe">
                 <label for="email">Email</label>
                 <input type="email" id="email" name="email" required><br><br>
               </div>

               <div class="recebe">
                 <label for="senha">Senha</label>
                 <input type="password" type="senha" name="senha" requered>
                 <p>Não é cadastrado?<a href="cadastro.php">Cadastre-se</a></p><br><br>
               </div>

               <div class="entra_botao">
                 <input type="submit" value="ENTRAR">
               </div>
             </form>
           </div>
        </div>
    </main>
    <script src="./js/script.js"></script>
</body>
</html>