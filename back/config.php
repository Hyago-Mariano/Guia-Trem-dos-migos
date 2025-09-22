<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "guiatrem" /*colocar o nome do banco de dados*/ 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn -> connect_error){ 

    die("Erro na concexão: " . $conn->connect_error);

}

?>