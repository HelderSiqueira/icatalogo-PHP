<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./categorias.css" />
    <title>Administrar categorias</title>
</head>
<body>
    <?php
        include("../componentes/header/header.php");
    ?>
    <div class="content">
        <section class="categorias-container">
            <main>
                <h1>Adicionar Categorias</h1>
                <form>
                    <div class="input-group">
                        <label for="descricao">descricao</label>
                        <input type="text" name="descricao" id="descricao"/>
                    </div>
                    <button type="button">Cancelar</button>
                    <button type="button">Salvar</button>
                </form>
                <h1>Lista de categorias</h1>
                <div class="card-categorias">
                    Roupas
                </div>
            </main>
        </section>
    </div>
</body>
</html>