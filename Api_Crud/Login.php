<?php
include "Conexao.php";
//include "Lembretes.php";
//require_once 'Conexao.php'; // ou include 'config.php'
class Login
{
    //Criamos uma função para verificar ou avalidar login e senha
    public static function verificarLogin($dados)
    {
        $tabela = "usuario";
        $colunaLogin = "login";
        $colunaSenha = "senha";

        // Conectando com o banco de dados através da classe (objeto) PDO
        // pegando as informações do config.php (variáveis globais)
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);

        // Usando comando sql que será executado no banco de dados para avalidar login e senha
        $sql = "select * from $tabela where $colunaLogin =:login and $colunaSenha =:senha";

        //preparando o comando Select do SQL para ser executado usando método prepare()
        $stmt = $connPdo->prepare($sql);

        //configurando (ou mapear) o parametro de busca
        $stmt->bindValue(':login', $dados['login']);
        $stmt->bindValue(':senha', $dados['senha']);

        // Executando o comando select do SQL no banco de dados
        $stmt->execute();

        if ($stmt->rowCount() > 0) // se houve retorno de dados (Registros)
        {
            // retornando os dados do banco de dados através do método fetch(...)
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else { // se não houve retorno de dados, jogar no classe Exception (erro)
            // e mostrar a mensagem "Login incorreto"                
            throw new Exception("Login incorreto");
        }
    }
}
