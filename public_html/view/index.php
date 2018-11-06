<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	$erroLogin = "";
	
	if(isset($_SESSION)) {
		if(isset($_SESSION['erro_login'])) {
			$erroLogin = $_SESSION['erro_login'];
		}
		
		session_destroy();
	}
	
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	unset($_SESSION['usuario_logado']);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Login</title>
	</head>
	<body>	
		<div id="login_box">
			<h1>Login</h1>
			
			<form action="../controller/login.php" method="POST">
				<p>Usuário<p>
				<input class="input_login" type="text" name="usuario">

				<p>Senha</p>
				<input class="input_login" type="password" name="senha">

				<p class='mensagem-erro'><?php echo $erroLogin;?></p>
				
				<p><input class= "input_login" type="submit" value="Login" name="login_btn"></p>
			</form>

			<?php
				Database::inicializarTabelaUsuario();
			?>
		</div>
	</body>
</html>

