<?php
  include('protect-page.php');
  include('connection.php');
  $userMessage = "";
  function uploadFile($tmpName,$filename){
      $userMessage = "";
      //var_dump($_FILES['banner']);
      $folder = "../documents/";
      $sendFile = move_uploaded_file($tmpName, $folder . $filename);

      if($sendFile){
        $userMessage = "Arquivo enviado com sucesso!";

        return true;
        
      } else {
        $userMessage = "Falha ao enviar arquivo";
        return false;
      }
      // }
  }
    
    $userMessage = "";
    if(isset($_POST['titulo']) && $_POST['titulo']){
      $tratamento = $_POST['titulo']; //tratando o texto do documento para evitar erros
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $titulo = $tratamento;
      $fim = $_POST['fim'];
      $conteudo = "";
      $tratamento = $_POST['conteudo']; //tratando o texto do documento para evitar erros
      $tratamento = str_replace("’", "\'", $tratamento);
      $tratamento = str_replace("'", "\'", $tratamento);
      $tratamento = str_replace('"', '\"', $tratamento);
      $conteudo = $conteudo . "<div>" . $tratamento . "</div>";
      echo $conteudo;
      $stop = false;
      $pos = 0;
      $documentos = "";
      while(!$stop){
        $documentoX = "documento" . $pos;
        $nameDoc = "nameDoc" . $pos;
        if(isset($_FILES[$documentoX])){
          $tmpimg = $_FILES[$documentoX]['tmp_name'];
          $fileName = $_FILES[$documentoX]['name'];
          $success = uploadFile($tmpimg, $fileName);
          if ($success){
            //Registrando documento no banco de dados
            $tratamento = $fileName; //tratando o texto do documento para evitar erros
            $tratamento = str_replace("’", "\'", $tratamento);
            $tratamento = str_replace("'", "\'", $tratamento);
            $tratamento = str_replace('"', '\"', $tratamento);
            $fileName = $tratamento;
            $tratamento = $_POST[$nameDoc];
            $tratamento = str_replace("’", "\'", $tratamento);
            $tratamento = str_replace("'", "\'", $tratamento);
            $tratamento = str_replace('"', '\"', $tratamento);
            $sql_code = "INSERT INTO documentos (nome, arquivo, area) VALUES ('$tratamento', '$fileName', 'Processo seletivo')";
            $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
            if ($sql_query) {
            }else{
                echo "Error: ".mysqli_error($mysqli);  
            }
            if($documentos==""){
              $conteudo = $conteudo . "<br> <h2>Documentos:</h2> <div id=\'documentos-processo\' style=\'border:1px solid #ddd; padding: 4px;\'>";
              $conteudo = $conteudo . "<a href=\'../documents/$fileName\' target=\'_blank\' rel=\'noopener noreferrer\' style=\'text-decoration: none;\'> $tratamento </a><br>";
              $documentos = $fileName;
            } else {
              $conteudo = $conteudo . "<a href=\'../documents/$fileName\' target=\'_blank\' rel=\'noopener noreferrer\' style=\'text-decoration: none;\'> $tratamento </a><br>";
              $documentos = $documentos . "|". $fileName;
            }
            //tratar o conteudo de $documentos aqui
          }
        } else {
          $stop = true;
        }
        $pos = $pos + 1;
      }
      $conteudo = $conteudo . "</div>";
      $pos = 0;
  
      $sql_code = "INSERT INTO processos (titulo, conteudo,documentos,fim) VALUES ('$titulo', '$conteudo', '$documentos', '$fim')";
      $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
      if ($sql_query) {
          header('Location:processos-control.php'); 
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
    <title>Prodema Doutorado | Criar Processo</title>

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
            <a href="processos-control.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
              <strong style="color: white">CRIAR PROCESSO</strong>
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
              <label>Término: <span style="color:blue;font-size:0.6rem"> *Isto definirá até quando o processo ficará em destaque</span></label>
              <input type="datetime-local" name="fim" value="" required>
            </div>
            <div class="fields">
              <label>Conteúdo (em HTML):</label>
              <textarea id="conteudo-input" name="conteudo" rows="6" cols="50" onchange="AddingInicialContent()" required></textarea>
            </div>
            <div id="added-fields" class="fields">
            </div>
            <div id="add-fields">
              <button class="btn btn-sm btn-secondary" type="button" onclick="addDocForm()"><i class="fa-solid fa-plus"></i> Adicionar Documento</button>
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

        <!-- ------------------ VISUALIZAÇÃO DO PROCESSO ---------------------- -->
        <article class="info-col1">
          <div class="title-info">
            <h1 id="titulo-output">TÍTULO AQUI</h1>
            <p id="data-atual"><i class="fa-regular fa-calendar"></i> --.--.--</p>
          </div>
          <br>
          <div id="texto-output">
            <p>Corpo da notícia aqui</p>
          </div>
          <br><br>
            <h2 id="documentos-title"></h2>
          <div id="documentos-output" style="border:1px solid #ddd; padding: 4px; visibility:hidden">
            <!-- CONTEÚDO EXTRA AQUI -->
          </div>
        </article>
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script>

      //ADICIONANDO DATA ATUAL
      const outputDate = document.querySelector("#data-atual");
      let now = new Date();
      let month = (now.getMonth() < 9) ? ".0"+(now.getMonth()+1) : "."+(now.getMonth()+1);
      let nowStr = now.getDate() + month + "." + now.getFullYear();
      outputDate.innerHTML = "<i class='fa-regular fa-calendar'></i> " + nowStr;

      //VARIAVEIS DE CONTROLE PARA A ADIÇÃO DE NOVOS CAMPOS E COMPORTAMENTO
      let addedFormContent = [];
      let totalContent = 0;

      //PREVENINDO SUBMISSÃO DO FORM POR PRESSIONAR ENTER
      const PreventEnterSubmit = function(e) {
        let boolean = true;
        if(e.keyCode === 13) {
          boolean = false;
        }
        return boolean;
      }


      // CLIQUE DO BOTÃO <ADICIONAR DOCUMENTO>
      const addDocForm = function(){
        addedFormContent.push(`<div class="fields" style="max-width:373px; padding: 3px; border: 1px dashed #000">
                <label>Adicionar documento na sequência: </label>
                <input class="line" type="file" name="documento${totalContent}" id="documento${totalContent}" onchange="AddingDoc(${totalContent})" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" required>
                <label>Nome a ser exibido:</label>
                <input style="width:100%" type="text" name="nameDoc${totalContent}" onchange="AddingDoc(${totalContent})" onkeydown="javascript: return PreventEnterSubmit(event)" required>
              </div>`)
        document.querySelector('#added-fields').insertAdjacentHTML( 'beforeEnd', addedFormContent[totalContent]);
        document.querySelector('#add-fields').innerHTML =`
        <button class="btn btn-sm btn-secondary" type="button" onclick="addDocForm()"><i class="fa-solid fa-plus"></i> Adicionar Documento</button>
        `;
        document.querySelector('#documentos-title').innerHTML = "Documentos:";
        document.querySelector('#documentos-output').insertAdjacentHTML('beforeEnd', `<div id='doc${totalContent}'></div>`);
        totalContent++;
      }

      const AddingDoc = function(position){
        const selectInput = "#documento"+position;
        const selectOutput = "#doc"+position;
        const file = document.querySelector(selectInput).files[0];
        let nameDoc = document.querySelector("input[name='nameDoc"+position+"']").value;
        if (file) {
          document.querySelector('#documentos-output').style.visibility = 'visible';       
          const docElement = document.createElement("a");
          docElement.href = "#";
          docElement.target="_blank";
          docElement.rel="noopener noreferrer";
          docElement.innerHTML = nameDoc;
          docElement.style.textDecoration = "none";
          document.querySelector(selectOutput).innerHTML = "";
          document.querySelector(selectOutput).appendChild(docElement);
        }
      }

      const AddingInicialContent = function(){
            document.querySelector('#texto-output').innerHTML = document.querySelector('#conteudo-input').value;
      }

    </script>
</body>
</html>