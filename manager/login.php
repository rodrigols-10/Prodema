<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema - Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
</head>
<body>
    <header style="position: absolute; top:0; width: 100%; background-color:#005da9">
      <div class="options">
        <ul style="display:flex; justify-content:space-between;">
          <li style="height: 100%">
            <a href="index.html" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
          </li>
          <li style="visibility: hidden; height: 100%">
            <a href="" title="Sair do sistema"><i alt="Sair do sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
          </li>
        </ul>
      </div>
      <div style="background-color: red;">
        
<?php
  include('connection.php');

  if (isset($_POST['email']) || isset($_POST['password'])){
    if(strlen($_POST['email']) == 0){
      echo "Preencha seu e-mail";
    } else if(strlen($_POST['password']) == 0){
      echo "Preencha sua senha";
    } else {
      $email = $mysqli->real_escape_string($_POST['email']);
      $password = $mysqli->real_escape_string($_POST['password']);
      $sql_code = "SELECT * FROM usuarios WHERE usuario = '$email' AND senha = '$password'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página

      $qtd = $sql_query->num_rows;

      if($qtd == 1){
        $user = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
          session_start();
        }
        $_SESSION['usuario'] = $user['usuario'];

        header("Location: painel.php");

      } else {
        echo "Falha ao logar. Email ou senha incorretos";
      }
    }

  }
?>
          
      </div>
    </header>
    <main class="signin">
        <form action="" method="POST">
          <img class="mb-4" src="logo2.png" alt="" height="72">
          <!-- <i class="fa-regular fa-image" style="font-size: 5rem"></i> -->
          <p class="mb-3 fw-normal">Entre com seus dados</p>
      
          <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Endereço de Email" required>
            <label for="floatingInput">Endereço de Email</label>
          </div>
          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Senha" required>
            <label for="floatingPassword">Senha</label>
          </div>
      
          <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
          <!-- <p class="mt-5 mb-3 text-muted">© 2017–2021</p> -->
        </form>
    </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>