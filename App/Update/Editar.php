<?php
namespace App\Update;

use DB\Conexao as DB;

class Editar
{
    private $tabela;
    private $banco;
    private $elemento;

    public function __construct($nomeTabela,$elemento)
    {
        $this->tabela = $nomeTabela;
        $this->banco = DB::getInstance();
        $this->elemento = $elemento;
    }

    public function editar() {
        $bd = $this->banco;
        foreach ($this->elemento as $nome => $valor) {
            if($nome == $this->tabela.'_id'){$id = $valor;}
        	$campos[] = "{$nome} = '{$valor}'";
        }
        $campos = implode(", ",$campos);

        $sql = "UPDATE {$this->tabela} SET {$campos} WHERE {$this->tabela}_id = '$id'";
        $consulta = $bd->prepare($sql);
        $resultado = $consulta->execute();

        if( $resultado ) {
            return "<h4 class='sucesso'>Editado com sucesso!!!</h4>";
        }
        return "<h4 class='erro'>Erro ao editar</h4>";
    }

    public function __toString() {
        return $this->editar();
    }

}