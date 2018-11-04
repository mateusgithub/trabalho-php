<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Home</title>
	</head>
	<body>	
		<?php
			include 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<?php
				session_start();
				$usuarioLogado = unserialize($_SESSION['usuario_logado']);
				echo "<h2>Bem vindo, ".$usuarioLogado->getUsuario()."</h2><hr>";
				echo "<p>Cargo: ".$usuarioLogado->getCargo()."</h2>";
			?>
		</div>
	</body>
</html>