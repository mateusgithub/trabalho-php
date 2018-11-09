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
		<link rel="stylesheet" type="text/css" href="style.css">
	 	<title>Trabalho 3 - Login</title>
	</head>
	<body id="corpoIndex">	
		<div id="login_box">
			<img id="login" src="login.jpg" alt="imagem de login"/>
			<form id="formIndex" action="../controller/login.php" method="POST">
				<p class="fontUser">Usuário</p>
				<input class="input_login" placeholder="Entre com o username" type="text" name="usuario" required>
				<p class="fontUser">Senha</p>
				<input class="input_login" placeholder="Entre com a senha" type="password" name="senha" required>

				<p class='mensagem-erro'><?php echo $erroLogin;?></p>
				
				<p><input id="input" type="submit" value="Login" name="login_btn"></p>
			</form>

			<?php
				Database::inicializarTabelaUsuario();
			?>
		</div>
	</body>
</html>

