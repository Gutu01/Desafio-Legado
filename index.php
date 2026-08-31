<?php
    require 'login.php';
    $usuario = new Usuario();
    $usuario->conectar("legado", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="text" name="email">
        <input type="password" name="senha">
        <input type="submit" value="enviar">
    </form>
    <?php
        $usuario->conectar("legado", "localhost", "root", "");
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $usuario->logar($email,$senha);
        }
    ?>
</body>
</html>