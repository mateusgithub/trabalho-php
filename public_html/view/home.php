<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	if(!isset($_SESSION['usuario_logado'])) {
		header("location:../view/index.php");
	}
?><!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css?v=1">
	 	<title>Trabalho 3 - Home</title>
	</head>
	<body>	
		<?php
			require 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<?php
				$usuarioLogado = unserialize($_SESSION['usuario_logado']);
				echo "<h2>Bem vindo, ".$usuarioLogado->getUsuario()."</h2><hr>";
				echo "<p>Cargo: ".$usuarioLogado->getCargo()."</p>";
			?>
		</div>
	</body>
</html>