<?php
    include('protect-page.php');
    function uploadImages($tmpName,$filename){
        $userMessage = "";
        //var_dump($_FILES['banner']);
        $folder = "../uploads/";
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $sendImage = move_uploaded_file($tmpName, $folder . $filename);
        if($sendImage){
        $userMessage = "Arquivo enviado com sucesso!";
        return true;
        } else {
        $userMessage = "Falha ao enviar arquivo";
        return false;
        }
    
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodema Doutorado | Docentes</title>

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
                <h1>DOCENTES</h1>
            </div>
            <!-- ITENS DE DOCENTES -->
            <a id="new-docente" onclick="addNew();" class="info-item" style="justify-content:center;align-items:center;height:50px;border:2px solid #ccc;border-radius:10px;">
                <i style="font-size: 2rem; color:gray;" class="fa-solid fa-plus"></i> <span style="font-size: 1.5rem; color:gray;font-weight:bold;">ADICIONAR DOCENTE</span>
            </a>
          <div id="docentes">
            
<?php
    include('connection.php');

    if(isset($_GET['action'])){
        if($_GET['action']=='create'){
            if(isset($_POST['nome'])){
                $nome = $_POST['nome'];
                $curriculo = $_POST['curriculo'];
                $instituicao = $_POST['instituicao'];
                $objetivo = "";

                if(isset($_POST["objetivo"])){
                    $first = true;

                    foreach($_POST["objetivo"] as $escolhas)
                    {
                        if($first == true) {
                            $objetivo = $escolhas;
                            $first=false;
                        }
                        else $objetivo = $objetivo . ",$escolhas";
                    }
                }

                $photoName = "";
                if(isset($_FILES['photo'])){
                    $tmpPhoto = $_FILES['photo']['tmp_name'];
                    $photoName = $_FILES['photo']['name'];
                    $success = uploadImages($tmpPhoto, $photoName);
                    if (!$success){
                        $photoName = 'docente-default.png';
                    }
                }
                $sql_code = "INSERT INTO docentes (nome, curriculo,instituicao,objetivo,foto) VALUES ('$nome', '$curriculo', '$instituicao', '$objetivo', '$photoName')";
                $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
                if ($sql_query) {
                    unset($_POST['nome']);
                    unset($_POST['curriculo']);
                    unset($_POST['instituicao']);
                    unset($_POST['objetivo']);
                    header('Location:docentes-control.php'); 
                    exit();
                }else{
                    echo "Error: ".mysqli_error($mysqli);  
                }
            }
        } elseif($_GET['action']=='edit'){
            $id = $_GET['id'];
            if(isset($_POST['nome'.$id])){
                $nome = $_POST['nome'.$id];
                $curriculo = $_POST['curriculo'.$id];
                $instituicao = $_POST['instituicao'.$id];

                $objetivo = "";

                if(isset($_POST["objetivo".$id])){
                    $first = true;

                    foreach($_POST["objetivo".$id] as $escolhas)
                    {
                        if($first == true) {
                            $objetivo = $escolhas;
                            $first=false;
                        }
                        else $objetivo = $objetivo . ",$escolhas";
                    }
                }
                
                $photoName = $_POST['old-photo'.$id];
                if(isset($_FILES['photo'.$id])){
                    $tmpPhoto = $_FILES['photo'.$id]['tmp_name'];
                    $photoName = $_FILES['photo'.$id]['name'];
                    $success = uploadImages($tmpPhoto, $photoName);
                    if (!$success){
                        $photoName = $_POST['old-photo'.$id];
                    }
                    //deletar a foto antiga se diferente
                    $currentPhoto = $photoName;
                    $oldPhoto = $_POST['old-photo'.$id];
                    if($oldPhoto!="docente-default.png" && $oldPhoto!=$currentPhoto) unlink("../uploads/".$_POST["old-photo".$id]);
                }

                $sql_code = "UPDATE docentes SET nome = '$nome', curriculo = '$curriculo', instituicao = '$instituicao', objetivo = '$objetivo', foto = '$photoName' WHERE docentes.id = $id";
                $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");
                if ($sql_query) {
                    unset($_POST['nome'.$id]);
                    unset($_POST['curriculo'.$id]);
                    unset($_POST['instituicao'.$id]);
                    unset($_POST['objetivo'.$id]);
                    header('Location:docentes-control.php');
                    exit();
                }else{
                    echo "Error: ".mysqli_error($mysqli);  
                }
            }
        } elseif($_GET['action']=='delete'){
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $photo = $_GET['photo'];
                if($photo!="docente-default.png") unlink("../uploads/".$photo);
                $sql_code = "DELETE FROM `docentes` WHERE `docentes`.`id` = $id";  
                $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");  
                if ($sql_query) {  
                     header('location:docentes-control.php');  
                }else{  
                     echo "Error: ".mysqli_error($mysqli);  
                }  
            } 
        }
    }  

    $sql_code = "SELECT * FROM docentes ORDER BY nome ASC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução da requisição");
      
    while($docentes = $sql_query->fetch_assoc()){
        ?>
        <div id="docente<?php echo $docentes['id'] ?>">
            <div style="display:flex; flex-wrap:nowrap; justify-content: space-between;align-items:center;">
                <div class="info-item" style="background-color:white;">
                    <figure title="imagem" alt="imagem">
                    <img src="../uploads/<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png" ?>" style="width:50px;height: 50px;object-fit: cover">
                    <p id="docente-foto<?php echo $docentes['id'] ?>" style="display:none"><?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png" ?></p>
                    </figure>
                    <div class="info-title" id="docente<?php echo $docentes['id'] ?>">
                        <h2 id="docente-nome<?php echo $docentes['id'] ?>" style="margin-top:10px;font-size:0.9rem"><?php echo $docentes['nome'] ?></h2>
                        <p id="docente-curriculo<?php echo $docentes['id'] ?>"><?php if($docentes['curriculo']=="") echo "--"; else echo $docentes['curriculo'] ?></p>
                    </div>
                    <div style="display:flex;flex-wrap:wrap">
                        <?php
                        if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0'){
                            $separator = explode(",",$docentes['objetivo']);
                            foreach ($separator as $value) {
                                ?>
                                <img src="../assets/onu<?php if($value!=NULL && $value!="" && $value!='0')echo $value . ".svg"; else echo ".png" ?>" style="width:40px;height: 40px;object-fit: cover;margin: 2px">
                                <?php
                            }
                        }
                        ?>
                    <p id="docente-objetivo<?php echo $docentes['id'] ?>" style="display:none"><?php if($docentes['objetivo']!=NULL && $docentes['objetivo']!="" && $docentes['objetivo']!='0')echo $docentes['objetivo']; else echo "0" ?></p>
                    </div>
                </div>
                <div style="display:flex;align-items: center">
                    <h2 style="margin-right:2rem" id="docente-instituicao<?php echo $docentes['id'] ?>"><?php echo $docentes['instituicao'] ?></h2>
                    <a id="docente-update<?php echo $docentes['id'] ?>" class="info-item" style="color: blue; font-size: 1.5rem; margin: auto; padding: 1rem" onclick="UpdateExistent('<?php echo $docentes['id']?>')">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a id="docente-delete<?php echo $docentes['id'] ?>" class="info-item" style="color: red; font-size: 1.5rem; margin: auto; padding: 1rem" href="docentes-control.php?id=<?php echo $docentes['id']?>&action=delete&photo=<?php if($docentes['foto']!=NULL && $docentes['foto']!="" && $docentes['foto']!='0')echo $docentes['foto']; else echo "docente-default.png" ?>">
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
            const lista = document.getElementById("docentes");
            document.getElementById("new-docente").style.display="none";
            let formContent = `<form style="border: 1px dashed #ccc; padding: 4px" action="docentes-control.php?action=create" method="POST" enctype="multipart/form-data">
                                <div style="display:flex; flex-wrap:nowrap; justify-content: space-between; align-items:flex-start; padding: 4px">
                                    <div class="info-item" style="background-color:white;align-items:flex-start">
                                        <div class="info-title">
                                        <label style="font-weight:bold">Nome:</label>
                                        <input style="width:100%" type="text" name="nome" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Nome" required>
                                        <label style="font-weight:bold">Link:</label>
                                        <input style="width:100%" type="text" name="curriculo" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Link">
                                        </div>
                                        <div style="display:flex;flex-direction:column;background-color:white;margin: 0 10px">
                                            <label style="font-weight:bold">Instituição:</label>
                                            <select name="instituicao" style="height:30px;padding:1px 2px">
                                                <option value="UFPI" selected>UFPI</option>
                                                <option value="UFC">UFC</option>
                                                <option value="UFERSA">UFERSA</option>
                                                <option value="UFRN">UFRN</option>
                                                <option value="UFPB">UFPB</option>
                                                <option value="UFPE">UFPE</option>
                                                <option value="UFS">UFS</option>
                                                <option value="UESC">UESC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="info-item" style="color: green; font-size: 1.5rem; margin: auto 10px; padding: 1rem;border:none;">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>

                                </div>
                                <div style="display:flex;flex-direction:row;background-color:white;margin: 10px">
                                    <div>
                                        <img id="photo-output" src="../uploads/docente-default.png" style="width:70px;height: 70px;object-fit: cover;border:1px solid black">
                                    </div>
                                    <div style="display:flex;flex-direction:column;margin: 0 10px">
                                        <label style="font-weight:bold">Foto:</label>
                                        <input style="width:100%" type="file" id="photo-input" name="photo" onchange="AddingPhoto('')">
                                    </div>
                                </div>
                                <label style="font-weight:bold">Objetivo ONU:</label> <br>
                                <div style="text-align:left; display:flex; justify-content:space-between">
                                            <div>
                                                <input type=checkbox name="objetivo[]" value="1"> 1 Erradicação da pobreza<br>
                                                <input type=checkbox name="objetivo[]" value="2"> 2 Fome zero e agricultura sustentável<br>
                                                <input type=checkbox name="objetivo[]" value="3"> 3 Saúde e Bem-Estar<br>
                                                <input type=checkbox name="objetivo[]" value="4"> 4 Educação de qualidade<br>
                                                <input type=checkbox name="objetivo[]" value="5"> 5 Igualdade de gênero<br>
                                                <input type=checkbox name="objetivo[]" value="6"> 6 Água potável e saneamento<br>
                                                <input type=checkbox name="objetivo[]" value="7"> 7 Energia limpa e acessível<br>
                                                <input type=checkbox name="objetivo[]" value="8"> 8 Trabalho decente e crescimento econômico<br>
                                                <input type=checkbox name="objetivo[]" value="9"> 9 Indústria, inovação e infraestrutura<br>
                                            </div>
                                            <div>
                                                <input type=checkbox name="objetivo[]" value="10"> 10 Redução das desigualdades<br>
                                                <input type=checkbox name="objetivo[]" value="11"> 11 Cidades e comunidades sustentáveis<br>
                                                <input type=checkbox name="objetivo[]" value="12"> 12 Consumo e produção responsáveis<br>
                                                <input type=checkbox name="objetivo[]" value="13"> 13 Ação contra a mudança global do clima<br>
                                                <input type=checkbox name="objetivo[]" value="14"> 14 Vida na água<br>
                                                <input type=checkbox name="objetivo[]" value="15"> 15 Vida terrestre<br>
                                                <input type=checkbox name="objetivo[]" value="16"> 16 Paz, justiça e instituições eficazes<br>
                                                <input type=checkbox name="objetivo[]" value="17"> 17 Parcerias e meios de implementação
                                            </div>
                                </div>
                                </form>`;

            lista.insertAdjacentHTML('afterbegin', formContent);
        }

        const UpdateExistent = function(id){            
            const lista = document.getElementById("docente"+id);
            document.getElementById("new-docente").style.display="none";
            document.getElementById("docente-update"+id).style.display="none";
            document.getElementById("docente-delete"+id).style.display="none";
            let nome = document.getElementById("docente-nome"+id).textContent;
            let curriculo = document.getElementById("docente-curriculo"+id).textContent;
            let objetivo = document.getElementById("docente-objetivo"+id).textContent;
            let foto = document.getElementById("docente-foto"+id).textContent;
            let instituicao = document.getElementById("docente-instituicao"+id).textContent;
            let formContent = `<form style="border: 1px dashed #ccc; padding: 4px" action="docentes-control.php?id=${id}&action=edit" method="POST" enctype="multipart/form-data">
                                <div style="display:flex; flex-wrap:nowrap; justify-content: space-between; align-items:flex-start;padding: 4px">
                                    <div class="info-item" style="background-color:white;align-items:flex-start">
                                        <div class="info-title">
                                        <label>Nome:</label>
                                        <input style="width:100%" type="text" name="nome${id}" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Nome" value="${nome}" required>
                                        <label>Link:</label>
                                        <input style="width:100%" type="text" name="curriculo${id}" onkeydown="javascript: return PreventEnterSubmit(event)" placeholder="Link" value="${curriculo}">
                                        </div>
                                        <div style="display:flex;flex-direction:column;background-color:white;margin: 0 10px">
                                            <label style="font-weight:bold">Instituição:</label>
                                            <select name="instituicao${id}" style="height:30px;padding:1px 2px">
                                                <option value="UFPI"  ${instituicao=='UFPI' ? "selected" : ""}>UFPI</option>
                                                <option value="UFC"  ${instituicao=='UFC' ? "selected" : ""}>UFC</option>
                                                <option value="UFERSA"  ${instituicao=='UFERSA' ? "selected" : ""}>UFERSA</option>
                                                <option value="UFRN"  ${instituicao=='UFRN' ? "selected" : ""}>UFRN</option>
                                                <option value="UFPB"  ${instituicao=='UFPB' ? "selected" : ""}>UFPB</option>
                                                <option value="UFPE"  ${instituicao=='UFPE' ? "selected" : ""}>UFPE</option>
                                                <option value="UFS"  ${instituicao=='UFS' ? "selected" : ""}>UFS</option>
                                                <option value="UESC"  ${instituicao=='UFSC' ? "selected" : ""}>UESC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="info-item" style="color: green; font-size: 1.5rem; margin: auto 10px; padding: 1rem;border:none;">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </button>
                                </div>
                                <div style="display:flex;flex-direction:row;background-color:white;margin: 10px">
                                    <div>
                                        <img id="photo-output${id}" src="../uploads/${foto}" style="width:70px;height: 70px;object-fit: cover;border:1px solid black">
                                    </div>
                                    <div style="display:flex;flex-direction:column;margin: 0 10px">
                                        <label style="font-weight:bold">Foto:</label>
                                        <input style="width:100%" type="file" id="photo-input${id}" name="photo${id}" onchange="AddingPhoto('${id}')">
                                    </div>
                                </div>
                                <label style="font-weight:bold">Objetivo ONU:</label> <br>
                                <div style="text-align:left; display:flex; justify-content:space-between">
                                            <div>
                                                <input type=checkbox id="obj${id}-1" name="objetivo${id}[]" value="1"> 1 Erradicação da pobreza<br>
                                                <input type=checkbox id="obj${id}-2" name="objetivo${id}[]" value="2"> 2 Fome zero e agricultura sustentável<br>
                                                <input type=checkbox id="obj${id}-3" name="objetivo${id}[]" value="3"> 3 Saúde e Bem-Estar<br>
                                                <input type=checkbox id="obj${id}-4" name="objetivo${id}[]" value="4"> 4 Educação de qualidade<br>
                                                <input type=checkbox id="obj${id}-5" name="objetivo${id}[]" value="5"> 5 Igualdade de gênero<br>
                                                <input type=checkbox id="obj${id}-6" name="objetivo${id}[]" value="6"> 6 Água potável e saneamento<br>
                                                <input type=checkbox id="obj${id}-7" name="objetivo${id}[]" value="7"> 7 Energia limpa e acessível<br>
                                                <input type=checkbox id="obj${id}-8" name="objetivo${id}[]" value="8"> 8 Trabalho decente e crescimento econômico<br>
                                                <input type=checkbox id="obj${id}-9" name="objetivo${id}[]" value="9"> 9 Indústria, inovação e infraestrutura<br>
                                            </div>
                                            <div>
                                                <input type=checkbox id="obj${id}-10" name="objetivo${id}[]" value="10"> 10 Redução das desigualdades<br>
                                                <input type=checkbox id="obj${id}-11" name="objetivo${id}[]" value="11"> 11 Cidades e comunidades sustentáveis<br>
                                                <input type=checkbox id="obj${id}-12" name="objetivo${id}[]" value="12"> 12 Consumo e produção responsáveis<br>
                                                <input type=checkbox id="obj${id}-13" name="objetivo${id}[]" value="13"> 13 Ação contra a mudança global do clima<br>
                                                <input type=checkbox id="obj${id}-14" name="objetivo${id}[]" value="14"> 14 Vida na água<br>
                                                <input type=checkbox id="obj${id}-15" name="objetivo${id}[]" value="15"> 15 Vida terrestre<br>
                                                <input type=checkbox id="obj${id}-16" name="objetivo${id}[]" value="16"> 16 Paz, justiça e instituições eficazes<br>
                                                <input type=checkbox id="obj${id}-17" name="objetivo${id}[]" value="17"> 17 Parcerias e meios de implementação
                                            </div>
                                </div>
                                <input type="hidden" name="old-photo${id}" value="${foto}">
                                </form>`;
            lista.innerHTML = formContent;
            if(objetivo!=null && objetivo!="" && objetivo!='0'){
                objetivoSeparado = objetivo.split(",").forEach(element => {
                    document.querySelector("#obj"+id+"-"+element).checked = true;
                });
            }
        }

        //PREVENINDO SUBMISSÃO DO FORM POR PRESSIONAR ENTER
        const PreventEnterSubmit = function(e) {
        let boolean = true;
        if(e.keyCode === 13) {
            boolean = false;
        }
        return boolean;
        }

        const AddingPhoto = function(id){
        const file = document.querySelector("#photo-input"+id).files[0];

        if (file) {
          const reader = new FileReader();

          reader.addEventListener("load", function (e) {
            const readerTarget = e.target;
            const img = document.querySelector("#photo-output"+id);
            img.src = readerTarget.result;
          });
          reader.readAsDataURL(file);
        }
      }
    </script>
</body>
</html>