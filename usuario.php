<?php
    
    use Core\dataBase;

    class usuario {
        public function logar($email, $senha) {
            $pdo = dataBase::conectar();

            $stmt = $pdo->prepare("SELECT senha, id_perfil FROM usuario WHERE email = :e");
            $stmt->execute([':e' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

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
    $usuario = new usuario();
    $usuario->logar($_POST['email'] ?? '', $_POST['senha'] ?? '');
}
?>