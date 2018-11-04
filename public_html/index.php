<?php
	include_once 'Database.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
		<!-- <script src="javascript.js"></script> -->
	 	<title>Trabalho 3</title>
	</head>
	<body>	
		<div id="login_box">
			<h1>Login</h1>
			
			<form action="login.php" method="POST">
				<p>Usuário<p>
				<input class="input_login" type="text" name="usuario">

				<p>Senha</p>
				<input class="input_login" type="text" name="senha">

				<?php 
					if(isset($_SESSION['erro_login'])) {
						echo "<p style='color: red;'>".$_SESSION['erro_login']."</p>";
					} else {
						echo "<p style='color: red;'/>";
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

