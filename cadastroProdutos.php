<?php 
session_start();
if(!isset($_SESSION['id_usuario'])) {
    header("location: pagina-login.php");
    exit;
}
require_once'classes/produtos.php';
require_once'classes/usuarios.php';
    $u = new Usuario;
    $p = new Produto;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/logotipo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
    <title>CellShop - Cadastro de produtos</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }
        #cadastro-produto-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* border: 1px solid red; */
        }.cad-pro-box {
            height: 600px;
            display: flex;
            align-items: center;
            border: 2px solid black;
            border-radius: 40px;
            -webkit-box-shadow: 12px 13px 11px -5px rgba(0,0,0,0.5); 
        box-shadow: 12px 13px 11px -5px rgba(0,0,0,0.5);
        }
        .cad-pro-box img {
            border-radius: 40px 0px 0px 40px;
            height: 100%;

        }
        .cad-pro-box form {
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .cad-pro-box form input:nth-child(5) {
            width: 400px;
            background: rgb(119,30,255);
            background: linear-gradient(90deg, rgba(119,30,255,1) 15%, rgba(0,219,232,1) 100%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="cadastro-produto-container">
       <div class="cad-pro-box">
            <img src="imagens/imagem-cadastro.png" alt="">
            <form method="post">
                <h1>Cadastro de produtos</h1>
                <input type="text" name="nomeProduto" id="" placeholder="Insira o nome do produto" maxlength="40">
                <input type="number" name="armazenamento" id="" placeholder="Insira o tamanho de armazenamento em GB" maxlength="3">
                <input type="text" name="preco" id="preco" placeholder="Insira o valor do produto" maxlength="8" onkeyup="mascaraPreco()">
                <input type="submit" value="Cadastrar">
                <a href="sair.php">Voltar para página anterior</a>
                <?php
                if(isset($_POST['nomeProduto'])) {
                    $nomeProduto = addslashes($_POST['nomeProduto']);
                    $armazenamento = addslashes($_POST['armazenamento']);
                    $preco = addslashes($_POST['preco']);
                

                if(!empty($nomeProduto) && !empty($armazenamento) && !empty($preco)) {
                    $p -> conectar("projeto_login", "localhost", "root", "");
                    if($p -> cadastrarProdutos($nomeProduto,$armazenamento, $preco)) {
                        ?> 
                        <div id="msg-sucesso">
                           Produto cadastrado com sucesso!
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="msg-erro">
                           Produto já cadastrado.
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
            
        </div>
    </div>
</body>
<script>
    function mascaraPreco() {
        var preco = document.getElementById('preco');
        if(preco.value.length == 1) {
            preco.value+="."
        } else if(preco.value.length == 5) {
            preco.value +=","
        }
    }
</script>
</html>
