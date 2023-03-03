<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema Doutorado | Mapa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/pages.css">
    <style>
      #back-info{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left:0;
        background-color: rgba(117, 117, 117, 0.5);
      }
      #information{
        display: none;
        position: fixed;
        max-width: 400px;
        min-height: 180px;
        padding: 2rem;
        border-radius: 10px;
        background-color: white;
        top: 50vh;
        left: 50vw;
        transform: translate(-50%,-50%);
        text-align: center;
      }
      .point{
        r: 5px;
        stroke-width: 5px;
        transition: all 0.5s;
      }
      .point:hover {
        r: 7px;
        stroke-width: 7px;
      }
      .onhover{
        color: black;
      }
      .onhover:hover{
        color: black;
        background-color: rgb(228, 236, 240);
      }
    </style>
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
    <a class="nav-logo page" href="../index.php">
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
                    <a href="corpo-docente.php">Corpo Docente</a>
                    <a href="processo-seletivo.php">Processo Seletivo</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="mapa.php">Egressos</a>
                </li>
                <li class="nav-item dropdown">
                  <button class="nav-link">Comunicação<i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                  <!-- DROPDOWN -->
                  <div class="dropdown-content" style="visibility:hidden">
                      <a href="noticias.php">Notícias</a>
                      <a href="eventos.php">Eventos</a>
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
        <section>
            <div class="title-emphasis">
                <h1>MAPA DOS EGRESSOS</h1>
            </div>                
            <div style="background-color: white; border-radius: 10px; width: 100%; padding: 3px; margin: 10px auto 10px auto; overflow: auto;">
                <!-- <canvas width="100%" id="canvas">
                </canvas> -->
                <svg width="1000px" height="556px" style="display:block; position:relative; margin: 0 auto">
                  <g>
                    <image xlink:href="../assets/mapa.png" alt="Mapa Mundi" width="1000px" height="556px" x="0px" y="0px"></image>
                  </g>
<?php
  include('../manager/connection.php');

    $sql_code = "SELECT * FROM egressos";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      
      while($egressos = $sql_query->fetch_assoc()){
    ?>

                  <g id="item<?php echo $egressos['id'] ?>" stroke="rgba(20,100,255,0.8)" fill="white" stroke-width="5">
                      <text id="info<?php echo $egressos['id']?>" style="display:none" x="0" y="0"><?php echo $egressos['informacao'] ?></text>
                      <circle id="ponto<?php echo $egressos['id'] ?>" class="point" cx="<?php echo $egressos['cx'] ?>px" cy="<?php echo $egressos['cy'] ?>px" r="5px" onclick="showGraduates('<?php echo $egressos['nome'] ?>','<?php echo $egressos['regiao'] ?>','<?php echo $egressos['link'] ?>','<?php echo $egressos['id'] ?>')"/>
                  </g>
<?php } ?>
              </svg>
              <div id="back-info" onclick="desappearInfo()">
              <!-- FUNDO ESCURO -->
              </div>
              <div id="information">
                  <!-- MENSAGEM -->
              </div>
            </div>
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
              <p>CEP: 59.078-900</p>
              <p>Campus Universitário/ Lagoa Nova </p>
              <p>Natal - RN</p>
            </div>
          </div>
          <div class="social">
            <h1><i class="fa-regular fa-thumbs-up"></i> Mídias Sociais</h1>
            <div>
              <a style="color:white; font-size:2rem" href="https://www.facebook.com/profile.php?id=100088104321284" title="Página do Facebook"><i class="fa-brands fa-square-facebook"></i></a>
              <a style="color:white; font-size:2rem" href="https://www.instagram.com/prodemadoutorado/" title="Página do Instagram"><i class="fa-brands fa-square-instagram"></i></a>
              <a style="color:white; font-size:2rem" href="https://www.youtube.com/@doutoradoemdesenvolvimento8960" title="Página do Youtube"><i class="fa-brands fa-square-youtube"></i></a>
              <a style="color:white; font-size:2rem" href="https://twitter.com/RedeProdema" title="Página do Twitter"><i class="fa-brands fa-square-twitter"></i></a>
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
    <script>
      const showGraduates = function(nome,country,link,id){
        const bi = document.getElementById("back-info");
        const box = document.getElementById("information");
        const info = document.getElementById("info"+id).textContent;
        bi.style.display = "block";
        box.style.display = "block";
        let linkinfo = "";
        if(link!='') linkinfo = "<p><a href='"+handleLink(link)+"' target='_blank' class='onhover' style='text-decoration:none; color:black;'><strong>"+nome+"</strong></a></p>";
        else linkinfo = "<p><strong>"+nome+"</strong></p>";

        box.innerHTML = linkinfo+"<p>"+country+"</p> <hr> <p>"+info+"</p>";
      }
      const desappearInfo = function(){
        const bi = document.getElementById("back-info");
        const inf = document.getElementById("information");
        bi.style.display = "none";
        inf.style.display = "none";
        inf.innerHTML = "";
      }
      
      const handleLink = function(link){
          if(link.indexOf(".") == -1) return link;
          if(link.indexOf("https://") == -1 && link.indexOf("http://") == -1){
              return "https://"+link;
          } else {
            return link;
          }
        }
    </script>
</body>
</html>