<?php

include 'Lembretes.php';

class LembretesService
{
    public function get( $titulo = null)
    {
        try {
            if ($titulo) {
                return Lembretes::select($titulo);
            } else {
                return lembretes::selectAll();
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao obter dados: " . $e->getMessage());
        }
    }

    public function post()
    {
        try {
            $dados = json_decode(file_get_contents('php://input'), true, 512);
            if ($dados === null) {
                throw new Exception("Faltou as informações para incluir");
            }

            return lembretes::insert($dados);
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir dados: " . $e->getMessage());
        }
    }

    public function put($titulo = null)
    {
        try {
            if ($titulo === null) {
                throw new Exception("Falta o código");
            }

            $dados = json_decode(file_get_contents('php://input'), true, 512);
            if ($dados === null) {
                throw new Exception("Faltou as informações para alterar");
            }

            return lembretes::alterar($titulo, $dados);
        } catch (Exception $e) {
            throw new Exception("Erro ao alterar dados: " . $e->getMessage());
        }
    }

    public function delete($titulo = null)
    {
        try {
            if ($titulo === null) {
                throw new Exception("Falta o código");
            }

            return lembretes::delete($titulo);
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir dados: " . $e->getMessage());
        }
    }
}

