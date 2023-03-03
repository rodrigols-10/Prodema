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
      $tratamento = $_POST['titulo'];//tratando o texto do documento para evitar erros com ' " e ’
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $titulo = $tratamento;
      $inicio = $_POST['inicio'];
      $fim = $_POST['fim'];
      $horario = $_POST['horario'];

      $tratamento = $_POST['inscricoes'];//tratando o texto do documento para evitar erros com ' " e ’
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $inscricoes = $tratamento;

      $tratamento = $_POST['bannerlegend'];//tratando o texto do documento para evitar erros com ' " e ’
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $conteudo = "<div style=\'text-align:center\'><p>" . $tratamento . "</p></div>";

      $tratamento = $_POST['conteudo'];//tratando o texto do documento para evitar erros com ' " e ’
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $conteudo = $conteudo . "<div>" . $tratamento . "</div>";
      // echo $conteudo;
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

            $tratamento = $_POST[$legendX];//tratando o texto do documento para evitar erros com ' " e ’
            $tratamento = str_replace("’", "\'", $tratamento);
            $tratamento = str_replace("'", "\'", $tratamento);
            $tratamento = str_replace('"', '\"', $tratamento);

            switch ($_POST[$positionX]) {
              case 1:
                $conteudo = $conteudo . "<div style=\'width: 100%; float: none; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' style=\'width:100%\'><br> <p>" . $tratamento . "</p></div>";
                break;
              case 2:
                $conteudo = $conteudo . "<style> .imgsize$pos{width:$finalSize;float: left} @media (max-width: 800px){ .imgsize$pos{width:100%;float: none} }</style><div class=\'imgsize$pos\' style=\'text-align: center; margin: 0px 1rem 0px 0px;\'><img src=\'../uploads/$imgName\' style=\'width:100%;\'><br> <p>" . $tratamento . "</p></div>";
                break;
              case 3:
                $conteudo = $conteudo . "<style> .imgsize$pos{width:$finalSize;float: right; margin: 0px 0px 0px 1rem;} @media (max-width: 800px){ .imgsize$pos{width:100%;float: none;margin:0} }</style><div class=\'imgsize$pos\' style=\'text-align: center;\'><img src=\'../uploads/$imgName\' style=\'width: 100%;\'><br> <p>" . $tratamento . "</p></div>";
                break;
              case 4:
                $conteudo = $conteudo . "<style> .imgsize$pos{width:$finalSize;} @media (max-width: 800px){ .imgsize$pos{width:100%;} }</style><div style=\'width: 100%; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' class=\'imgsize$pos\'><br> <p>" . $tratamento . "</p></div>";
                break;
              default:
                $conteudo = $conteudo . "<div style=\'width: 100%; float: none; text-align: center; margin: 0px;\'><img src=\'../uploads/$imgName\' style=\'width:100%\'><br> <p>" . $tratamento . "</p></div>";
                break;
            }
          }
        } elseif (isset($_POST[$conteudoX])) {
          $tratamento = $_POST[$conteudoX];//tratando o texto do documento para evitar erros com ' " e ’
          $tratamento = str_replace("’", "\'", $tratamento);
          $tratamento = str_replace("'", "\'", $tratamento);
          $tratamento = str_replace('"', '\"', $tratamento);
          $conteudo = $conteudo . $tratamento;
        } else {
          $stop = true;
        }
        $pos = $pos + 1;
      }
      $pos = 0;

      $tratamento = $bannerName;//tratando o texto do documento para evitar erros com ' " e ’
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $bannerName = $tratamento;

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
    <title>Prodema Doutorado | Criar Evento</title>

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
            <a href="eventos-control.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
              <strong style="color: white">CRIAR EVENTO</strong>
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
              <textarea name="titulo" id="titulo-input" rows="3" cols="50" onchange="document.querySelector('#titulo-output').innerHTML = document.querySelector('#titulo-input').value;" onkeydown="javascript: return PreventEnterSubmit(event)" required></textarea>
            </div>
            <div class="fields">
              <label>Banner:<br>
              <input class="line" type="file" name="banner" id="banner-input" onchange="AddingBanner()" accept="image/*">
              </label>
              <label>Legenda (opcional):</label>
                <input style="width:100%" type="text" name="bannerlegend" id="bannerlegend" onchange="AddingInicialContent('bannerlegend')" onkeydown="javascript: return PreventEnterSubmit(event)">
            </div>
            <div class="fields">
              <label>Início: </label>
              <input class="line" type="date" name="inicio" value="" onchange="AddingInicio()" required>
            </div>
            <div class="fields">
              <label>Fim: </label>
              <input class="line" type="date" name="fim" value="" onchange="AddingFim()" required>
            </div>
            <div class="fields">
              <label>Horário: </label>
              <input class="line" type="time" name="horario" onchange="AddingHorario()" value="">
            </div>
            <div class="fields">
              <label>Inscrições: </label>
              <input class="line" type="text" name="inscricoes" onchange="AddingInscricoes()" value="">
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
            <div class="form-buttons">
                <input class="btn btn-sm btn-success" type="submit" value="Submit">
            </div>
          </form>
          <div id='formato' style="max-width:373px">
          <hr>
            <h1>FORMATAÇÃO DO TEXTO</h1>
            <br>
            <p>Use o editor HTML para formatar o conteúdo da notícia e cole no campo "Conteúdo":</p>
            <p><a href="https://htmled.it/editor-html/" target="_blank" rel="noopener noreferrer">Editor HTML Online</a></p>
            <br>
            <p>Para adicionar links no texto, dentro do editor HTML:</p>
            <ul>
              <li>posicione o cursor ( "|" piscando) no ponto desejado ou selecione o trecho que deseja transformar em link;</li>
              <li>Clique no ícone da corrente chamada de "inserir/editar ligação";</li>
              <li>na pequena janela que abrirá, cole o seu link no campo URL;</li>
              <li>Em "Texto a exibir" coloque o texto que será mostrado no lugar do link, como "CLIQUE AQUI", alguma frase que faça sentido ou repita o próprio link que colocou em "URL" (é comum fazer isso);</li>
              <li>No campo "Título" se coloca o que gostaria de ser mostrado quando passar o mouse por cima (é opcional, pode ser deixado em branco)</li>
              <li>No campo "Alvo" se escolhe se deseja abrir o link na mesma aba (opção "Nenhum") ou em uma aba diferente (opção "Nova Janela").</li>
            </ul>
          </div>
        </aside>

        <!-- ------------------ VISUALIZAÇÃO DA NOTÍCIA ---------------------- -->
        <article class="info-col1">
          <div class="title-info">
            <h1 id="titulo-output">TÍTULO AQUI</h1>
            <div class="cronograma">
                <p><i class="fa-regular fa-calendar"></i> <span id="inicio-output">--.--.--</span> à <span id="fim-output">--.--.--</span></p>
                <p><i class="fa-regular fa-clock"></i> Horário: <span id="horario-output"></span></p>
                <p> Inscrições: <span id="inscricoes-output"></span></p>
            </div>
          </div>
          <div class="info-page-img">
            <!-- BANNER AQUI -->
          </div>
          <div id="conteudo-output">
          <div id="legenda-output" style="text-align:center">
            
          </div>
          <div id="texto1-output">
            <p>Corpo da notícia aqui</p>
          </div>
            <!-- CONTEÚDO EXTRA AQUI -->
          </div>
        </article>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script>

      //ADICIONANDO DATA ATUAL
      // const outputDate = document.querySelector("#data-atual");
      // let now = new Date();
      // let month = (now.getMonth() < 9) ? ".0"+(now.getMonth()+1) : "."+(now.getMonth()+1);
      // let nowStr = now.getDate() + month + "." + now.getFullYear();
      // outputDate.innerHTML = "<i class='fa-regular fa-calendar'></i> " + nowStr;

      //VARIAVEIS DE CONTROLE PARA A ADIÇÃO DE NOVOS CAMPOS E COMPORTAMENTO
      let addedFormContent = [];
      let totalContent = 0;
      let allContent = ["",'<p>conteudo</p>'];
      let widthNow = [''];
      let stateWidth = [false];

      const inputBanner = document.querySelector("#banner-input");
      const outputBanner = document.querySelector(".info-page-img");
      outputBanner.innerHTML = "";

      //PREVENINDO SUBMISSÃO DO FORM POR PRESSIONAR ENTER
      const PreventEnterSubmit = function(e) {
        let boolean = true;
        if(e.keyCode === 13) {
          boolean = false;
        }
        return boolean;
      }

      //ADICIONANDO O BANNER NA PRÉVIA
      const AddingBanner = function(){
        const file = inputBanner.files[0];

        if (file) {
          const reader = new FileReader();

          reader.addEventListener("load", function (e) {
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src = readerTarget.result;
            outputBanner.innerHTML = "";
            outputBanner.appendChild(img);
          });

          reader.readAsDataURL(file);
        } else {
        }
      }

      const AddingInicio = function(){
        let inicio = document.querySelector("input[name='inicio']").value;
        if(inicio.includes("-")) inicio = inicio.split('-').reverse().join('.');
        document.querySelector("#inicio-output").innerHTML = inicio;
      }
      const AddingFim = function(){
        let fim = document.querySelector("input[name='fim']").value;
        if(fim.includes("-")) fim = fim.split('-').reverse().join('.'); //transforma a data de yyyy-mm-dd para dd.mm.yyyy
        document.querySelector("#fim-output").innerHTML = fim;
      }
      const AddingHorario = function(){
        document.querySelector("#horario-output").innerHTML = document.querySelector("input[name='horario']").value;
      }
      const AddingInscricoes = function(){
        document.querySelector("#inscricoes-output").innerHTML = document.querySelector("input[name='inscricoes']").value;
      }


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
                    <input style="width:64px" type="number" min="0" id="size${totalContent}" name="size${totalContent}" onchange="AddingImg(${totalContent})" placeholder="100%" onkeydown="javascript: return PreventEnterSubmit(event)" disabled>
                  </div>
                  
                </div>
                <label>Legenda (opcional):</label>
                <input style="width:100%" type="text" name="legend${totalContent}" onchange="AddingImg(${totalContent})" onkeydown="javascript: return PreventEnterSubmit(event)">
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
            // let imgclassList = img.classList;
            // while (imgclassList.length > 0) {
            //   imgclassList.remove(imgclassList.item(0));
            // }
            switch (ImgPosition) {
              case '1':
                img.style.width = "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                // imgclassList.add("img-full");

                break;
              case '2':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.float = "left";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0 1rem 0 0";
                // imgclassList.add("img-left");
                // document.querySelector("#img"+position).classList.add("img-left");
                break;
              case '3':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.float = "right";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0 0 0 1rem";
                // imgclassList.add("img-right");
                // document.querySelector("#img"+position).classList.add("img-right");
                break;
              case '4':
                img.style.width = document.querySelector("#size"+position).value != "" ? document.querySelector("#size"+position).value+"px" : "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                // imgclassList.add("img-center");
                break;
              default:
                img.style.width = "100%";
                document.querySelector("#img"+position).style.width = "100%";
                document.querySelector("#img"+position).style.float = "none";
                document.querySelector("#img"+position).style.textAlign = "center";
                document.querySelector("#img"+position).style.margin = "0";
                // imgclassList.add("img-full");
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