<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
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
             <img src="imagens/view-luxurious-golden-ring-felt-jewelry-display.jpg" width="10%">
           </figure>
           <div class="login">
             <h2>Login</h2>
             <form action="processa_login.php" method="post">
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
    <script src="script.js"></script>
</body>
</html>