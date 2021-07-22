<?php
Class Produto {
    private $pdo;
    public $msgErro= "";

    //Metodo para conectar com banco de dados
    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        try {
            $pdo = new PDO ("mysql:host=localhost;dbname=projeto_login", $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e -> getMessage(); 
        }
    }


    //Enviar informação do cadastro de produtos para o banco de dados
    public function cadastrarProdutos($nomeProduto, $armazenamento, $preco) {
        global $pdo;
        $sql = $pdo -> prepare("SELECT id_Produto FROM produtos WHERE nomeProduto = :n");
        $sql -> bindValue(":n", $nomeProduto);
        $sql -> execute();

        if($sql -> rowCount() > 0) {
            return false;
        } else {
            $sql = $pdo -> prepare("INSERT INTO produtos(nomeProduto, armazenamento, preco) VALUES (:n, :a, :p)");
            $sql -> bindValue(":n", $nomeProduto);
            $sql -> bindValue(":a", $armazenamento);
            $sql -> bindValue(":p", $preco);
            $sql -> execute();
            return true;
        }
    }
}

?>