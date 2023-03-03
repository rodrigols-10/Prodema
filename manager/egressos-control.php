<?php
  include('protect-page.php');
  include('connection.php');

  if(isset($_GET['action'])){
      if($_GET['action']=='create'){
          if(isset($_POST['nome'])){
              $nome = $_POST['nome'];
              $regiao = $_POST['regiao'];
              $link = $_POST['link'];
              $cx = $_POST['cx'];
              $cy = $_POST['cy'];
              $informacao = $_POST['informacao'];
              $informacao = str_replace("’", "\'", $informacao);
              $informacao = str_replace("'", "\'", $informacao);
              $informacao = str_replace('"', '\"', $informacao);
              $sql_code = "INSERT INTO egressos (nome,regiao,informacao,link,cx,cy) VALUES ('$nome', '$regiao', '$informacao', '$link', '$cx', '$cy')";
              $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
              if ($sql_query) {
                  unset($_POST['nome']);
                  unset($_POST['regiao']);
                  unset($_POST['cx']);
                  unset($_POST['cy']);
                  unset($_POST['informacao']);
                  header('Location:egressos-control.php'); 
                  exit();
              }else{
                  echo "Error: ".mysqli_error($mysqli);  
              }
          }
      } elseif($_GET['action']=='edit'){
          $id = $_GET['id'];
          if(isset($_POST['nome'.$id])){
              $nome = $_POST['nome'.$id];
              $regiao = $_POST['regiao'.$id];
              $link = $_POST['link'.$id];
              $cx = $_POST['cx'.$id];
              $cy = $_POST['cy'.$id];
              $informacao = $_POST['informacao'.$id];
              $informacao = str_replace("’", "\'", $informacao);
              $informacao = str_replace("'", "\'", $informacao);
              $informacao = str_replace('"', '\"', $informacao);
              $sql_code = "UPDATE egressos SET nome = '$nome', regiao = '$regiao', cx = '$cx', cy = '$cy', informacao = '$informacao', link = '$link' WHERE egressos.id = $id";
              $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
              if ($sql_query) {
                  unset($_POST['nome'.$id]);
                  unset($_POST['regiao'.$id]);
                  unset($_POST['cx'.$id]);
                  unset($_POST['cy'.$id]);
                  unset($_POST['informacao'.$id]);
                  header('Location:egressos-control.php'); 
                  exit();
              }else{
                  echo "Error: ".mysqli_error($mysqli);  
              }
          }
      } elseif($_GET['action']=='delete'){
          if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $sql_code = "DELETE FROM `egressos` WHERE `egressos`.`id` = $id";  
              $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");  
              if ($sql_query) {  
                   header('location:egressos-control.php');  
              }else{  
                   echo "Error: ".mysqli_error($mysqli);  
              }  
          } 
      }
  }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema Doutorado | Controle dos Egressos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="pages.css">
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
      <header style="width: 100%;background-color:#005da9;">
        <div class="options">
        <ul style="display:flex; justify-content:space-between;">
            <li style="visibility: visible; height: 100%">
            <a href="painel.php" style="height: 100%"><i alt="voltar" title="Voltar" class="fa-solid fa-arrow-left"></i> Voltar</a>
            </li>
            <li>
              <strong style="color: white">CONTROLE DOS EGRESSOS</strong>
            </li>
            <li>
            <a href="logout.php" title="Sair do sistema"><i alt="Sair do sistema" class="fa-solid fa-arrow-right-to-bracket"></i> Sair</a>
            </li>
        </ul>
        </div>
    </header>
    <main>
      <section class="info">
        <aside style="position: relative; padding: 1rem 1rem 1rem 1rem; background-color: transparent;">
          <div id="egressos" style="">
            <a id="new-point" onclick="addNew();" class="info-item" style="justify-content:center;align-items:center;border:2px solid #ccc;border-radius:7px;padding:3px 2px;user-select: none;">
                  <i style="font-size: 1rem; color:gray;" class="fa-solid fa-plus"></i> <span style="font-size: 0.8rem; color:gray;font-weight:bold;">ADICIONAR EGRESSOS</span>
              </a>
            <div id="new-point-output">
            <!-- Formulario do novo ponto -->
            </div>
<?php

    $sql_code = "SELECT * FROM egressos ORDER BY nome ASC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      
    while($egressos = $sql_query->fetch_assoc()){
        ?>
        <div id="egresso<?php echo $egressos['id'] ?>" style="background-color:white;border: 1px solid #ccc; max-width:200px;">
            <div class="onhover" style="display:flex; flex-direction:column; padding:3px" onmouseenter="changecolor(<?php echo $egressos['id'] ?>)" onmouseleave="recoverColor(<?php echo $egressos['id'] ?>)">
                <div>
                    <div class="info-title" id="egresso<?php echo $egressos['id'] ?>">
                        <h2 style="margin-top:10px"><span id="egresso-nome<?php echo $egressos['id'] ?>"><?php echo $egressos['nome'] ?></span></h2>
                        <h3 style="font-size:small"><span id="egresso-regiao<?php echo $egressos['id'] ?>"><?php echo $egressos['regiao'] ?></span> | Posição(<span id="egresso-cx<?php echo $egressos['id'] ?>"><?php echo $egressos['cx'] ?></span>,<span id="egresso-cy<?php echo $egressos['id'] ?>"><?php echo $egressos['cy'] ?></span>)</h3>
                        <p style="font-size:small" id="egresso-link<?php echo $egressos['id'] ?>"><?php echo $egressos['link'] ?></p>
                        <p id="egresso-informacao<?php echo $egressos['id'] ?>"><?php echo $egressos['informacao'] ?></p>
                    </div>
                </div>
                <div style="display:flex;align-items: center">
                    <a id="egresso-update<?php echo $egressos['id'] ?>" class="info-item" style="color: blue; font-size: 1rem; margin: auto; padding: 0.3rem 1rem" onclick="UpdateExistent('<?php echo $egressos['id']?>')">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a id="egresso-delete<?php echo $egressos['id'] ?>" class="info-item" style="color: red; font-size: 1rem; margin: auto; padding: 0.3rem 1rem" href="egressos-control.php?id=<?php echo $egressos['id']?>&action=delete">
                    <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
?>
          </div>
        </aside>
        <!-- ------------------ VISUALIZAÇÃO DO MAPA ---------------------- -->
        <div style="max-width:1010px">
          <div style="background-color: white; border-radius: 10px; width: 100%; padding: 3px; margin: 5px auto 5px auto; overflow: auto;">
              <svg width="1000px" height="556px" style="display:block; position:relative; margin: 0 auto">
                <g>
                  <image xlink:href="../assets/mapa.png" alt="Mapa Mundi" width="1000px" height="556px" x="0px" y="0px"></image>
                </g>
              
<?php
    $sql_code = "SELECT * FROM egressos ORDER BY regiao ASC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      
      while($egressos = $sql_query->fetch_assoc()){
    ?>

                  <g id="item<?php echo $egressos['id'] ?>" stroke="rgba(20,100,255,0.8)" fill="white" stroke-width="5">
                      <circle id="ponto<?php echo $egressos['id'] ?>" class="point" cx="<?php echo $egressos['cx'] ?>px" cy="<?php echo $egressos['cy'] ?>px" r="5px" onclick="showGraduatesExistent('<?php echo $egressos['nome'] ?>','<?php echo $egressos['regiao'] ?>','<?php echo $egressos['link'] ?>','<?php echo $egressos['id'] ?>')"/>
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
        </div>
        
      </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
        const addNew = function(){
            createPoint();
            const form = document.getElementById("new-point-output");
            document.getElementById("new-point").style.display="none";
            let formContent = `<form class="creation" action="egressos-control.php?action=create" style="border:1px dashed #ccc; padding: 3px" method="POST" enctype="multipart/form-data">
                                  <div class="fields">
                                  <label>Nome: </label>
                                  <input style="width:100%" type="text" name="nome" id="nome" onchange="" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div style="display:flex; justify-content:space-between;margin-top:2px">
                                    <label>X:
                                    <input style="width:50px" type="number" step="1" name="cx" id="cx" onchange="ModifyingPoint_X()" onkeydown="javascript: return PreventEnterSubmit(event)">
                                    </label>
                                    <label>Y:
                                    <input style="width:50px" type="number" step="1" name="cy" id="cy" onchange="ModifyingPoint_Y()" onkeydown="javascript: return PreventEnterSubmit(event)">
                                    </label>
                                  </div>
                                  <div class="fields">
                                  <label>Região: </label>
                                  <input style="width:100%" type="text" name="regiao" id="regiao" onchange="" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div class="fields">
                                  <label>Link: </label>
                                  <input style="width:100%" type="text" name="link" id="link" onchange="" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div class="fields" style="align-items:center">
                                    <label>Informação:</label>
                                    <textarea id="informacao" name="informacao" rows="6" cols="22" onchange="" required></textarea>
                                  </div>
                                  <div class="form-buttons">
                                      <input class="btn btn-sm btn-success" type="submit" value="Submit">
                                  </div>
                                </form>`;

            form.innerHTML = formContent;
        }

        const UpdateExistent = function(id){            
            const form = document.getElementById("egresso"+id);
            document.getElementById("new-point").style.display="none";
            document.getElementById("egresso-update"+id).style.display="none";
            document.getElementById("egresso-delete"+id).style.display="none";
            let nome = document.getElementById("egresso-nome"+id).textContent;
            let regiao = document.getElementById("egresso-regiao"+id).textContent;
            let link = document.getElementById("egresso-link"+id).textContent;
            let cx = document.getElementById("egresso-cx"+id).textContent;
            let cy = document.getElementById("egresso-cy"+id).textContent;
            let informacao = document.getElementById("egresso-informacao"+id).textContent;
            
            UpdatingExistentPoint(id,cx,cy);
            
            let formContent = `<form class="creation" action="egressos-control.php?id=${id}&action=edit" style="border:1px dashed #ccc; padding: 3px" method="POST" enctype="multipart/form-data">
                                  <div class="fields">
                                    <label>Nome: </label> 
                                    <input style="width:100%" type="text" name="nome${id}" id="nome${id}" value="${nome}" onchange="" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div style="display:flex; justify-content:space-between;margin-top:2px">
                                    <label>X:
                                    <input style="width:50px" type="number" step="1" name="cx${id}" id="cx${id}" value="${cx}" onchange="ModifyingExistentPoint_X(${id})" onkeydown="javascript: return PreventEnterSubmit(event)">
                                    </label>
                                    <label>Y:
                                    <input style="width:50px" type="number" step="1" name="cy${id}" id="cy${id}" value="${cy}" onchange="ModifyingExistentPoint_Y(${id})" onkeydown="javascript: return PreventEnterSubmit(event)">
                                    </label>
                                  </div>
                                  <div class="fields">
                                    <label>Região: </label>
                                    <input style="width:100%" type="text" name="regiao${id}" id="regiao${id}" onchange="" value="${regiao}" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div class="fields">
                                    <label>Link: </label>
                                    <input style="width:100%" type="text" name="link${id}" id="link${id}" onchange="" value="${link}" onkeydown="javascript: return PreventEnterSubmit(event)">
                                  </div>
                                  <div class="fields" style="align-items:center">
                                    <label>Informação:</label>
                                    <textarea id="informacao${id}" name="informacao${id}" rows="6" cols="22" onchange="" required>${informacao}</textarea>
                                  </div>
                                  <div class="form-buttons">
                                      <input class="btn btn-sm btn-success" type="submit" value="Atualizar">
                                  </div>
                                </form>`;
                                
            form.innerHTML = formContent;
        }

        //PREVENINDO SUBMISSÃO DO FORM POR PRESSIONAR ENTER
        const PreventEnterSubmit = function(e) {
        let boolean = true;
        if(e.keyCode === 13) {
            boolean = false;
        }
        return boolean;
        }

        const showGraduates = function(nome,country,link,id){
          const bi = document.getElementById("back-info");
          const box = document.getElementById("information");
          let info = "";
          if(id=='0') info = document.querySelector('#informacao').value;
          else info = document.querySelector('#informacao'+id).value;
          info.replace(`'`,`\'`);
          info.replace(`"`,`\"`);
          info.replace("`","\`");
          bi.style.display = "block";
          box.style.display = "block";

          let linkinfo = "";
          if(link!='') linkinfo = "<a href='"+handleLink(link)+"' target='_blank' class='onhover' style='text-decoration:none; color:black'><strong>"+nome+"</strong></a>";
          else linkinfo = "<p><strong>"+nome+"</strong></p>";

          box.innerHTML = linkinfo+"<p>"+country+"</p> <hr> <p>"+info+"</p>";
        }
        const showGraduatesExistent = function(nome,country,link,id){
          const bi = document.getElementById("back-info");
          const box = document.getElementById("information");
          const info = document.getElementById("egresso-informacao"+id).textContent;
          bi.style.display = "block";
          box.style.display = "block";
          let linkinfo = "";
          if(link!='') linkinfo = "<a href='"+handleLink(link)+"' target='_blank' class='onhover' style='text-decoration:none; color:black'><strong>"+nome+"</strong></a>";
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

        const changecolor = function(id){
          const ponto = document.getElementById("ponto"+id);
          ponto.style.stroke="rgba(108,59,193,0.8)";
        }
        const recoverColor = function(id){
          const ponto = document.getElementById("ponto"+id);
          ponto.style.stroke="rgba(20,100,255,0.8)";
        }

        const createPoint = function(){
          const plano = document.querySelector("svg");
          const content = `<g stroke="rgba(0,193,20,0.8)" fill="white" stroke-width="5">
                            <circle id="ponto" class="point" cx="500px" cy="253px" r="5px" onclick="showGraduates(document.querySelector('#nome').value,document.querySelector('#regiao').value,document.querySelector('#link').value,'0')">
                          </g>`
          plano.insertAdjacentHTML("beforeend", content);
        }

        const UpdatingExistentPoint = function(id,cx,cy){
          const ponto = document.querySelector("#item"+id);
          ponto.setAttribute("stroke","rgba(227,122,22,0.8)");
          const content = `<circle id="ponto${id}" class="point" cx="${cx}px" cy="${cy}px" r="5px" onclick="showGraduates(document.querySelector('#nome${id}').value,document.querySelector('#regiao${id}').value,document.querySelector('#link${id}').value,'${id}')"/>`
          ponto.innerHTML = content;
        }

        const ModifyingPoint_X = function(){
          let x = document.getElementById("cx").value;
          if (x=="") x=0;
          const ponto = document.querySelector("#ponto");
          document.querySelector("#ponto").setAttribute("cx", x+"px");
        }
        const ModifyingPoint_Y = function(){
          let y = document.getElementById("cy").value;
          if (y=="") y=0;
          const ponto = document.querySelector("#ponto");
          document.querySelector("#ponto").setAttribute("cy", y+"px");
        }
        const ModifyingExistentPoint_X = function(id){
          let x = document.getElementById("cx"+id).value;
          if (x=="") x=0;
          const ponto = document.querySelector("#ponto"+id);
          ponto.setAttribute("cx", x+"px");
        }
        const ModifyingExistentPoint_Y = function(id){
          let y = document.getElementById("cy"+id).value;
          if (y=="") y=0;
          const ponto = document.querySelector("#ponto"+id);
          ponto.setAttribute("cy", y+"px");
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