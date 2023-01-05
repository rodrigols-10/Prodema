<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema - Doutorado em Desenvolvimento e Meio Ambiente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header id="header_top" class="main">
      <!-- Opções de conta e acessibilidade -->
      <div class="options">
        <ul>
          <li>
            <a href="manager/login.php" title="Acessar o sistema"><i alt="Acessar o sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Acesso</a>
          </li>
          <li>
            <a href="#"><i alt="Ver mapa do site" title="Ver mapa do site" class="fa-regular fa-rectangle-list"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa-solid fa-font"></i>+</a>
            <a href="#"><i class="fa-solid fa-font"></i>-</a>
          </li>
          <li style="color:white">|</li>
          <li>
            <a href="#"><img src="assets/portugues-icon.png" alt="idioma da página em português"></a>
            <a href="#"><img src="assets/english-icon.png" alt="language of the page in english"></a>
            <a href="#"><img src="assets/espanol-icon.png" alt="idioma del sitio en español"> </a>
          </li>
        </ul>
      </div>
      <!-- IMAGEM - LOGO DA PRODEMA -->
      <div class="nav-logo main">
        <img id="logo" src="assets/logo2.png" alt="logotipo da Prodema">
        <p>Doutorado em Desenvolvimento e Meio Ambiente</p>
      </div>
        <!-- Navbar sticky -->
        <nav id="navbar_top" class="navbar navbar-expand-md navbar-dark">
          <div class="container-fluid">
            <!-- LOGO NA BARRA -->
            <!-- <span class="navbar-brand mx-auto"><img class="logo" src="assets/logo-white.svg" alt="" width="40" height="40"></span> -->
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
                    <a href="pages/apresentacao.html">Apresentação</a>
                    <a href="pages/corpo-docente.html">Corpo Docente</a>
                    <a href="pages/processo-seletivo.html">Processo Seletivo</a>
                    <a href="pages/documentos-importantes.html">Documentos Importantes</a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="pages/estrutura-de-rede.html">Estrutura de rede</a>
                </li>
                <li class="nav-item dropdown">
                <button class="nav-link">Estrutura Curricular <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                <!-- DROPDOWN -->
                <div class="dropdown-content" style="visibility:hidden">
                    <a href="pages/area-de-concentracao.html">Área de concentração e linhas de pesquisa</a>
                    <a href="pages/disciplinas-obrigatorias.html">Disciplinas obrigatórias</a>
                    <a href="pages/disciplinas-optativas.html">Disciplinas optativas</a>
                    <a href="pages/seminarios-e-atividades.html">Seminários e atividades obrigatórias</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/mapa.html">Egressos</a>
                </li>
                <li class="nav-item dropdown">
                  <button class="nav-link">Comunicação <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
                  <!-- DROPDOWN -->
                  <div class="dropdown-content" style="visibility:hidden">
                      <a href="pages/noticias.php">Notícias</a>
                      <a href="pages/eventos.php">Eventos</a>
                      </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/fale-conosco.html">Fale conosco</a>
                </li>
            </ul>
              <!-- Barra de pesquisa -->
              <form class="d-flex" role="search" method="get" action="pages/busca.html">
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
        <section class="notification">
            <div class="py-2"> <!--Espaço antes do texto--> 
            </div>
            <div class="notification-content">
                <h1>Rede Prodema</h1>
                <p>O Curso de Doutorado em Desenvolvimento e Meio Ambiente, Associação Plena em Rede (UFPI, UFC, UFRN, UFPB, UFPE, UFS, UESC, e, mais recentemente, a UFERSA), qualifica recursos humanos em nível de doutorado interdisciplinar na Região Nordeste desde o ano de 2010, tendo contribuído para a formação de centenas de doutores. Antes disso, as Instituições se integravam através do Programa Regional de Pós-Graduação em Desenvolvimento e Meio Ambiente - autodenominado Rede PRODEMA - que atua em nível de Mestrado.</p>
                <p class="btn_info"><a class="btn btn-sm btn-outline-primary" href="pages/apresentacao.html">Mais informações</a></p>
            </div>
        </section>

        <!-- NOTICIAS E EVENTOS -->
        <section class="info">
            <div class="info-col1">
              <h1>Notícias</h1>
              <div id="noticias">
                <!-- ITENS DE NOTICIAS -->
<?php
    include('manager/connection.php'); 

    $sql_code = "SELECT `id`,`titulo`,`banner`,`data` FROM noticias ORDER BY data DESC LIMIT 4";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
    $count=1;
    $buttonVisible = 'hidden';
    while($noticias = $sql_query->fetch_assoc()){
      if($count < 4){
        ?>
          <a class="info-item" href="pages/noticia-page.php?id=<?php echo $noticias['id']?>">
            <figure class="info-img" title="imagem" alt="imagem">
            <img src="uploads/<?php echo $noticias['banner'] ?>" style="width:100px;height: 100px;object-fit: cover">
            </figure>
            <div class="info-title">
            <h2><?php echo $noticias['titulo'] ?></h2>
            <p><i class="fa-regular fa-calendar"></i> <?php echo date_format(new DateTime($noticias['data']),'d.m.Y') ?></p>
            </div>
          </a>
        <?php
      } else {
        $buttonVisible = 'visible';
      }
      $count++;
    }
?>
              </div>
              <a style="visibility:<?php echo $buttonVisible ?>" class="btn btn-sm btn-outline-primary ver-mais" href="pages/noticias.php">Ver mais...</a>
            </div>
            
            <!-- <div id="vertical-line"></div> -->
            
            <div class="info-col2">
              <h1>Eventos</h1>
              <div id="eventos">
                <!-- ITENS DE EVENTOS -->
<?php
    include('manager/connection.php');

    $sql_code = "SELECT * FROM eventos";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
    $count=1;
    $buttonVisible = 'hidden';
    while($eventos = $sql_query->fetch_assoc()){
      if($count < 4){
        ?>
          <a class="info-item" href="pages/evento-page.php?id=<?php echo $eventos['id']?>">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="uploads/<?php echo $eventos['banner'] ?>" style="width:100px;height: 100px;object-fit: cover">
          </figure>
          <div class="info-title">
            <h2><?php echo $eventos['titulo'] ?></h2>
            <p><i class="fa-regular fa-calendar"></i> <?php echo date_format(new DateTime($eventos['inicio']),'d.m.Y') . " à " . date_format(new DateTime($eventos['fim']),'d.m.Y')?></p>
          </div>
          </a>
        <?php
      } else {
        $buttonVisible = 'visible';
      }
      $count++;
    }
?>
                <a style="visibility:<?php echo $buttonVisible ?>" class="info-item" href="pages/evento-page1.html">
                  <figure class="info-img" title="imagem" alt="imagem">
                    <img src="uploads/evento1.jpg" style="width:100px;height: 100px;object-fit: cover;">
                  </figure>
                  <div class="info-title">
                    <h2>IV CURSO DE INTRODUÇÃO A ESTUDOS COM PEQUENOS MAMÍFEROS.</h2>
                    <p><i class="fa-regular fa-calendar"></i> 09.dez.2022 a 12.dez.2022</p>
                  </div>
                </a>
                
              </div>
              <a class="btn btn-sm btn-outline-primary ver-mais disabled" href="pages/eventos.php">Ver mais...</a>
            </div>
        </section>
        <!-- PROCESSOS SELETIVOS E DISCIPLINAS -->
        <section class="info">
          <div class="info-col1">
            <h1>Processos Seletivos</h1>
            <div id="processos">
              <p>Não há processos seletivos no momento</p>
            </div>
            
          </div>

          <!-- <div id="vertical-line"></div> -->

          <div class="info-col2">
            <h1>Disciplinas</h1>
            <div id="disciplinas">
              <p>Não há disciplinas no momento</p>
            </div>
            
          </div>
      </section>
      <section class="info">
          <div class="info-col3">
            <h1>Os Objetivos de Desenvolvimento Sustentável no Brasil</h1>
            <p>Os Objetivos de Desenvolvimento Sustentável são um apelo global à ação para acabar com a pobreza, proteger o meio ambiente e o clima e garantir que as pessoas, em todos os lugares, possam desfrutar de paz e de prosperidade. Estes são os objetivos para os quais as Nações Unidas estão contribuindo a fim de que possamos atingir a Agenda 2030 no Brasil.</p>
            <div id="onu-fig">
            <a href="https://brasil.un.org/pt-br/sdgs/1">
              <img src="../assets/onu1.svg" alt="Erradicação da pobreza">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/2">
              <img src="../assets/onu2.svg" alt="Fome zero e agricultura sustentável">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/3">
              <img src="../assets/onu3.svg" alt="Saúde e bem-estar">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/4">
              <img src="../assets/onu4.svg" alt="Educação de qualidade">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/5">
              <img src="../assets/onu5.svg" alt="Igualdade de gênero">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/6">
              <img src="../assets/onu6.svg" alt="Água potável e saneamento">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/7">
              <img src="../assets/onu7.svg" alt="Energia limpa e acessível">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/8">
              <img src="../assets/onu8.svg" alt="Trabalho descente e crescimento econômico">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/9">
              <img src="../assets/onu9.svg" alt="Industria, inovação e infraestrutura">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/10">
              <img src="../assets/onu10.svg" alt="Redução das desigualdades">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/11">
              <img src="../assets/onu11.svg" alt="Cidades e comunidades sustentáveis">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/12">
              <img src="../assets/onu12.svg" alt="Consumo e produção responsáveis">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/13">
              <img src="../assets/onu13.svg" alt="Ação contra a mudança global do clima">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/14">
              <img src="../assets/onu14.svg" alt="Vida na água">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/15">
              <img src="../assets/onu15.svg" alt="Vida terrestre">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/16">
              <img src="../assets/onu16.svg" alt="Paz, justiça e instituições eficazes">
            </a>
            <a href="https://brasil.un.org/pt-br/sdgs/17">
              <img src="../assets/onu17.svg" alt="Parcerias e meios de implementação">
            </a>
            </div>
            
          </div>
      </section>
        <!-- INSTITUTOS PARCEIROS -->
        <section class="parceiros">
          <h1>IES</h1>
          <div class="lista-brasoes">
            <a title="Universidade Federal do Piauí" class="brasao" href="https://ufpi.br/">
              <img src="assets/ufpi.png" alt="brasao da UFPI">
              <h6>UFPI</h4>
            </a>
            <a title="Universidade Federal do Ceará" class="brasao" href="https://www.ufc.br/">
              <img src="assets/ufc.png" alt="brasao da UFC">
              <h6>UFC</h4>
            </a>
            <a title="Universidade Federal Rural do Semi-Árido" class="brasao" href="https://ufersa.edu.br/">
              <img src="assets/ufersa.png" alt="brasao da UFERSA">
              <h6>UFERSA</h4>
            </a>
            <a title="Universidade Federal do Rio Grande do Norte" class="brasao" href="https://www.ufrn.br/">
              <img src="assets/ufrn.png" alt="brasao da UFRN">
              <h6>UFRN</h4>
            </a>
            <a title="Universidade Federal da Paraíba" class="brasao" href="https://www.ufpb.br/">
              <img src="assets/ufpb.png" alt="brasao da UFPB">
              <h6>UFPB</h4>
            </a>
            <a title="Universidade Federal do Pernambuco" class="brasao" href="https://www.ufpe.br/">
              <img src="assets/ufpe.png" alt="brasao da UFPE">
              <h6>UFPE</h4>
            </a>
            <a title="Universidade Federal de Sergipe" class="brasao" href="https://www.ufs.br/">
              <img src="assets/ufs.png" alt="brasao da UFS">
              <h6>UFS</h4>
            </a>
            <a title="Universidade Estadual de Santa Cruz" class="brasao" href="http://www.uesc.br/">
              <img src="assets/uesc.png" alt="brasao da UESC">
              <h6>UESC</h4>
            </a>
          </div>
        </section>
      </main>
      <!------------------------------------------>
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
              <a href="https://www.facebook.com/profile.php?id=100088104321284"><img src="assets/icon_facebook.png" alt="ícone do Facebook"></a>
              <a href="https://www.instagram.com/prodemadoutorado/"><img src="assets/icon_instagram.png" alt="ícone do Instagram"></a>
              <a href="https://www.youtube.com/@doutoradoemdesenvolvimento8960"><img src="assets/icon_youtube.png" alt="ícone do Youtube"></a>
              <a href="https://twitter.com/RedeProdema"><img src="assets/icon_twitter.png" alt="ícone do Twitter"></a>
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
    <script src="scripts/main.js"></script>
</body>
</html>