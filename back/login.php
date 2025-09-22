<?php
require "bd.php";

header("Cache-control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

/*
echo "<pre>";
var_dump($conn);
echo "</pre>";
*/

/*
echo "<pre>";
var_dump($_SERVER);
echo "</pre>";

echo "<br><br>";

echo "<pre>";
var_dump($_POST);
echo "</pre>";

echo "<br><br>";

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
*/

session_start();

// Se já estiver logado, vai direto para a turma
if (isset($_SESSION["nome_professor"])) {
    header("Location: turma.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /*
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    */

    $email = trim($_POST["email"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    $stmt = $conn->prepare("SELECT pk_professor, nome_professor, senha_professor FROM professor WHERE email_professor = ? AND senha_professor = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();
        $_SESSION["nome_professor"] = $dados["nome_professor"];
        $_SESSION["professor_id"] = $dados["pk_professor"];
        $_SESSION["conectado"] = true;

        /*
        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";
        */

        header("Location: turma.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Login - Professores</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <section class="login">
            <div class="content text-center mb-4">
                <h1 class="text-primary mb-1 fw-bold ">- LOGIN -</h1>
                <h5 class="text-primary fw-bold">GUIA TREM</h5>
            </div>

            <div class="loginIN">
                <!-- Campo de Usuário com ícone -->
                <div class="input-group mb-3 ">
                    <span class="input-group-text">
                        <img src="../imagens/person.png" alt="usuário" width="20">
                    </span>
                    <input type="text" class="form-control" id="login" placeholder="Login">
                </div>

                <!-- Campo de Senha com ícone -->
                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <img src="../imagens/senhas.png" alt="senha" width="20">
                    </span>
                    <input type="password" class="form-control" id="password" placeholder="Senha">
                </div>

                <button id="loginButton" class="btn btn-primary btn-lg">CONECTAR</button>
                <div id="errorMessage" class="alert alert-danger mt-3 d-none"></div>
            </div>
        </section>
    </header>
    <main>

    </main>



    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
        <?php if ($erro): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>
    </form>
</body>

</html>