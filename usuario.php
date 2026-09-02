<?php


class Usuario {
    private function conectar() {
        return new PDO(
            "mysql:host=localhost;dbname=legado;charset=utf8mb4", "root", ""
        );
    }

    public function logar($email, $senha) {
        $pdo = $this->conectar();

        $stmt = $pdo->prepare("SELECT senha, id_perfil FROM usuario WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $_SESSION['erro'] = "Email não encontrado.";
            header("Location: index.php");
            exit;
        }

        if ($senha === $usuario['senha']) {
            $_SESSION['id_perfil'] = $usuario['id_perfil'];

            if ($usuario['id_perfil'] == 1) {
                header("Location: adm.php");
                exit;
            }

            if ($usuario['id_perfil'] == 2) {
                header("Location: plebe.php");
                exit;
            }
        }

        $_SESSION['erro'] = "Senha inválida.";
        header("Location: index.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario();
    $usuario->logar($_POST['email'] ?? '', $_POST['senha'] ?? '');
}
?>