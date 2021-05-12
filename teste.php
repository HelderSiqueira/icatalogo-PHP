<?php

    session_start();

    require("./database/conexao.php");

    var_dump(is_numeric(""));


    echo $_SESSION["minhaString"];