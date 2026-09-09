<?php

    require "../Desafio-Legado/dataBase.php";
    use Core\dataBase;

    class novoUsuario{
        public function novsuario($nome, $email, $cpf, $senha, $id){
            $pdo = dataBase::conectar();

            $stmt = $pdo->prepare("INSERT INTO usuario(nome, email, cpf, senha, id_perfil) VALUES(:n, :e, :c, :s, :i)");
            $stmt->execute([':n' => $nome, ':e' => $email, ':c' => $cpf, ':s' => $senha, ':i' => $id]);
        }
    }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = new novousuario();
    $usuario->novsuario($_POST['nome'] ?? '', $_POST['email'] ?? '', $_POST['cpf'] ?? '', $_POST['senha'] ?? '', $_POST['id'] ?? '');
}