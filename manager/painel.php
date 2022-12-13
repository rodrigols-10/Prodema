<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema - Notícias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="pages.css">
</head>
<body>
  <header style="background-color:#005da9">
    <div class="options">
      <ul style="display:flex; justify-content:space-between;">
        <li style="visibility: hidden; height: 100%">
          <a href="painel.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
        </li>
        <li>
          <a href="login.php" title="Acessar o sistema"><i alt="Acessar o sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
        </li>
      </ul>
    </div>
  </header>
    <main>
      <section class="info">
        <article class="info-col1">
          <div class="title-emphasis">
            <h1>CONTROLE</h1>
          </div>
          <div id="noticias">
            <!-- ITENS DE NOTICIAS -->
            <a class="info-item" href="#">
              <figure class="info-img" title="imagem" alt="imagem">
                <img src="edit.png" style="width:100px;height: 100px;object-fit: cover">
              </figure>
              <div class="info-title">
                <h2>GERENCIAR NOTÍCIAS</h2>
                <p>Adicionar, excluir ou editar notícias</p>
              </div>
            </a>
            <a class="info-item" href="#">
              <figure class="info-img" title="imagem" alt="imagem">
                <img src="edit.png" style="width:100px;height: 100px;object-fit: cover">
              </figure>
              <div class="info-title">
                <h2>GERENCIAR EVENTOS</h2>
                <p>Adicionar, excluir ou editar eventos</p>
              </div>
            </a>
            <a class="info-item" href="#">
              <figure class="info-img" title="imagem" alt="imagem">
                <img src="edit.png" style="width:100px;height: 100px;object-fit: cover">
              </figure>
              <div class="info-title">
                <h2>GERENCIAR PROCESSOS SELETIVOS</h2>
                <p>Adicionar, excluir ou editar processos seletivos</p>
              </div>
            </a>
            <a class="info-item" href="#">
              <figure class="info-img" title="imagem" alt="imagem">
                <img src="edit.png" style="width:100px;height: 100px;object-fit: cover">
              </figure>
              <div class="info-title">
                <h2>GERENCIAR DOCUMENTOS</h2>
                <p>Adicionar, excluir ou editar documentos</p>
              </div>
            </a>
          </div>
        </article>
        
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="../scripts/main.js"></script> -->
</body>
</html>