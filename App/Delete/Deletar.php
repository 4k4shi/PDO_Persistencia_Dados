<?php
namespace App\Delete;

use DB\Conexao as DB;

class Deletar {
    private $tabela;
    private $banco;
    private $elemento;

    public function __construct($nomeTabela, $idElemento)
    {
        $this->tabela = $nomeTabela;
        $this->banco = DB::getInstance();
        $this->elemento = $idElemento;
    }

    private function apagar() {
        $bd   = $this->banco;
        $sql  = "SET FOREIGN_KEY_CHECKS = 0;"; // Desativar verificação de chaves
        $sql .= "DELETE FROM {$this->tabela} where {$this->tabela}_id = {$this->elemento};";
        $sql .= " SET FOREIGN_KEY_CHECKS = 1; "; // Reativar verificação de chaves

        $consulta  = $bd->prepare($sql);
        $resultado = $consulta->execute();

        if( $resultado ) {
            return "<h4 class='sucesso'>Registro removido com sucesso!!!</h4>";
        }
        return "<h4 class='erro'>Erro ao remover</h4>";
    }

    public function __toString() {
        return $this->apagar();
    }


}