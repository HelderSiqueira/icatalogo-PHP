<?php

session_start();

require("../database/conexao.php");

function validarCampos(){
  $erros = [];

  if(!isset($_POST["descricao"]) || $_POST["descricao"] == ""){
    $erros[] = "O campo descrição é obrigatório";
  }

  return $erros;
}

switch ($_POST["acao"]) {
  case "inserir":

    $erros = validarCampos();

    if(count($erros) > 0){
      $_SESSION["mensagem"] = $erros[0];

      header("location: index.php");

      exit();
    }

    //receber os campos do formulário
    $descricao = $_POST["descricao"];

    //declarar o sql 
    $sql = " INSERT INTO tbl_categoria (descricao) VALUES ('$descricao')";

    //executar o sql
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    //verificar se deu certo
    if($resultado){
      $_SESSION["mensagem"] = "Categoria incluída com sucesso";
    }else{
      $_SESSION["mensagem"] = "Ops, erro ao incluir categoria";
    }

    //redirecionar para index de categorias
    header("location: index.php");

    break;

  case "deletar":

    //receber o id da categoria
    $categoriaId = $_POST["categoriaId"];

    //montar o sql de deleção
    $sql = " DELETE FROM tbl_categoria WHERE id = $categoriaId ";

    //executar o sql
    $resultado = mysqli_query($conexao, $sql);

    //verificar se deu certo
    if($resultado){
      $_SESSION["mensagem"] = "Categoria excluída com sucesso.";
    }else{
      $_SESSION["mensagem"] = "Ops, problemas ao excluir.";
    }
    //redirecionar para index de categorias
    header("location: index.php");

    break;
}