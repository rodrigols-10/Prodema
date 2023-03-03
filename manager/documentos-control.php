<?php
    include('protect-page.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema Doutorado | Documentos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/main.css">
    <script src="https://kit.fontawesome.com/6354a31a3b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="pages.css">
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
                <h1>DOCUMENTOS</h1>
            </div>
            <!-- ITENS DE DOCUMENTOS -->
            <a id="new-documento" onclick="addNew();" class="info-item newitem">
                <i style="font-size: 2rem;" class="fa-solid fa-plus"></i>ADICIONAR DOCUMENTO
            </a>
          <div id="documentos">
            
<?php
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

    if(isset($_GET['action'])){
        if($_GET['action']=='create'){
            if(isset($_POST['nome'])){
                $nome = $_POST['nome'];
                $area = $_POST['area'];

                if(isset($_FILES['arquivo'])){
                    $tmpimg = $_FILES['arquivo']['tmp_name'];
                    $fileName = $_FILES['arquivo']['name'];
                    $success = uploadFile($tmpimg, $fileName);
                    if ($success){
                        $sql_code = "INSERT INTO documentos (nome, arquivo, area) VALUES ('$nome', '$fileName', '$area')";
                        $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
                        if ($sql_query) {
                            unset($_POST['nome']);
                            unset($_POST['arquivo']);
                            unset($_POST['area']);
                            header('Location:documentos-control.php'); 
                            exit();
                        }else{
                            echo "Error: ".mysqli_error($mysqli);  
                        }
                    }
                }
            }
        } elseif($_GET['action']=='edit'){
            if(isset($_POST['nome'])){
                $tratamento = $_POST['nome'];
                $tratamento = str_replace("’", "\'", $tratamento);
                $tratamento = str_replace("'", "\'", $tratamento);
                $tratamento = str_replace('"', '\"', $tratamento);
                $nome = $tratamento;
                $area = $_POST['area'];
                $id = $_GET['id'];
                $sql_code = "UPDATE documentos SET nome = '$nome', area = '$area' WHERE documentos.id = $id";
                $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
                if ($sql_query) {
                    unset($_POST['nome']);
                    unset($_POST['area']);
                    header('Location:documentos-control.php'); 
                    exit();
                }else{
                    echo "Error: ".mysqli_error($mysqli);  
                }
            }
        } elseif($_GET['action']=='delete'){
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql_code = "DELETE FROM `documentos` WHERE `documentos`.`id` = $id";  
                $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");  
                if ($sql_query) {  
                     header('location:documentos-control.php');  
                }else{  
                     echo "Error: ".mysqli_error($mysqli);  
                }  
            } 
        }
    }  
    echo "<p>".$userMessage."</p>";
    $sql_code = "SELECT * FROM documentos ORDER BY area ASC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");

    while($documentos = $sql_query->fetch_assoc()){
        ?>
        <div id="documento<?php echo $documentos['id'] ?>" style="text-align:left">
            <div class="docconteiner" style="display:flex; justify-content: space-between;align-items:center;">
                <div class="info-item" style="background-color:white; min-width:50px; width: auto">
                    <span style="display:flex"><i class="fa-regular fa-file" style="font-size:1rem; margin-top:0.7rem;margin-right:0.5rem;"></i>
                    <div class="info-title" id="documento<?php echo $documentos['id'] ?>" style="padding-right:1rem">
                         <h2 id="documento-nome<?php echo $documentos['id'] ?>" style="font-size:0.9rem; margin-top:10px;"><?php echo $documentos['nome'] ?></h2>
                        <p id="documento-arquivo<?php echo $documentos['id'] ?>" style="font-size:0.7rem; word-break: break-all;"><?php if($documentos['arquivo']=="") echo "--"; else echo $documentos['arquivo'] ?></p>
                    </div>
                    </span>
                </div>
                <div style="display:flex;align-items: center; text-align:right">
                    <h2 style="margin-right:10%;font-size:0.9rem" id="documento-area<?php echo $documentos['id'] ?>"><?php echo $documentos['area'] ?></h2>
                    <a id="documento-update<?php echo $documentos['id'] ?>" class="info-item" style="color: blue; font-size: 1.5rem; margin: auto; padding: 1rem" onclick="UpdateExistent('<?php echo $documentos['id']?>')">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a id="documento-delete<?php echo $documentos['id'] ?>" class="info-item" style="color: red; font-size: 1.5rem; margin: auto; padding: 1rem" href="documentos-control.php?id=<?php echo $documentos['id']?>&action=delete">
                    <i class="fa-solid fa-trash-can"></i>
                    </a>
                </div>
            </div>
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
    <script>
        const addNew = function(){
            const lista = document.getElementById("documentos");
            document.getElementById("new-documento").style.display="none";
            let formContent = `<form action="documentos-control.php?action=create" method="POST" enctype="multipart/form-data">
                                <div style="display:flex; flex-wrap:wrap; justify-content: space-between;border: 1px dashed #ccc; padding: 4px">
                                    <div class="info-item fill400w768" style="display:flex; flex-direction:column;align-items:flex-start;background-color:white;">
                                        <label>Nome:</label>
                                        <input style="width:100%" type="text" name="nome" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Nome" required>
                                        <label>Arquivo:</label>
                                        <input style="width:100%" type="file" name="arquivo" accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf" required>
                                    </div>
                                    <div class="fillautow768" style="display:flex; justify-content: space-between;">
                                        <div style="display:flex;flex-direction:column;background-color:white;margin: 0 10px">
                                            <label>Área:</label>
                                            <select name="area" style="height:30px;padding:1px 2px">
                                                <option value="Normas e Resoluções" selected>Normas e Resoluções</option>
                                                <option value="Oferta de Disciplinas">Oferta de Disciplinas</option>
                                                <option value="Portarias e Ofícios">Portarias e Ofícios</option>
                                                <option value="Processo seletivo">Processo seletivo</option>
                                                <option value="Regimento Interno">Regimento Interno</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="info-item" style="color: green; font-size: 1.5rem; margin: auto 0; padding: 1rem;border:none;">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        </button>
                                    </div>
                                </div>
                                </form>`;

            lista.insertAdjacentHTML('afterbegin', formContent);
        }

        const UpdateExistent = function(id){            
            const lista = document.getElementById("documento"+id);
            document.getElementById("new-documento").style.display="none";
            document.getElementById("documento-update"+id).style.display="none";
            document.getElementById("documento-delete"+id).style.display="none";
            let nome = document.getElementById("documento-nome"+id).textContent;
            let arquivo = document.getElementById("documento-arquivo"+id).textContent;
            let area = document.getElementById("documento-area"+id).textContent;
            let formContent = `<form action="documentos-control.php?id=${id}&action=edit" method="POST" enctype="multipart/form-data">
                                <div style="display:flex; flex-wrap:wrap; justify-content: space-between;border: 1px dashed #ccc; padding: 4px">
                                    <div class="info-item fill400w768" style="display:flex; flex-direction:column;align-items:flex-start;background-color:white;">
                                        <label>Nome:</label>
                                        <input style="width:100%" type="text" name="nome" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Nome" value="${nome}" required>
                                        <label>Arquivo:</label>
                                        <p style="word-break: break-all;">${arquivo}</p>
                                    </div>
                                    <div class="fillautow768" style="display:flex; justify-content: space-between;" >
                                        <div style="display:flex;flex-direction:column;background-color:white;margin: 0 10px">
                                            <label>Área:</label>
                                            <select name="area" style="height:30px;padding:1px 2px">
                                                <option value="Normas e Resoluções"  ${area=='Normas e Resoluções' ? "selected" : ""}>Normas e Resoluções</option>
                                                <option value="Oferta de Disciplinas"  ${area=='Oferta de Disciplinas' ? "selected" : ""}>Oferta de Disciplinas</option>
                                                <option value="Portarias e Ofícios"  ${area=='Portarias e Ofícios' ? "selected" : ""}>Portarias e Ofícios</option>
                                                <option value="Processo seletivo"  ${area=='Processo seletivo' ? "selected" : ""}>Processo seletivo</option>
                                                <option value="Regimento Interno"  ${area=='Regimento Interno' ? "selected" : ""}>Regimento Interno</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="info-item" style="color: green; font-size: 1.5rem; margin: auto 0; padding: 1rem;border:none;">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        </button>
                                    </div>
                                </div>
                                </form>`;
                                
            lista.innerHTML = formContent;
        }

        //PREVENINDO SUBMISSÃO DO FORM POR PRESSIONAR ENTER
        const PreventEnterSubmit = function(e) {
        let boolean = true;
        if(e.keyCode === 13) {
            boolean = false;
        }
        return boolean;
        }
    </script>
</body>
</html>