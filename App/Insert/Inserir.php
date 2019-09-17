<?php
namespace App\Insert;

use DB\Conexao as DB;

class Inserir 
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

    public function inserir() {
        $bd = $this->banco;
        foreach ($this->elemento as $nome => $valor) {
        	$campos[] = "{$nome}";
        	$valores[] = "'{$valor}'";
        }
        $campos = implode(", ",$campos);
        $valores = implode(", ",$valores);

        $sql = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$valores})";
        $consulta = $bd->prepare($sql);
        $resultado = $consulta->execute();

        if( $resultado ) {
            return "<h4 class='sucesso'>Cadastrado com sucesso!!!</h4>";
        }
        return "<h4 class='erro'>Erro ao cadastrar</h4>";
    }

    public function __toString() {
        return $this->inserir();
    }

}