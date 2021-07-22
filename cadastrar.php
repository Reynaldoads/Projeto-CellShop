<?php 
    require_once'classes/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logotipo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
    <title>Área de cadastro</title>
</head>
<body class="blue-color">
<section id="corpo-formulario-cad">
    <form method="POST">
        <h1>Área de cadastro</h1>
        <input type="text" name="nome" id="" placeholder="Nome completo" maxlength="40">
        <input type="text" name="telefone" id="" placeholder="Telefone"maxlength="30">
        <input type="text" name="cpf" id="cpf" placeholder="CPF" autocomplete="off" maxlength="14" onkeyup="mascaraCPF()">
        <input type="email" name="email" id="" placeholder="Email" maxlength="40">
        <input type="password" name="senha" id="" placeholder="Senha" maxlength="15">
        <input type="password" name="confSenha" id="" placeholder="Confirmar senha"maxlength="15">
        <input type="submit" value="Cadastrar">
        <a href="pagina-login.php">Clique para voltar para pagina de login</a>
        <?php 
    //Verificar se a pessoa clicou no botão
    if(isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $cpf = addslashes($_POST['cpf']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);
        
        //verificar se está preenchido
        if(!empty($nome) && !empty($telefone) && !empty($cpf) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
            //Instanciar atraves do require_once
            $u -> conectar("projeto_login", "localhost", "root", "");
            if($u ->msgErro == "") {
                if($senha == $confirmarSenha) {
                    //Ta tudo ok
                    if($u ->cadastrar($nome, $telefone, $cpf, $email, $senha)) {
                        ?> 
                        <div id="msg-sucesso">
                           "Cadastrado com sucesso, Acesse para entrar!";
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="msg-erro">
                           "Email já cadastrado!";
                        </div>
                        <?php
                    }
                } else {
                    ?>
                <div class="msg-erro">
                    As duas senhas digitadas não correspondem
                </div>
                <?php
                }
            } else {
                Echo "Erro: ".$u -> msgErro;
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
<script>
    function mascaraCPF() {
        var cpf = document.getElementById('cpf');
        if(cpf.value.length == 3 || cpf.value.length == 7 ) {
            cpf.value+= ".";
        } else if (cpf.value.length ==  11) {
            cpf.value += "-";
        }
    }
</script>
</body>
</html>