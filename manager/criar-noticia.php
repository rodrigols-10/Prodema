<?php
  include('protect-page.php');
  include('connection.php');
  $userMessage = "";
  function uploadImages($tmpName,$filename){
      $userMessage = "";
      //var_dump($_FILES['banner']);
      $folder = "../uploads/";
      $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
      
      if ($extension != 'jpg' &&  $extension != 'jpeg' && $extension != 'png' &&  $extension != 'webp' &&  $extension != 'svg' &&  $extension != 'gif') { //mudar isto restringindo o tipo no próprio input/file com image/*
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
      $conteudo = "<div style=\'text-align:center\'><p>" . $_POST['bannerlegend'] . "</p></div>";
      $conteudo = $conteudo . "<div>" . $_POST['conteudo'] . "</div>";
      echo $conteudo;
      $stop = false;
      $pos = 0;
      while(!$stop){
        $imagemX = "imagem" . $pos;
        $positionX = "position" . $pos;
        $sizeX = "size" . $pos;
        $legendX = "legend" . $pos;
        $conteudoX = "conteudo" . $pos;
        if(isset($_FILES[$imagemX])){
          $tmpimg = $_FILES[$imagemX]['tmp_name'];
          $imgName = $_FILES[$imagemX]['name'];
          $success = uploadImages($tmpimg, $imgName);
          if ($success){
            $finalSize = $_POST[$sizeX];
            if($finalSize == "") {$finalSize = "100%";} //Corrigir largura se estiver vazia.
            else {$finalSize = $finalSize . "px";}      //adicionando unidade de pixels à largura.

            switch ($_POST[$positionX]) {
              case 1:
                $conteudo = $conteudo . "<div style=\'width: 100%; float: none; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' style=\'width:100%\'><br> <p>" . $_POST[$legendX] . "</p></div>";
                break;
              case 2:
                $conteudo = $conteudo . "<div style=\'width: $finalSize; float: left; text-align: center; margin: 0px 1rem 0px 0px;\'><img src=\'../uploads/$imgName\' style=\'width: $finalSize;\'><br> <p>" . $_POST[$legendX] . "</p></div>";
                break;
              case 3:
                $conteudo = $conteudo . "<div style=\'width: $finalSize; float: right; text-align: center; margin: 0px 0px 0px 1rem;\'><img src=\'../uploads/$imgName\' style=\'width: $finalSize;\'><br> <p>" . $_POST[$legendX] . "</p></div>";
                break;
              case 4:
                $conteudo = $conteudo . "<div style=\'width: 100%; float: none; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' style=\'width: $finalSize;\'><br> <p>" . $_POST[$legendX] . "</p></div>";
                break;
              default:
                $conteudo = $conteudo . "<div style=\'width: 100%; float: none; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' style=\'width:100%\'><br> <p>" . $_POST[$legendX] . "</p></div>";
                break;
            }
          }
        } elseif (isset($_POST[$conteudoX])) {
          $conteudo = $conteudo . $_POST['conteudo'];
        } else {
          $stop = true;
        }
        $pos = $pos + 1;
      }
      $pos = 0;
      // if(isset($_FILES['imagens'])){
      //   $image = $_FILES['imagens'];
      //   foreach($image['name'] as $key => $img){          
      //     $success = uploadImages($image['tmp_name'][$key],$image['name'][$key]);
      //   }
      //   unset($img);
      // }
  
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
              <textarea name="titulo" id="titulo-input" rows="3" cols="50" onchange="document.querySelector('#titulo-output').innerHTML = document.querySelector('#titulo-input').value;" required></textarea>
            </div>
            <div class="fields">
              <label>Banner:<br>
              <input class="line" type="file" name="banner" id="banner-input" onchange="AddingBanner()" accept="image/*" required>
              </label>
              <label>Legenda (opcional):</label>
                <input style="width:100%" type="text" name="bannerlegend" id="bannerlegend" onchange="AddingInicialContent('bannerlegend')">
            </div>
            <div class="fields">
              <label>Conteúdo (em HTML):</label>
              <textarea id="conteudo-input" name="conteudo" rows="6" cols="50" onchange="AddingInicialContent('texto1')" required></textarea>
            </div>
            <div id="added-fields" class="fields">
            </div>
            <div id="add-fields">
              <button class="btn btn-sm btn-secondary" type="button" onclick="addImgForm()"><i class="fa-solid fa-plus"></i> Adicionar Imagem</button>
            </div>
            <!-- <div class="fields">
              <label>Imagens: </label>
              <input multiple class="line" type="file" name="imagens[]" accept="image/*" value="">
            </div> -->
            <div class="form-buttons">
                <button id="preview" class="btn btn-sm btn-primary" type="button">Visualizar</button>
                <input class="btn btn-sm btn-success" type="submit" value="Submit">
            </div>
            <!-- <input type="hidden" id="allcontent"> -->
          </form>
          <div id='formato' style="max-width:373px">
          <hr>
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
            </p>
          </div>
        </aside>

        <!-- ------------------ VISUALIZAÇÃO DA NOTÍCIA ---------------------- -->
        <article class="info-col1">
          <div class="title-info">
            <h1 id="titulo-output">TÍTULO AQUI</h1>
            <p id="data-atual"><i class="fa-regular fa-calendar"></i> --.--.--</p>
          </div>
          <div class="info-page-img">
            Banner aqui
            <!-- BANNER AQUI -->
          </div>
          <div id="conteudo-output">
          <div id="legenda-output" style="text-align:center">
            
          </div>
          <div id="texto1-output">
            <p>Conteúdo</p>
          </div>
            <!-- CONTEÚDO AQUI -->
          </div>
        </article>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- <script src="../scripts/main.js"></script> -->
    <script>
      const preview = document.querySelector("#preview");
      const outputDate = document.querySelector("#data-atual");

      let widthNow = [''];
      let stateWidth = [false];

      //ADICIONANDO DATA ATUAL
      let now = new Date();
      let month = (now.getMonth() < 9) ? ".0"+(now.getMonth()+1) : "."+(now.getMonth()+1);
      let nowStr = now.getDate() + month + "." + now.getFullYear();
      outputDate.innerHTML = "<i class='fa-regular fa-calendar'></i> " + nowStr;


      let addedFormContent = [];
      let totalContent = 0;
      let allContent = ["",'<p>conteudo</p>'];

      const inputBanner = document.querySelector("#banner-input");
      const outputBanner = document.querySelector(".info-page-img");
      outputBanner.innerHTML = "";

      const AddingBanner = function(){
        const file = inputBanner.files[0];

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
          // outputBanner.innerHTML = "Imagem não selecionada";
        }
      }

      // CLIQUE DO BOTÃO VISUALIZAR
      preview.addEventListener("click", function (e) {
        //TITULO
        // document.querySelector("#titulo-output").innerHTML = document.querySelector("#titulo-input").value;
        // DATA DA PUBLICAÇÃO
        
      });

      // CLIQUE DO BOTÃO <ADICIONAR IMAGEM>
      const addImgForm = function(){
        addedFormContent.push(`<div class="fields" style="max-width:373px; padding: 3px; border: 1px dashed #000">
                <label>Adicionar imagem na sequência: </label>
                <input class="line" type="file" name="imagem${totalContent}" id="imagem${totalContent}" onchange="AddingImg(${totalContent})" accept="image/*">
                <div style="display: flex; align-items: center; margin-top:7px;">
                  <label for="position${totalContent}1" onclick="larguraController(${totalContent}); AddingImg(${totalContent});">
                    <input type="radio" name="position${totalContent}" id="position${totalContent}1" value="1" checked>
                    <img src="../assets/fullW.png" alt="Preencher largura">
                  </label>
                  <label for="position${totalContent}2" onclick="larguraController(${totalContent}); AddingImg(${totalContent});">
                    <input type="radio" name="position${totalContent}" id="position${totalContent}2" value="2" >
                    <img src="../assets/left.png" alt="Posicionar à esquerda">
                  </label>
                  <label for="position${totalContent}3" onclick="larguraController(${totalContent}); AddingImg(${totalContent});">
                    <input type="radio" name="position${totalContent}" id="position${totalContent}3" value="3" >
                    <img src="../assets/right.png" alt="Posicionar à direita">
                  </label>
                  <label for="position${totalContent}4" onclick="larguraController(${totalContent}); AddingImg(${totalContent});">
                    <input type="radio" name="position${totalContent}" id="position${totalContent}4" value="4" >
                    <img src="../assets/center.png" alt="Posicionar ao centro">
                  </label>
                  <div style="display:inline-block; margin-left: 1rem;">
                    <label> LARGURA: </label>
                    <br>
                    <input style="width:64px" type="number" min="0" id="size${totalContent}" name="size${totalContent}" onchange="AddingImg(${totalContent})" placeholder="100%" disabled>
                  </div>
                  
                </div>
                <label>Legenda (opcional):</label>
                <input style="width:100%" type="text" name="legend${totalContent}" onchange="AddingImg(${totalContent})">
              </div>`)
        document.querySelector('#added-fields').insertAdjacentHTML( 'beforeEnd', addedFormContent[totalContent]);
        document.querySelector('#add-fields').innerHTML =`
        <button class="btn btn-sm btn-secondary" type="button" onclick="addImgForm()"><i class="fa-solid fa-plus"></i> Adicionar Imagem</button>
        <button class="btn btn-sm btn-secondary" type="button" onclick="addTextForm()"><i class="fa-solid fa-plus"></i> Adicionar Texto</button>
        `;

        document.querySelector('#conteudo-output').insertAdjacentHTML('beforeEnd', `<div id='img${totalContent}'></div>`);
        widthNow[totalContent] = '';
        totalContent++;
      }

      const addTextForm = function(){
        addedFormContent.push(`<div class="fields">
              <label>Conteúdo (em HTML):</label>
              <textarea id="conteudo${totalContent}" name="conteudo${totalContent}" rows="5" cols="50" onchange="AddingExtraContent(${totalContent})" required></textarea>
            </div>`);
        document.querySelector('#added-fields').insertAdjacentHTML( 'beforeEnd', addedFormContent[totalContent]);
        document.querySelector('#add-fields').innerHTML =`
        <button class="btn btn-sm btn-secondary" type="button" onclick="addImgForm()"><i class="fa-solid fa-plus"></i> Adicionar Imagem</button>
        `;
        document.querySelector('#conteudo-output').insertAdjacentHTML('beforeEnd', `<div id='content${totalContent}'></div>`);
        totalContent++;
      }

      const larguraController = function(position){
        const larguraField = document.getElementById("size"+position);
        if(document.getElementById("position"+position+"1").checked){
          larguraField.disabled = true;
          if(stateWidth[position]) widthNow[position] = larguraField.value;
          stateWidth[position] = false;
          larguraField.value = "";
          larguraField.placeholder = "100%";
        } else {
          larguraField.disabled = false;
          console.log(widthNow[position]);
          if(!stateWidth[position]) larguraField.value = widthNow[position];
          stateWidth[position] = true;
          // larguraField.value = larguraField.placeholder == "100%" ? "" : larguraField.value;
          larguraField.placeholder = "pixels";
        }
      }

      const AddingImg = function(position){
        const selectInput = "#imagem"+position;
        const selectOutput = "#img"+position;
        const file = document.querySelector(selectInput).files[0];
        let ImgPosition = document.querySelector("input[name='position"+position+"']:checked").value;
        let imgLegend = document.querySelector("input[name='legend"+position+"']").value;
        if (file) {
          const reader = new FileReader();

          reader.addEventListener("load", function (e) {
            const readerTarget = e.target;
            
            const img = document.createElement("img");
            img.src = readerTarget.result;
            switch (ImgPosition) {
              case '1':
                img.style.width = "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                break;
              case '2':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.float = "left";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0 1rem 0 0";
                break;
              case '3':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.float = "right";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0 0 0 1rem";
                break;
              case '4':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                break;
              default:
                img.style.width = "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                break;
            }
            // img.classList.add("picture__img");
            document.querySelector(selectOutput).innerHTML = "";
            document.querySelector(selectOutput).appendChild(img);
            document.querySelector("#img"+position).insertAdjacentHTML( 'beforeEnd', "<br> <p>"+imgLegend+"</p>");
          });        
          reader.readAsDataURL(file);
        }
      }

      const AddingExtraContent = function(position){
        console.log(document.querySelector('#conteudo'+position));
        document.querySelector('#content'+position).innerHTML = document.querySelector('#conteudo'+position).value;
      }

      const AddingInicialContent = function(type){
        
        switch (type) {
          case 'bannerlegend':
            document.querySelector('#legenda-output').innerHTML = "<p>"+document.querySelector('#bannerlegend').value+"</p>";
            break;
          case 'texto1':
            document.querySelector('#texto1-output').innerHTML = document.querySelector('#conteudo-input').value;
            break;
          default:
            break;
        }
      }

    </script>
</body>
</html>