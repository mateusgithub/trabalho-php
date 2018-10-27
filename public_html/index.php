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
		<div style="float: left;">
			<h1>Login</h1>
			
			<form action="login.php" method="POST">
				<p>Usuário<p>
				<input type="text" name="usuario">

				<p>Senha</p>
				<input type="text" name="senha">

				<p><input type="submit" value="Login" name="login_btn"></p>
			</form>

			<?php
				$conn = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
				$sql = "CREATE TABLE usuario (usuario varchar(50) NOT NULL PRIMARY KEY,
						senha varchar(50) NOT NULL,
						cargo smallint NOT NULL);";
				$conn->exec($sql);

				$sql = "INSERT INTO usuario (usuario, senha, cargo) VALUES ('admin', 'admin', 0)";
				$conn->exec($sql);
			?>
		</div>
	</body>
</html>

