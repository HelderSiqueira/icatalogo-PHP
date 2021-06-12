<?php

// senha do site - *AHZydO&OrjzxNy#4Sr4

// senha db - /R@ykjYrD~9*Socn

const HOST = "localhost";
const USER = "root";
const PASSWORD = "bcd127";
const DATABASE = "icatalogo";

$conexao = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

if ($conexao == false) {
    die(mysqli_connect_error());
}
