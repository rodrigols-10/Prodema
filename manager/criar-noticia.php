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
    
    $userMessage = "";
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
  
      if(isset($_FILES['imagens'])){
        $image = $_FILES['imagens'];
        foreach($image['name'] as $key => $img){          
          $success = uploadImages($image['tmp_name'][$key],$image['name'][$key]);
        }
        unset($img);
      }
  
      $sql_code = "INSERT INTO noticias (titulo, banner, conteudo) VALUES ('$titulo', '$bannerName', '$conteudo')";
      $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
      if ($sql_query) {
          header('Location:noticias-control.php'); 
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
      <header style="width: 100%;background-color:#005da9;">
        <div class="options">
        <ul style="display:flex; justify-content:space-between;">
            <li style="visibility: visible; height: 100%">
            <a href="noticias-control.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
              <strong style="color: white">CRIAR NOTÍCIA</strong>
            </li>
            <li>
            <a href="logout.php" title="Sair do sistema"><i alt="Sair do sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
            </li>
        </ul>
        </div>
        <div style="background-color: #a8c9ff; text-align: center; width:100%">
        <p style="margin:0;">
<?php
    echo $userMessage;
?>
        </p> 
        </div>
    </header>
    <main>
      <section class="info">
        <aside class="info-create">

          <!-- ------------------ FORMULARIO ---------------------- -->
          
          <form class="creation" action="" method="POST" enctype="multipart/form-data">
            <div class="fields">
            <label>Título: </label>
              <textarea name="titulo" id="titulo-input" rows="3" cols="50" required></textarea>
            </div>
            <div class="fields">
              <label>Banner:<br>
              <input class="line" type="file" name="banner" id="banner-input">
              </label>
            </div>
            <div class="fields">
              <label>Conteúdo:</label>
              <textarea id="conteudo-input" name="conteudo" rows="12" cols="50" required></textarea>
            </div>
            <div class="fields">
              <label>Imagens: </label>
              <input multiple class="line" type="file" name="imagens[]" value="">
            </div>
            <div class="form-buttons">
                <button id="preview" class="btn btn-sm btn-primary" type="button">Visualizar</button>
                <input class="btn btn-sm btn-success" type="submit" value="Submit">
            </div>
          </form>
          <div id='formato' style="max-width:373px">
            
          </div>
        </aside>

        <!-- ------------------ VISUALIZAÇÃO DA NOTÍCIA ---------------------- -->
        <article class="info-col1">
          <div class="title-info">
            <h1 id="titulo-output">FORMATAÇÃO DO TEXTO</h1>
            <p id="data-atual"><i class="fa-regular fa-calendar"></i> --.--.--</p>
          </div>
          <div class="info-page-img">
          </div>
          <div id="conteudo-output">
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
          </div>
        </article>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="../scripts/main.js"></script> -->
    <script>
      const inputFile = document.querySelector("#banner-input");
      // const inputTitulo = document.querySelector("#titulo-input");
      const preview = document.querySelector("#preview");
      // const outputTitulo = document.querySelector("#titulo-output");
      const outputDate = document.querySelector("#data-atual");
      const outputBanner = document.querySelector(".info-page-img");
      outputBanner.innerHTML = "";

      preview.addEventListener("click", function (e) {

        //TITULO
        document.querySelector("#titulo-output").innerHTML = document.querySelector("#titulo-input").value;
        // DATA DA PUBLICAÇÃO
        let now = new Date();
        let month = (now.getMonth() < 9) ? ".0"+(now.getMonth()+1) : "."+(now.getMonth()+1);
        let nowStr = now.getDate() + month + "." + now.getFullYear();
        outputDate.innerHTML = "<i class='fa-regular fa-calendar'></i> " + nowStr;

        const inputTarget = e.target;
        const file = inputFile.files[0];

        if (file) {
          const reader = new FileReader();

          reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            // img.classList.add("picture__img");
            outputBanner.innerHTML = "";
            outputBanner.appendChild(img);
          });

          reader.readAsDataURL(file);
        } else {
          pictureImage.innerHTML = "Imagem não selecionada";
        }
        document.querySelector('#conteudo-output').innerHTML = document.querySelector('#conteudo-input').value;
        // APENAS INFORMAÇÃO PARA O USUARIO
        document.querySelector('#formato').innerHTML = `<hr>
            <h1>FORMATAÇÃO DO TEXTO</h1>
            <br>
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
            </p>`;

      });
    </script>
</body>
</html>