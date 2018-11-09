<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Usuario.php';

	class MedicoDAO {
		
		public function salvarUsuarioMedico($usuario) {
			$conn = Database::getConexao();

			$sql = "SELECT COUNT(1) FROM usuario WHERE usuario = :usuario";

			$result = $conn->prepare($sql);
			$result->execute(array(
				':usuario' => $usuario->getUsuario()
			));
			
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				$sql = "UPDATE usuario SET nome = :nome, cpf = :cpf, senha = :senha WHERE usuario = :usuario AND cargo = 'medico'";
				$result = $conn->prepare($sql);
				$result->execute(array(
					':nome' => $usuario->getNome(),
					':cpf' => $usuario->getCpf(),
					':senha' => $usuario->getSenha(),
					':usuario' => $usuario->getUsuario()
				));
			} else {
				$sql = "INSERT INTO usuario (usuario, nome, cpf, senha, cargo) VALUES (:usuario, :nome, :cpf, :senha, 'medico')";
				
				$result = $conn->prepare($sql);
				$result->execute(array(
					':nome' => $usuario->getNome(),
					':cpf' => $usuario->getCpf(),
					':senha' => $usuario->getSenha(),
					':usuario' => $usuario->getUsuario()
				));
			}
		}
		
		
	}
