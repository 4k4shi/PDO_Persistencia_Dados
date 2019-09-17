<?php
require_once __DIR__ . "/App/autoload.php";

use App\Read\Visualizar;
$lista = new Visualizar($_GET['tabela']);
$tabela = $lista->buscar();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css" media="screen"> * {font-family: calibri;padding: 0px;margin: 0px;} body {background: #f3f3f3;padding: 10px 0px;}a{text-decoration: none;color: orange;font-weight: bold;font-size: 1.2em;} form {width: 60%;padding: 10px 15px;font-weight: bold;margin: 0 auto;} form input {width: 100%;margin: 10px 0px ;padding: 5px;border-radius: 3px;} h2{text-align: center;padding: 10px 0px;} input[type="submit"]{border-radius: 5px;cursor: pointer;font-weight: bold;font-size: 1.1em;padding: 6px 3px;background: rgb(120,200,120);border: none;text-shadow: 1px 1px 2px black;color: white;transition: 0.6s;}input[type="submit"]:hover{background: rgb(80,160,80);transition: 0.6s;}</style>
</head>
<body>
	<h2>Inserir na Tabela <cite><?= $_GET['tabela'] ?></cite></h2>
	<form action="index.php?tabela=<?= $_GET['tabela']?>" method="POST">
		<cite style="color: gray;font-size: 1.2em;">Por favor adicione o formato de data neste quesito: <small>aaaa-mm-dd hh-mm-ss; e ID do funcionário equivalente a 1 ou 2</small></cite><br/>
		<?php
		foreach ($tabela as $key) {
			foreach ($key as $nome => $valor) {?>
				<label><?= $nome ?><br/><input type="text" name="<?= $nome ?>"/></label><br/>		
			<?php }
		break;} ?>
		<input type="hidden" name="tabela" value="<?= $_GET['tabela'] ?>">
		<input type="submit" name="inserir" value="Inserir">
	</form>
</body>
</html>