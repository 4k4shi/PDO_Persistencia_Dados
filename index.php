<?php
// Importar autoload
require_once __DIR__ . "/App/autoload.php";

use App\Update\Editar;
use App\Delete\Deletar;
use App\Read\Visualizar;
use App\Insert\Inserir;

?>
<!DOCTYPE html><html><head><title>Página Inicial</title> <style> * {font-family: calibri;padding: 0px;margin: 0px;} body {background: #f3f3f3;padding: 10px 0px;} table {width: 95%;border: solid 2px #342;border-radius: 6px;margin: 0 auto;background: #fff;margin-top: 10px;padding: 10px;} th,td {border: none;} th {padding: 6px 0px;} td {text-align: center;padding: 6px;} tr:hover,td:hover {background: linear-gradient(top black, white);}input{padding: 8px 12px;margin: 2px 4px;border: none;border-radius: 3px;transition: 0.5s;cursor: pointer;} .excluir:hover {background: #d34;transition: 0.5s;} .editar:hover {background: #fe3;transition: 0.5s;} .sucesso, .erro {width: 94%;border-radius: 5px;padding: 10px 5px;text-align: center;margin: 0 auto;}.sucesso{background: rgba(120,200,120,.8);color: green;}.erro{background: rgba(200,120,120,.8);color: red;}a{margin-top: 3px;text-decoration: none;color: orange;font-weight: bold;font-size: 1.2em;padding: 4px 9px;border-radius: 5px;}a:hover{transition: 0.6s;color: white;background: rgb(120,120,140);}.links {width: 80%;text-align: center;margin: 0 auto;padding: 20px;background: rgba(1,1,1,.1);border-radius: 5px;}.links a {margin: 0px 10px;}</style></head><body>
<?php
    if(isset($_GET['tabela'])){
        if(isset($_POST['excluir']) && !isset($_POST['editar']) && isset($_POST['elemento'])){
            $excluir = new Deletar($_GET['tabela'],$_POST['elemento']);
            if($excluir){
                echo $excluir;
            }
        }
        elseif(!isset($_POST['excluir']) && !isset($_POST['editar']) && isset($_POST['inserir'])){
            $tabela = $_POST['tabela'];
            unset($_POST['tabela']);unset($_POST['inserir']);
            $inserir = new Inserir($tabela,$_POST);
            if($inserir){
                echo $inserir;
            }
        }
        elseif(!isset($_POST['excluir']) && isset($_POST['editar']) && !isset($_POST['inserir'])){
            $tabela = $_POST['tabela'];
            unset($_POST['tabela']);unset($_POST['editar']);
            $editar = new Editar($tabela,$_POST);
            if($editar){
                echo $editar;
            }
        }
        $lista = new Visualizar($_GET['tabela']);
        $tabela = $lista->buscar();

?>
<a href="index.php" style="position: absolute;left: 25px;">Menu</a>
<table>
    <caption>
        <a href="criar.php?tabela=<?= $_GET['tabela'] ?>">Inserir</a><h3>Tabela <?= $_GET['tabela'] ?></h3>
    </caption>
    <thead>
        <?php
            if($tabela){
             foreach($tabela as $linha => $res){?>
            
        <tr>
            <?php foreach($res as $li => $nome){ ?>
                <th><?= $li ?></th>
            <?php } ?>
            <th>Funções</th>
        </tr>        
        <?php break; } ?>
    </thead>
    <tbody style="border: solid 1px black;">
        <?php
            foreach($tabela as $linha){ ?>
                <tr>
                    <form action="index.php?tabela=<?= $_GET['tabela'] ?>" method="POST">
                        <?php
                        foreach($linha as $resp){
                                $c = $_GET['tabela'].'_id';
                                $id = $linha[$c];
                            ?>
                            <td><?= $resp ?></td>
                        <?php } ?>
                        <td style="width: 150px;text-align: center;">
                            <input type="hidden" name="elemento" value="<?= $id ?>">                        
                            <input type="submit" name="excluir" value="Excluir" class="excluir">
                            <a href="editar.php?elemento=<?= $id ?>&&tabela=<?= $_GET['tabela'] ?>" title="Editar">Editar</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
    </tbody>
</table></body></html><?php } } else{ ?>
    <h1 style="padding: 10px 20px">Tabelas</h1>
    <div class="links">
        <a href="index.php?tabela=aluguel">Aluguel</a>
        <a href="index.php?tabela=ator">Ator</a>
        <a href="index.php?tabela=categoria">Categoria</a>
        <a href="index.php?tabela=cidade">Cidade</a>
        <a href="index.php?tabela=cliente">Cliente</a>
        <a href="index.php?tabela=endereco">Endereco</a>
        <a href="index.php?tabela=filme">Filme</a>
        <a href="index.php?tabela=filme_ator">Filme_ator</a>
        <a href="index.php?tabela=filme_categoria">Filme_categoria</a>
        <a href="index.php?tabela=filme_texto">Filme_texto</a>
        <a href="index.php?tabela=funcionario">Funcionario</a>
        <a href="index.php?tabela=idioma">Idioma</a>
        <a href="index.php?tabela=inventario">Inventario</a>
        <a href="index.php?tabela=loja">Loja</a>
        <a href="index.php?tabela=pagamento">Pagamento</a>
        <a href="index.php?tabela=pais">Pais</a>
    </div>
<?php } ?>