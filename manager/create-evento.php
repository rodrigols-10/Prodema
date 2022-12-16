<?php
  include('protect-page.php');
  include('connection.php');
  $userMessage = "";
  function uploadImages($tmpName,$filename){
      $userMessage = "";
      //var_dump($_FILES['banner']);
      $folder = "../uploads/";
      $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
      
      if ($extension != 'jpg' && $extension != 'png') {
        $userMessage = "Formato de arquivo não aceito. Somente .jpg e .png são permitidos.";
        //die("Formato de arquivo não aceito. Somente .jpg e .png são permitidos.");
      } else  {
        $sendImage = move_uploaded_file($tmpName, $folder . $filename);
        if($sendImage){
          $userMessage = "Arquivo enviado com sucesso!";
          return true;
        } else {
          $userMessage = "Falha ao enviar arquivo";
          return false;
        }
      }
  }

    if(isset($_POST['titulo']) && $_POST['titulo']){
      $bannerName = 'default.png';
      if(isset($_FILES['banner'])){
        $tmpBanner = $_FILES['banner']['tmp_name'];
        $bannerName = $_FILES['banner']['name'];
        $success = uploadImages($tmpBanner, $bannerName);
        if (!$success){
          $bannerName = 'default.png';
        }
      }
      $titulo = $_POST['titulo'];
      $conteudo = $_POST['conteudo'];
      $inicio = $_POST['inicio'];
      $fim = $_POST['fim'];
      $horario = $_POST['horario'];
      $inscricoes = $_POST['inscricoes'];

      if(isset($_FILES['imagens'])){
        $image = $_FILES['imagens'];
        foreach($image['name'] as $key => $img){          
          $success = uploadImages($image['tmp_name'][$key],$image['name'][$key]);
        }
        unset($img);
      }
  
      $sql_code = "INSERT INTO eventos (titulo, banner, conteudo, inicio, fim, horario, inscricoes) VALUES ('$titulo', '$bannerName', '$conteudo', '$inicio', '$fim', '$horario', '$inscricoes')";
      $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
      if ($sql_query) {
          header('Location:eventos-control.php'); 
          exit();
      }else{  
          echo "Error: ".mysqli_error($mysqli);  
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema - Criar Notícia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="pages.css">
</head>
<body>
<header style="width: 100%;background-color:#005da9">
        <div class="options">
        <ul style="display:flex; justify-content:space-between;">
            <li style="visibility: visible; height: 100%">
            <a href="noticias-control.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
            <a href="logout.php" title="Sair do sistema"><i alt="Sair do sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
            </li>
        </ul>
        </div>
        <div style="background-color: #a8c9ff; text-align: center;">
        <p style="margin:0;">
<?php
    echo $userMessage;
?>
        </p> 
        </div>
    </header>
    <main>
      <section class="info">
        <article class="info-col1">
          <div class="title-emphasis">
            <h1>NOTÍCIA</h1>
          </div>
          
          <form class="creation" action="" method="POST" enctype="multipart/form-data">
            <div>
            <label>Título: </label>
              <textarea name="titulo" rows="4" cols="50" required></textarea>
            </div>
            <div>
              <label>Banner: </label>
              <input class="line" type="file" name="banner" value="">
            </div>
            <div>
              <label>Início: </label>
              <input class="line" type="date" name="inicio" value="" required>
            </div>
            <div>
              <label>Fim: </label>
              <input class="line" type="date" name="fim" value="" required>
            </div>
            <div>
              <label>Horário: </label>
              <input class="line" type="time" name="horario" value="">
            </div>
            <div>
              <label>Inscrições: </label>
              <input class="line" type="text" name="inscricoes" value="">
            </div>
            <div>
              <label>Conteúdo:</label>
              <textarea name="conteudo" rows="15" cols="50" required></textarea>
            </div>
            <div>
              <label>Imagens: </label>
              <input multiple class="line" type="file" name="imagens[]" value="">
            </div>
            
            <input class="btn btn-sm btn-success submit" type="submit" value="Submit">
          </form>
        </article>
        <aside class="info-col2">
            <div class="title-emphasis side">
              <h1>FORMATAÇÃO DO TEXTO</h1>
            </div>
            <p>Use o editor HTML para formatar o conteúdo da notícia e cole no campo "Conteúdo":</p>
            <p><a href="https://htmled.it/editor-html/" target="_blank" rel="noopener noreferrer">Editor HTML Online</a></p>
            <p>***OBS: Para adicionar imagens, faça upload delas em "Imagens" e no editor insira na localização da imagem: "../uploads/"+ nome da imagem junto da extensão.
              <br>
              Exemplos:
              <br>
              ../uploads/noticia.jpg
              <br>
              ../uploads/grande-evento.png
              <br>
              ../uploads/foto.jpg
            </p>
          </aside>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="../scripts/main.js"></script> -->
</body>
</html>