<?php
$conn = new mysqli("locahost", "root", "", "sistema_login");

if ($_SERVER["REQUEST_METHOD"] === "POST"){

    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $funcao = $_POST ["funcao"];

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn ->prepare("INSERT INTO usuario (email_usuario, senha_usuario, funcao) VALUES (?, ?, ?)");
    $stmt -> bind_param("sss", $email, $senhaHash, $funcao);

    if($stmt -> execute()){
        echo "Usuario cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

}
?>

<form method="POST">
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    Função: <input type="text" name="funcao" required><br>
    <button type="submit">Cadastrar</button>
</form>
