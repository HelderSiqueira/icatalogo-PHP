<?php
session_start();

if(!isset($_SESSION["usuarioId"])){
    $_SESSION["mensagem"] = "Você precisa fazer login";

    header("location: ../produtos");

    exit();
}

require("../database/conexao.php");

$sql = "SELECT * FROM tbl_categoria";
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./categorias.css" />
    <title>Administrar Categorias</title>
</head>

<body>
    <?php
    include("../componentes/header/header.php");
    ?>
    <div class="content">
        <section class="categorias-container">
            <main>
                <form class="form-categorias" method="POST" action="./acoes.php">
                    <input type="hidden" name="acao" value="inserir">
                    <h1 class="span2">Adicionar Categorias</h1>
                    <div class="input-group span2">
                        <label for="descricao">Descricao</label>
                        <input type="text" name="descricao" id="descricao" />
                    </div>
                    <button onclick="javascript: window.location.href = '../produtos'" type="button">Cancelar</button>
                    <button>Salvar</button>
                </form>
                <h1>Lista de categorias</h1>
                <?php
                if(mysqli_num_rows($resultado) == 0){
                    echo "<center>Nenhuma categoria cadastrada</center>";
                }
                while($categoria = mysqli_fetch_array($resultado)){
                ?>    
                <div class="card-categorias">
                    <?= $categoria["descricao"] ?>
                    <img onclick="deletar(<?= $categoria['id'] ?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png" />
                </div>
                <?php
                }
                ?>
                <form id="form-deletar" method="POST" action="./acoes.php">
                    <input type="hidden" name="acao" value="deletar"/>
                    <input id="categoria-id" type="hidden" name="categoriaId" value=""/>
                </form>
            </main>
        </section>
    </div>
    <script lang="javascript">
        function deletar(categoriaId){
            
        //Coloca o id da categoria no input hidden categoria-id
        document.querySelector("#categoria-id").value = categoriaId;

        //Envia formulario de deleção 
        document.querySelector("#form-deletar").submit();
        }
    </script>   
</body>

</html>