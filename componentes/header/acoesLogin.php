<?php

session_start();
require("../../database/conexao.php");

function ValidarCampos(){
    $erros = [];

    if(!isset($_POST["usuario"]) || $_POST["usuario"] == ""){
        $erros[] = "O campo usuário é obrigatório";
    }

    if(!isset($_POST["senha"]) || $_POST["senha"] = ""){
        $erros[] = "O campo senha é obrigatório";
    }

    return $erros; 
}

switch ($_POST["acao"]) {

    case "login":
        
        $erros = ValidarCampos();

        if(count($erros) > 0){
            $_SESSION["erros"] = $erros;

            header("location: ../../produtos/index.php");
        }
        
        //receber os campos usuário e senha do post
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        //montaro sql select na tabela tbl_administrador
        //SELECT * FROM tbl_administrador WHERE usuario = $usuario;
        $sql = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario' ";

        //executar o sql
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao)); 

        $usuario = mysqli_fetch_array($resultado);

        //verificar se o usuário existe e a senha está correta
        if(!$usuario || !password_verify($senha, $usuario["senha"])){
            //se a senha estiver errada, criar uma mensagem de "usuário e/ou senha inválidos"
            $mensagem = "Usuário e/ou senha inválidos";
        }else{
            //se estiver correta, salvar o id e o nome do usuário na sessão $_SESSION
            $_SESSION["usuarioId"] = $usuario["id"];
            $_SESSION["usuarioNome"] = $usuario["nome"];

            $mensagem = "Bem vindo, " . $usuario["nome"];
        }

        $_SESSION["mensagem"] = $mensagem;

        //redirecionar para a tela de listagem de produtos
        header("location:../../produtos/index.php");

        break;

    case "logout":
        //destruir a sessão 
        session_destroy();

        //redirecionar para index de produtos
        header("location: ../../produtos/index.php");

        break;
}


