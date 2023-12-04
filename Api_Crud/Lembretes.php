<?php

include "Conexao.php";

class Lembretes
{
    // Método para fazer consulta através do parâmetro $id
    public static function select(int $id)
    {
        $tabela = "lembrete";
        $coluna = "id";

        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);

        $sql = "SELECT * FROM $tabela WHERE $coluna = :id";
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        try {
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Sem registro do usuário com ID $id");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro PDO ao executar consulta: " . $e->getMessage());
        }
    }

    // Método para consultar todos os dados sem parâmetro
    public static function selectAll()
    {
        $tabela = "lembretes";

        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);

        $sql = "SELECT * FROM $tabela";
        $stmt = $connPdo->prepare($sql);

        try {
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Sem registros na tabela $tabela");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro PDO ao executar consulta: " . $e->getMessage());
        }
    }

    // Método para inserir dados no BD
    public static function insert($dados)
    {
        $tabela = "lembretes";
        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);

        $sql = "INSERT INTO $tabela (titulo, descricao) VALUES (:titulo, :descricao)";
        $stmt = $connPdo->prepare($sql);

        try {
            $stmt->bindValue(':titulo', $dados['titulo']);
            $stmt->bindValue(':descricao', $dados['descricao']);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Dados cadastrados com sucesso!!!';
            } else {
                throw new Exception("Erro ao inserir os dados. Nenhuma linha afetada.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro PDO ao inserir os dados: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir os dados: " . $e->getMessage());
        }
    }

    // Método para fazer alteração de um determinado registro no BD
    public static function alterar($titulo, $dados)
    {
        $tabela = "lembretes";
        $coluna = "titulo";

        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);
        $sql = "UPDATE $tabela SET titulo=:titulo, descricao=:descricao WHERE $coluna = :titulo";
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descricao', $dados['descricao']);

        try {
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Dados alterados com sucesso!';
            } else {
                throw new Exception("Erro ao alterar os dados. Nenhuma linha afetada.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro PDO ao alterar os dados: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Erro ao alterar os dados: " . $e->getMessage());
        }
    }

    // Método para fazer exclusão de um determinado registro através do título
    public static function delete($titulo)
    {
        $tabela = "lembretes";
        $coluna = "titulo";

        $connPdo = new PDO(dbDrive . ':host=' . dbHost . '; dbname=' . dbName, dbUser, dbPass);

        $sql = "DELETE FROM $tabela WHERE $coluna = :titulo";
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':titulo', $titulo);

        try {
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return 'Dados excluídos com sucesso!';
            } else {
                throw new Exception("Erro ao excluir os dados. Nenhuma linha afetada.");
            }
        } catch (PDOException $e) {
            throw new Exception("Erro PDO ao excluir os dados: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir os dados: " . $e->getMessage());
        }
    }
}
