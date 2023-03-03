<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema Doutorado | Corpo Docente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/pages.css">
    <style>
      .docente-link{
        color: black;
      }
      .docente-link:hover{
        color: gray;
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
                  <button class="nav-link">Comunicação <i aria-hidden="true" class="fa-solid fa-angle-down"></i></button>
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
      <section class="info">
        <article class="info-col1">
          <div class="title-emphasis">
            <h1>Corpo docente</h1>
          </div>
          <br>
          <div class="texto-corpo">

<?php
    include('../manager/connection.php'); 
    
    //CONTAGEM DOS DOCENTES
    $sql_code = "SELECT COUNT(nome) as qtd_docentes FROM docentes";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    $qtdDocentes = $sql_query->fetch_assoc();

    //CONTAGEM DAS INSTITUIÇÕES
    $sql_code = "SELECT COUNT(DISTINCT instituicao) AS qtd_ies FROM docentes";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página

    $qtdInstituicoes = $sql_query->fetch_assoc();
?>
            <p style="font-size: small;">Contamos com um total de <?php echo $qtdDocentes['qtd_docentes'] ?> Docentes, vinculados às <?php echo $qtdInstituicoes['qtd_ies'] ?> Universidades integrantes da Rede, conforme listagem a&nbsp;seguir.</p>
            <br>

            <div class="title-emphasis subtitle">
              <h1 style="font-size: medium;"><strong>Universidade Federal do Piauí - UFPI</strong></h1>
            </div>
<?php    
    //Consultando os docentes da UFPI
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFPI' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
              <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
            </figure>
            <div class="info-title">
                <h2 style="margin-top:10px;font-size:0.9rem">
                <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
                </h2>
            </div>
        </div>  
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><span>Universidade Federal do Ceará - UFC</span></strong></span></h1>
            </div>
<?php    
    //Consultando os docentes da UFC
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFC' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
          </figure>
          <div class="info-title">
              <h2 style="margin-top:10px;font-size:0.9rem">
              <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
              </h2>
          </div>
        </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><span>Universidade Federal do Rio Grande do Norte - UFRN</span></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UFRN
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFRN' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
          <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
            <figure class="info-img" title="imagem" alt="imagem">
              <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
            </figure>
            <div class="info-title">
                <h2 style="margin-top:10px;font-size:0.9rem">
                <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
                </h2>
            </div>
          </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>                     
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><a title="UFERSA" href="https://prodema.ufersa.edu.br" target="_blank"><span>UFERSA</span></a></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UFERSA
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFERSA' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
          </figure>
          <div class="info-title">
              <h2 style="margin-top:10px;font-size:0.9rem">
              <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
              </h2>
          </div>
        </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><a title="UFPB" href="https://sigaa.ufpb.br/sigaa/public/programa/portal.jsf?lc=pt_BR&amp;id=3338" target="_blank"><span>UFPB</span></a></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UFPB
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFPB' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
          <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
            <figure class="info-img" title="imagem" alt="imagem">
              <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
            </figure>
            <div class="info-title">
                <h2 style="margin-top:10px;font-size:0.9rem">
                <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
                </h2>
            </div>
          </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><a title="UFPE" href="https://www.ufpe.br/prodema" target="_blank"><span>UFPE</span></a></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UFPE
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFPE' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
          </figure>
          <div class="info-title">
              <h2 style="margin-top:10px;font-size:0.9rem">
              <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
              </h2>
          </div>
        </div>  
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><a title="UFS" href="https://www.sigaa.ufs.br/sigaa/public/programa/portal.jsf?lc=pt_BR&amp;id=843" target="_blank"><span>UFS</span></a></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UFS
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UFS' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
          </figure>
          <div class="info-title">
              <h2 style="margin-top:10px;font-size:0.9rem">
              <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
              </h2>
          </div>
        </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
            <br>
            <div class="title-emphasis subtitle">
              <h1><span style="font-size: medium;"><strong><a title="UESC" href="https://nbcgib.uesc.br/ppgdma/" target="_blank"><span>UESC</span></a></strong></span></h1>
            </div>
<?php
    //Consultando os docentes da UESC
    $sql_code = "SELECT `nome`,`curriculo`,`instituicao`,`objetivo`,`foto` FROM docentes WHERE instituicao='UESC' ORDER BY `nome`";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição" . $mysqli->error); //apagar o mysqli->error ao final. Ele desformata a página
      
    while($docentes = $sql_query->fetch_assoc()){
        $link=false;
        if($docentes['curriculo']!="" && $docentes['curriculo']!=NULL && $docentes['curriculo']!="--" && $docentes['curriculo']!='0') $link = true;
        ?>
        <div <?php if($link) echo "class='info-item'" ?> style="display: flex;flex-direction: row; flex-wrap:wrap; align-items: center;gap: 10px;margin-bottom: 0.6rem;text-decoration: none;color: black;padding:3px;">
        <div style="display: flex;flex-direction: row; flex-wrap:nowrap; gap: 10px;">
          <figure class="info-img" title="imagem" alt="imagem">
            <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png"; ?>" style="width:60px;height: 60px;object-fit: cover;border-radius:3px">
          </figure>
          <div class="info-title">
              <h2 style="margin-top:10px;font-size:0.9rem">
              <?php if($link){?> <a class="docente-link"  href="<?php echo $docentes['curriculo']; ?>" target="_blank"> <?php echo $docentes['nome']."</a>"; } else echo $docentes['nome'];?>
              </h2>
          </div>
        </div>
          <div style="display:flex;flex-wrap:wrap;margin-left:1rem">
            <?php
            if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                $separator = explode(",",$docentes['objetivo']);
                foreach ($separator as $value) {
                  if($value!=NULL && $value!="" && $value!='0'){
                    ?>
                    <a href="https://brasil.un.org/pt-br/sdgs/<?php echo $value ?>" target="_blank">
                      <img src="../assets/onu<?php echo $value . ".svg";?>" style="width:50px;height: 50px;object-fit: cover;margin: 2px">
                    </a>
                    <?php
                  }
                }
            }
            ?>
          </div>
        </div> 
        <?php
  }
?>
        </div>
        </article>
        <aside class="info-col2">
          <div class="title-emphasis subtitle side">
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
</body>
</html>