<?php

    Class Usuario{

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;

            $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
        }

        public function logar($email, $senha)
        {
            echo "oi";
            global $pdo;
            
            $usuario = $pdo->prepare("SELECT senha FROM usuario u WHERE u.email = $email");
            $usuario->execute();
            $uSenha = $usuario->fetch(PDO::FETCH_ASSOC);
            echo "oi";

            if ($uSenha == $senha){    
                $usuario = $pdo->prepare("SELECT id_perfil FROM usuario u WHERE u.email = $email");
                $usuario->execute();
                $idPerfil = $usuario->fetch(PDO::FETCH_ASSOC);
                if($idPerfil == 1){
                    header("location:adm.php");
                } elseif ($idPerfil == 2){
                    header("location:plebe.php");
                }
            }
        }
    }
?>