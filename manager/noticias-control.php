<?php
    include('protect-page.php');
?>
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
    <header style="background-color:#005da9">
        <div class="options">
        <ul style="display:flex; justify-content:space-between;">
            <li style="visibility: visible; height: 100%">
            <a href="painel.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
            <a href="logout.php" title="Sair do sistema"><i alt="Sair do sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
            </li>
        </ul>
        </div>
    </header>
    <main>
      <section class="info">
        <article class="info-col1">
          <div class="title-emphasis">
            <h1>NOTÍCIAS</h1>
          </div>
          <div id="noticias">
            <!-- ITENS DE NOTICIAS -->
            <a href="criar-noticia.php" class="info-item" style="justify-content:center;align-items:center;height:100px;border:2px solid #ccc;border-radius:10px;">
            <i style="font-size: 2rem; color:gray;" class="fa-solid fa-plus"></i> <span style="font-size: 1.5rem; color:gray;font-weight:bold;">NOVA NOTÍCIA</span>
            </a>
<?php
    include('connection.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];  
        $sql_code = "DELETE FROM `noticias` WHERE `noticias`.`id` = $id";  
        $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");  
        if ($sql_query) {  
             header('location:noticias-control.php');  
        }else{  
             echo "Error: ".mysqli_error($mysqli);  
        }  
    }  

    $sql_code = "SELECT * FROM noticias ORDER BY data DESC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      
    while($noticias = $sql_query->fetch_assoc()){
        ?>
        <div style="display:flex; flex-wrap:nowrap; justify-content: space-between;align-items:center;">
            <div class="info-item" style="background-color:white;">
                <figure class="info-img" title="imagem" alt="imagem">
                <img src="../uploads/<?php echo $noticias['banner'] ?>" style="width:100px;height: 100px;object-fit: cover">
                </figure>
                <div class="info-title">
                <h2><?php echo $noticias['titulo'] ?></h2>
                <p><i class="fa-regular fa-calendar"></i> <?php echo date_format(new DateTime($noticias['data']),'d.m.Y') ?></p>
                </div>
            </div>
            <a class="info-item" style="color: red; font-size: 2rem; margin: auto 1rem; padding: 1rem" href="noticias-control.php?id=<?php echo $noticias['id']?>">
                <i class="fa-solid fa-trash-can"></i>
                </a>
        </div>
        <?php
    }
?>
          </div>
        </article>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="../scripts/main.js"></script> -->
</body>
</html>