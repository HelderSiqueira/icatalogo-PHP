<link href="/componentes/header/header.css" rel="stylesheet" />
<?php
//verifica se ha mensagem na sessao
if (isset($_SESSION["mensagem"])) {
?>
    <div class="mensagem">
        <?= $_SESSION["mensagem"]; ?>
    </div>
    <script lang="javascript">
        setTimeout(() => {
            document.querySelector(".mensagem").style.display = "none";
        }, 4000);
    </script>
<?php
    //retira mensagem da sessao
    unset($_SESSION["mensagem"]);
}
?>
</div>
<header class="header">
    <figure>
        <a href="/produtos"> 
            <img src="/imgs/logo.png" />
        </a>    
    </figure>
    <form method="GET" action="/produtos/index.php">
        <input type="text" id="pesquisar" value="<?= isset($_GET["p"]) ? $_GET["p"] : "" ?>" placeholder="Pesquisar" name="p"/>
        <button <?= isset($_GET["p"]) && $_GET["p"] != "" ? "onClick='limparFiltro()'" : "" ?>>
            <?php
            if(isset($_GET["p"]) && $_GET["p"] !=""){
            ?>
                <img style="width: 15px" src="/imgs/close.svg"/>
            <?php
            }else{
            ?>
            <img src="/imgs/lupa.svg"/>
            <?php
            }
            ?>
        </button>   
    </form>    
    <?php
    if (!isset($_SESSION["usuarioId"])) {
    ?>
        <nav>
            <ul>
                <a id="menu-admin">Administrador</a>
            </ul>
        </nav>
        <div class="container-login" id="container-login">
            <h1>Fazer login</h1>
            <form method="POST" action="/componentes/header/acoesLogin.php">
                <input type="hidden" name="acao" value="login" />
                <input type="text" name="usuario" placeholder="Usuário" />
                <input type="password" name="senha" placeholder="Senha" />
                <button>Entrar</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <nav>
            <ul>
                <a id="menu-admin" onclick="logout()">Sair</a>
            </ul>
        </nav>
        <form id="form-logout" style="display: none" method="POST" action="/componentes/header/acoesLogin.php">
            <input type="hidden" name="acao" value="logout">
        </form>
    <?php
    }
    ?>
</header>
<script lang="javascript">
    function logout() {
        document.querySelector("#form-logout").submit();
    }
    //selecionamos o botão administrar e adicionamos o evento de click para ele
    document.querySelector("#menu-admin").addEventListener("click", toggleLogin);
    //função do evento do click
    function toggleLogin() {
        let containerLogin = document.querySelector("#container-login");
        let formContainer = document.querySelector("#container-login > form");
        let h1Container = document.querySelector("#container-login > h1");
        //se o container estiver oculto, motramos
        if (containerLogin.style.opacity == 0) {
            formContainer.style.display = "flex";
            h1Container.style.display = "block";
            containerLogin.style.opacity = 1;
            containerLogin.style.height = "200px";
        } else {
            //se não, ocultamos
            formContainer.style.display = "none";
            h1Container.style.display = "none";
            containerLogin.style.opacity = 0;
            containerLogin.style.height = "0px";
        }
    }

    function limparFiltro(){
        document.querySelector("#pesquisar").value = "";
    }

</script>