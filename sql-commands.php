<?php
    include('manager/connection.php');
    
        $sql_code = "INSERT INTO `noticias` (`id`, `titulo`, `banner`, `conteudo`, `data`) VALUES
        (1, 'O Colegiado do Curso de Doutorado em Desenvolvimento e Meio Ambiente, Associação Plena em Rede, convidam as Instituições de Ensino Superior legalmente instituídas a apresentarem propostas de adesão.', 'noticia1.jpg', '<p>Todas as informações podem ser obtidas através do e-mail: <a href=\"mailto:prodemadoutorado@gmail.com\">prodemadoutorado@gmail.com</a></p>', '2022-12-06 17:04:29'),
        (2, 'Encerramento da disciplina \"Caracterização Tecnológica da Madeira e Derivados\"', 'noticia2.jpg', '<p>A disciplina é ministrada pelos professores @rafael.r.melo e @mariovanoli , e contou com a participação de discentes de Mestrado e Doutorado de cinco diferentes programas:<br>@ppgcfl.ufrn , @prodema.ufersa , @ppgats , @prodemaufrn e @ppgcem_ufersa</p><div class=\"info-page-other-img\"><img src=\"../uploads/noticia2-1.jpg\" alt=\"imagem da notícia\"></div><div class=\"info-page-other-img\"><img src=\"../uploads/noticia2-2.jpg\" alt=\"imagem da notícia\"></div>', '2022-12-14 17:11:12'),
        (3, 'Resultado da avaliação dos Pré-projetos', 'noticia3.jpg', '<p>A Comissão de Seleção do Curso de Doutorado em Desenvolvimento e Meio Ambiente (DDMA) da Universidade Federal do Piauí (UFPI), no uso de suas atribuições legais, considerando o Edital n° 02/2022 e em consonância com o calendário de Execução do Processo Seletivo do Doutorado do Programa de Pós-Graduação em Desenvolvimento e Meio Ambiente, torna público o resultado da avaliação dos Pré-projetos.</p>', '2022-12-06 17:11:44'),
        (4, 'Índice de Doenças provenientes da Radioatividade é tema de ação desenvolvida no Seridó pelo Prodema/UFRN', 'noticia4.jpg', '<p>A ação foi desenvolvida pelo Programa de Pós-Graduação em Desenvolvimento e Meio Ambiente (Prodema) nos municípios de Lajes Pintadas e Santa Cruz.</p><p>Recentemente pesquisadores do Laboratório de Genética Toxicológica (Genetox/UFRN), desenvolveram estudos sobre a radioatividade natural no Brasil. Os resultados demonstram níveis de radiação acima das diretrizes internacionais e consideram esta região do território brasileiro como a de mais alta radiação natural, em decorrência da exposição de produtos radioativos, como o gás radônio (Rn) e o chumbo (Pb). Esses elementos em elevada exposição podem levar às pessoas o desenvolvimento de neoplasias, tumores originados pelo aumento do número de células no organismo.</p><p>Motivados pelo índice de doenças provenientes da radioatividade natural nas regiões do Seridó, alunos e professores do Programa de Pós-Graduação em Desenvolvimento e Meio Ambiente (Prodema), vinculado ao Centro de Biociências (CB/UFRN) e a Faculdade de Ciências da Saúde do Trairi (Facisa/UFRN), promoveram um evento para despertar o pensamento crítico e científico da população acerca da temática. Intitulada Radioatividade natural na microrregião Borborema Potiguar: perspectivas em saúde, educação e meio ambiente, a ação aconteceu no período de 25 de novembro e 2 de dezembro, nos municípios de Lajes Pintadas e Santa Cruz.</p><div class=\"info-page-other-img\"><img src=\"../uploads/noticia4-1.jpg\" alt=\"imagem da notícia\"><img src=\"../uploads/noticia4-2.jpg\" alt=\"imagem da notícia\"><img src=\"../uploads/noticia4-3.jpg\" alt=\"imagem da notícia\"></div>', '2022-12-14 19:02:29'),
        (5, 'testando', 'default.png', 'agafdgdg  as fasd fsf sfa sdfd', '2022-12-14 19:04:36');";  
        $sql_query = $mysqli->query($sql_code) or die("<p>Falha na operação</p>");  
        if ($sql_query) {  
             header('location:index.html');
        }else{  
             echo "Error: ".mysqli_error($mysqli);  
        }
?>