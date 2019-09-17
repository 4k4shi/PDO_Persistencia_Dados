<?php
namespace App\Read;

use DB\Conexao as DB;

class Visualizar 
{
    private $tabela;
    private $banco;

    public function __construct($nomeTabela)
    {
        $this->tabela = $nomeTabela;
        $this->banco = DB::getInstance();
    }

    public function buscar() {
        $bd = $this->banco;
        $sql = "SELECT * FROM {$this->tabela} order by {$this->tabela}_id  limit 50 ";
        $consulta = $bd->prepare($sql);
        $resultado = $consulta->execute();

        if( $resultado ) {
            $array_resultado = $consulta->fetchAll(\PDO::FETCH_ASSOC);
            return $array_resultado;
        }

        return false;

    }

}