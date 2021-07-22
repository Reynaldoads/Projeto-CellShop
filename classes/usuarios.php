<?php 
Class Usuario {

    private $pdo;
    public $msgErro = "";
    //Metodo para conectar com banco de dados
    public function conectar($nome, $host, $usuario, $senha){
        global $pdo;
        try {
            //$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            $pdo = new PDO ("mysql:host=localhost;dbname=projeto_login", $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e -> getMessage(); 
        }
    }
    //enviar informações para o banco de dados
    public function cadastrar($nome, $telefone, $cpf, $email, $senha) {
        global $pdo;
        //verificar se já existe email cadastrado
        $sql = $pdo ->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql -> bindValue(":e", $email);
        $sql -> execute();

        //Se na contagem de linhas tiver um valor maior que 0, já possui alguem cadastrado.
        if($sql -> rowCount() > 0) {

            //pessoa não cadastrada
            return false;

        } else {
            //caso não, Cadastrar atraves do comando Insert
            $sql = $pdo -> prepare("INSERT INTO usuarios(nome, telefone, cpf, email, senha) VALUES (:n, :t, :c, :e, :s)");
            $sql -> bindValue(":n", $nome);
            $sql -> bindValue(":t", $telefone);
            $sql -> bindValue(":c", $cpf);
            $sql -> bindValue(":e", $email);
            $sql -> bindValue(":s", md5($senha));
            $sql -> execute();

            //pessoa cadastrada com sucesso
            return true;
        }
        
        //caso não esteja cadastrado, cadastraremos no BD
    }

    //Verificar se a pessoa está cadastrada ou não
    public function logar($email, $senha) {
        global $pdo;
        //verificar se o email e senha estao cadastrados, se sim, entrar no sistema (sessao)

        //Selecione o ID do usuario onde o EMAIL e a senha são iguais
        // aos que estão cadastrados no banco
        $sql = $pdo -> prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha =:s");
        $sql -> bindValue(":e", $email);
        $sql -> bindValue(":s", md5($senha));
        $sql ->execute();

        //Se os dados dessa consulta serem maiores que 0, a pessoa tá cadastrada
        //caso contrario, não está cadastrada
        if($sql -> rowCount() > 0) {
            //entrar no sistema

            //fetch pega tudo do BD e transforma em um array
            $dado = $sql -> fetch();

            //startar a sessão
            session_start();

            //pegar dado da coluna usuario e armazenar na sessão de mesmo nome, ($dado['id_usuario'])
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //logado com sucesso
        } else {
            return false; //não foi possivel logar
        }
    }
}

?>