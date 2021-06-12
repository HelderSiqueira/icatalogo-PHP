<?php
/**
 * NOTICE => notas de erros não críticos 
 * WARNINGS => alertas de erros, mas não fatais. Devem ser tratados
 * FATAL_ERROS => erros graves que impedem o funcionamento do código 
 */

session_start();

require("../database/conexao.php");

$sql = " SELECT p.*, c.descricao as categoria FROM tbl_produto p
    INNER JOIN tbl_categoria c ON p.categoria_id = c.id ";

if(isset($_GET["p"]) && $_GET["p"] !=""){
    $p = $_GET["p"];
    $sql .= " WHERE p.descricao LIKE '%$p%' OR c.descricao LIKE '%$p%' ";
}

$sql .= "ORDER BY p.id DESC";

$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./produtos.css" />
    <title>Administrar Produtos</title>
</head>

<body>
    <?php
    include("../componentes/header/header.php");
    ?>
    <div class="content">
        <section class="produtos-container">
            <?php
            //mostrar os botões somente caso o usuário esteja logado
            //verificar o $_SESSION
            if(isset($_SESSION["usuarioId"])){
            ?>
            <header>
                <button onclick="javascript:window.location.href ='./novo/'">Novo Produto</button>
                <button onclick="javascript:window.location.href ='../categorias'">Adicionar Categoria</button>
            </header>
            <?php
            }
            ?>
            <main>
            <?php
                while ($produto = mysqli_fetch_array($resultado)) {
                //verificar se tem desconto
                if($produto["desconto"] > 0){
                    //tranformou a porcentagem em decimal
                    $desconto = $produto["desconto"] / 100;
                    //calculou o valor com desconto e aplicou no valor do produto
                    $valor = $produto["valor"] - $desconto * $produto["valor"];
                }else{
                    //se não tiver desconto, o valor recebe o preço cheio
                    $valor = $produto["valor"];
                }
                //verificamos a quantidade de parcelas, se for maior que 1000 é 12, se não é 6
                $qtdeParcelas = $valor > 1000 ? 12 : 6;
                //calculamos o valor da parcela, divindo o valor total pela quantidade de parcelas
                $valorParcela = $valor / $qtdeParcelas;
                //formatamos o valor da parcela
                $valorParcela = number_format($valorParcela, 2, ",", ".");
                ?>
                <article class="card-produto">
                <?php
                if(isset($_SESSION["usuarioId"])){
                ?>
                <div class="acoes">
                    <img onclick="javascript: window.location = './editar/index.php?id=<?= $produto['id'] ?>' " src="../imgs/edit.svg"/>
                    <img onclick="deletar(<?= $produto['id'] ?>)" src="../imgs/trash.svg"/>
                </div>
                <?php
                }
                ?>
                    <figure>
                        <img src="fotos/<?= $produto["imagem"] ?>" />
                    </figure>
                <section>
                    <span class="preco">R$ <?= number_format($valor, 2, ",", ".") ?>
                    <?php
                    if($produto["desconto"] > 0){
                    ?>
                        <em>
                            <?= $produto["desconto"] ?>% off
                        </em>
                    <?php 
                    }
                    ?>
                    </span>
                    <span class="parcelamento">ou em <em><?= $qtdeParcelas ?>x R$<?= $valorParcela ?> sem juros</em></span>
                    <span class="descricao"><?= $produto["descricao"] ?></span>
                    <span class="categoria">
                        <em><?= $produto["categoria"] ?></em>
                    </span>
                </section>
                <footer>
                </footer>
                </article>
                <?php
                }
                ?>
                <form id="formDeletar" method="POST" action="./acoes.php">
                    <input type="hidden" name="acao" value="deletar"/>
                    <input id="produtoId" type="hidden" name="produtoId"/>
                </form>
            </main>
        </section>
    </div>
    <footer>
        SENAI 2021 - Todos os direitos reservados
    </footer>
    <script lang="javascript">
        function deletar(produtoId){
            if(confirm("Confirmar ação de exclusão?")){
                document.querySelector("#produtoId").value = produtoId;
                document.querySelector("#formDeletar").submit();    
            }
        }
    </script>
</body>
</html>