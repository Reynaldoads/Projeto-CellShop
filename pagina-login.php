<?php
require_once'classes/usuarios.php';
$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logotipo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
    <title>CellShop - Área de login</title>
</head>
<body style="background: url('imagens/iphone-bg.jpeg'); background-size: cover;
 background-position: center; background-repeat: no-repeat;">
<section id="corpo-formulario">
    <form method="post">
            <h1>Entrar - Sistema CellShop</h1>
            <input type="email" name="email" id="" placeholder="Usuário">
            <input type="password" name="senha" id="" placeholder="Senha">
            <input type="submit" value="Acessar">
            <a href="cadastrar.php">Ainda não é usuario? <strong>cadastre-se</strong></a>
            <?php
             if(isset($_POST['email'])) {
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                
                //verificar se está preenchido
                if(!empty($email) && !empty($senha)) {
                        //Acessar o metodo logar, precisa de instanciar a classe "required"
                        //depois de instanciar, acessar os metodos da classe
                    $u-> conectar("projeto_login", "localhost","root","");    
                    if($u -> msgErro == "") {
                        if($u -> logar($email, $senha)) {
                            header("location: cadastroProdutos.php");
                        } else {
                            ?>
                        <div class="msg-erro">
                           Email ou senha incorretos!
                        </div>
                        <?php
                        }
                    }
                    else {
                        ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro; ?>
                        </div>
				        <?php
                         }
                    } else {
                        ?>
                        <div class="msg-erro">
                           Preencha todos os campos!
                        </div>
                        <?php
                    }
                }
            ?>
        </form>
</section>

</body>
</html>
