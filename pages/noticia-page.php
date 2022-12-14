<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema - Notícias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/pages.css">
</head>
<body>
  <header id="header_top" class="page">
    <!-- Opções de conta e acessibilidade -->
    <div class="options">
      <ul>
        <li>
          <a href="../manager/login.php" title="Acessar o sistema"><i alt="Acessar o sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Acesso</a>
        </li>
        <li>
          <a href="#"><i alt="Ver mapa do site" title="Ver mapa do site" class="fa-regular fa-rectangle-list"></i></a>
        </li>
        <li>
          <a href="#" onclick="increaseFontSize()"><i class="fa-solid fa-font"></i>+</a>
          <a href="#" onclick="decreaseFontSize()"><i class="fa-solid fa-font"></i>-</a>
        </li>
        <li style="color:white">|</li>
        <li>
          <a href="#"><img src="../assets/portugues-icon.png" alt="idioma da página em português"></a> |
          <a href="#"><img src="../assets/english-icon.png" alt="language of the page in english"></a> |
          <a href="#"><img src="../assets/espanol-icon.png" alt="idioma del sitio en español"> </a>
        </li>
      </ul>
    </div>
    <!-- IMAGEM - LOGO DA PRODEMA -->
    <a class="nav-logo page" href="../index.html">
      <img id="logo" src="../assets/logo2.png" alt="logotipo da Prodema">
    </a>
        <!-- Navbar sticky -->
        <nav id="navbar_top" class="navbar navbar-expand-md navbar-dark">
        <div class="container-fluid">
            <!-- LOGO NA BARRA -->
            <!-- <span class="navbar-brand mx-auto"><img class="logo" src="../assets/logo-white.svg" alt="" width="40" height="40"></span> -->
            <!-- BOTAO DE MENU -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <!-- LISTA DO MENU -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                <button class="nav-link" aria-current="page" aria-expanded="true">Sobre o curso <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                <!-- DROPDOWN -->
                <div class="dropdown-content" style="visibility:hidden">
                    <a href="apresentacao.html">Apresentação</a>
                    <a href="corpo-docente.html">Corpo Docente</a>
                    <a href="processo-seletivo.html">Processo Seletivo</a>
                    <a href="documentos-importantes.html">Documentos Importantes</a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="estrutura-de-rede.html">Estrutura de rede</a>
                </li>
                <li class="nav-item dropdown">
                <button class="nav-link">Estrutura Curricular <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                <!-- DROPDOWN -->
                <div class="dropdown-content" style="visibility:hidden">
                    <a href="area-de-concentracao.html">Área de concentração e linhas de pesquisa</a>
                    <a href="disciplinas-obrigatorias.html">Disciplinas obrigatórias</a>
                    <a href="disciplinas-optativas.html">Disciplinas optativas</a>
                    <a href="seminarios-e-atividades.html">Seminários e atividades obrigatórias</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <button class="nav-link">Comunicação <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                    <!-- DROPDOWN -->
                    <div class="dropdown-content" style="visibility:hidden">
                        <a href="noticias.php">Notícias</a>
                        <a href="eventos.html">Eventos</a>
                        </div>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="fale-conosco.html">Fale conosco</a>
                </li>
            </ul>
            <!-- Barra de pesquisa -->
            <form class="d-flex" role="search" method="get" action="busca.html">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-primary" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            </div>
        </div>
        </nav>
  </header>
    <main>
        <!-- content -->
        <section class="info">
<?php
  include('../manager/connection.php');

  if (isset($_GET['id'])) {
      $id = $_GET['id'];  
      $sql_code = "SELECT * FROM noticias WHERE `noticias`.`id` = $id";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      if (isset($sql_query)) {
        $noticias = $sql_query->fetch_assoc();
?>
          <article class="info-col1">
            <div class="title-info">
              <h1><?php echo $noticias['titulo'] ?></h1>
              <p><i class="fa-regular fa-calendar"></i> <?php echo date_format(new DateTime($noticias['data']),'d.m.Y') ?></p>
            </div>
            <div class="info-page-img">
                <img src="../uploads/<?php echo $noticias['banner'] ?>" alt="imagem da notícia">
            </div>
            <?php echo $noticias['conteudo'] ?>
          </article>
<?php
      }else{  
           echo "Error: ".mysqli_error($mysqli);  
      }
  }
?>
          
          <aside class="info-col2">
            <div class="title-emphasis side">
              <h1>DOCUMENTOS IMPORTANTES</h1>
            </div>
            <p><a style="text-decoration: none; color: black;" href="documentos-importantes.html#normas-resolucoes"><i class="fa-regular fa-folder-open"></i> Normas e Resoluções</a></p>
            <p><a style="text-decoration: none; color: black;" href="documentos-importantes.html#oferta-disciplina"><i class="fa-regular fa-folder-open"></i> Oferta de Disciplinas</a></p>
            <p><a style="text-decoration: none; color: black;" href="documentos-importantes.html#portaria-oficios"><i class="fa-regular fa-folder-open"></i> Portarias e Ofícios</a></p>
            <p><a style="text-decoration: none; color: black;" href="documentos-importantes.html#processo-seletivo"><i class="fa-regular fa-folder-open"></i> Processo seletivo</a></p>
            <a class="btn btn-sm btn-outline-primary ver-mais" href="documentos-importantes.html">Ver mais...</a>
          </aside>
        </section>
        

    </main>
    <footer>
        <div class="rodape">
          <div class="contatos">
            <p>
              <i alt="Telefone" title="Telefone" class="fa-solid fa-phone"></i> 
            <strong>Contato:</strong> (84) 99193-6219
            </p>
            <p>
              <i alt="Email da Prodema" title="Email Prodema" class="fa-regular fa-envelope"></i> 
            <strong>Email:</strong> <a href="mailto:prodemadoutorado@gmail.com">prodemadoutorado@gmail.com</a>
            </p>
            <div>
              <p>
                <i class="fa-solid fa-location-dot"></i>
                <strong>Endereço:</strong>
              </p>
              <p>Centro de Biociências</p>
              <p>Universidade Federal do Rio Grande do Norte</p>
              <p>CEP: 59.078-970</p>
              <p>Campus Universitário/ Lagoa Nova </p>
              <p>Natal - RN</p>
            </div>
          </div>
          <div class="social">
            <h1><i class="fa-regular fa-thumbs-up"></i> Mídias Sociais</h1>
            <div>
              <a href="https://www.facebook.com/prodemaufrn"><img src="../assets/icon_facebook.png" alt="ícone do Facebook"></a>
              <a href="https://www.dropbox.com/sh/73fezju8dwsvja8/AADerxFRSEuf0PJIg115edK1a?dl=0"><img src="../assets/icon_dropbox.png" alt="ícone do Dropbox"></a>
              <a href="https://sistemas.ufrn.br/gerenciadorportais/public/prodema/noticia/rss/"><img src="../assets/icon_rss.png" alt="ícone do RSS"></a>
            </div>
          </div>
          <div class="direitos">
            <h1>Prodema</h1>
            <p>
              Todos os direitos Reservados <span>&copy</span> Copyright 2022
            </p>
          </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="../scripts/main.js"></script>
</body>
</html>