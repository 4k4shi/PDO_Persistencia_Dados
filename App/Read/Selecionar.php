<?php
namespace App\Read;

use DB\Conexao as DB;

class Selecionar
{
    private $tabela;
    private $banco;
    private $elemento;

    public function __construct($nomeTabela, $elemento)
    {
        $this->tabela = $nomeTabela;
        $this->banco = DB::getInstance();
        $this->elemento = $elemento;
    }

    public function selecionar() {
        $bd = $this->banco;
        $sql = "SELECT * FROM {$this->tabela} WHERE {$this->tabela}_id = '{$this->elemento}'";
        $consulta = $bd->prepare($sql);
        $resultado = $consulta->execute();

        if( $resultado ) {
            $array_resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);
            return $array_resultado;
        }
        return false;
    }
}