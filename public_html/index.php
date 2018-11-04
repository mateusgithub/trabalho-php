<?php
	include_once 'dao/Database.php';
	session_start();
	unset($_SESSION['usuario_logado']);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	 	<title>Trabalho 3 - Login</title>
	</head>
	<body>	
		<div id="login_box">
			<h1>Login</h1>
			
			<form action="controller/login.php" method="POST">
				<p>Usuário<p>
				<input class="input_login" type="text" name="usuario">

				<p>Senha</p>
				<input class="input_login" type="password" name="senha">

				<?php 
					if(isset($_SESSION['erro_login'])) {
						echo "<p class='mensagem-erro'>".$_SESSION['erro_login']."</p>";
					} else {
						echo "<p class='mensagem-erro'/>";
					}
				?>

				<p><input class= "input_login" type="submit" value="Login" name="login_btn"></p>
			</form>

			<?php
				Database::inicializarTabelaUsuario();
			?>
		</div>
	</body>
</html>

