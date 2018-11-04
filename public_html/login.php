<?php
	include_once 'Database.php';
	session_start();

	if(isset($_POST['login_btn'])){
		unset($_SESSION['erro_login']);
		unset($_SESSION['erro_cadastro']);

		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];

		//Se usuario encontrado
		if(Database::validarLogin($usuario, $senha)) {
			$usuarioLogado = Database::buscarUsuario($usuario);
			$_SESSION['usuario_logado'] = serialize($usuarioLogado);
			header("location:/home.php");
		} else {
			$_SESSION['erro_login'] = "Usuário e/ou senha incorretos";
			header("location:/index.php");
		}
	}

?>