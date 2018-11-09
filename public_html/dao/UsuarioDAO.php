<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Usuario.php';

	class UsuarioDAO {
		

		public static function buscarUsuario($usuario) {
			$conn = Database::getConexao();
			$sql = "SELECT * FROM usuario WHERE usuario = :usuario";
			$result = $conn->prepare($sql);
			$result->execute(array(
				':usuario' => $usuario
			));
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$dadosUsuario = new Usuario();
			$dadosUsuario->setCpf($row["cpf"]);
			$dadosUsuario->setUsuario($row["usuario"]);
			$dadosUsuario->setSenha($row["password"]);
			$dadosUsuario->setCargo($row["cargo"]);

			return $dadosUsuario;
		}

		public static function validarLogin($usuario, $senha) {
			$conn = Database::getConexao();
			$sql = "SELECT COUNT(1) FROM usuario WHERE usuario = :usuario AND senha = :senha";
			$result = $conn->prepare($sql);
			$result->execute(array(
				':usuario' => $usuario,
				':senha' => $senha
			));
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				return true;
			}

			return false;
		}
		
	}

