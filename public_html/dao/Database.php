<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../model/Usuario.php';

	class Database {

		private static $host = "localhost";
		private static $user = "root";
		private static $password = "root";
		private static $database = "trabalho_php_si401";

		private static function conectar() {
			return new PDO("mysql:host=".self::$host.";dbname=".self::$database, self::$user, self::$password);
		}
		
		private static function criarBanco() {
			$connection = new PDO("mysql:host=".self::$host, self::$user, self::$password);

			$connection->exec("CREATE DATABASE `".self::$database."`;
					CREATE USER '".self::$user."'@'".self::$host."' IDENTIFIED BY '".self::$password."';
					GRANT ALL ON `".self::$database."`.* TO '".self::$user."'@'".self::$host."';
					FLUSH PRIVILEGES;");
		}
		
		public static function getConexao() {
			try {
				return self::conectar();
			}
			catch(PDOException $e) {
				self::criarBanco();
				return self::conectar();
			}
		}

		public static function inicializarTabelaUsuario() {
			$conn = self::getConexao();
			$sql = "CREATE TABLE usuario (usuario varchar(50) NOT NULL PRIMARY KEY,
					nome varchar(100) NULL,
					cpf varchar(11) NULL,
					senha varchar(50) NOT NULL,
					cargo varchar(50) NOT NULL);";
			$conn->exec($sql);

			$sql = "CREATE TABLE paciente (cpf varchar(11) NOT NULL PRIMARY KEY,
					nome_completo varchar(100) NULL,
					data_aniversario varchar(50) NULL,
					telefone varchar(50) NULL,
					email varchar(50) NULL,
					tipo_sanguineo varchar(3) NULL,
					alergias varchar(255) NULL,
					plano_saude varchar(50) NULL,
					prontuario varchar(255) NULL);";
			$conn->exec($sql);

			$sql = "INSERT INTO usuario (usuario, nome, cpf, senha, cargo) VALUES ('admin', 'admin', '11111111111', 'admin', 'enfermeiro-chefe')";
			$conn->exec($sql);
		}

		public static function validarLogin($usuario, $senha) {
			$conn = self::getConexao();
			$sql = "SELECT COUNT(1) FROM usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
			$result = $conn->prepare($sql);
			$result->execute();
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				return true;
			}

			return false;
		}

		public static function buscarUsuario($usuario) {
			$conn = self::getConexao();
			$sql = "SELECT * FROM usuario WHERE usuario = '".$usuario."'";
			$result = $conn->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);

			$dadosUsuario = new Usuario();
			$dadosUsuario->setCpf($row["cpf"]);
			$dadosUsuario->setUsuario($row["usuario"]);
			$dadosUsuario->setSenha($row["password"]);
			$dadosUsuario->setCargo($row["cargo"]);

			return $dadosUsuario;
		}

		public function salvarUsuarioMedico($usuario) {
			$conn = self::getConexao();

			$sql = "SELECT COUNT(1) FROM usuario WHERE usuario = '".$usuario->getUsuario()."'";

			$result = $conn->prepare($sql);
			$result->execute();
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				$sql = "UPDATE usuario SET nome = '".$usuario->getNome()."',
					   	cpf = '".$usuario->getCpf()."',
					   	senha = '".$usuario->getSenha()."'
					   		WHERE usuario = '".$usuario->getUsuario()."' 
					   		AND cargo = 'medico'";
				$conn->exec($sql);
			} else {
				$sql = "INSERT INTO usuario (usuario, nome, cpf, senha, cargo) VALUES ('".$usuario->getUsuario()."', '".$usuario->getNome()."', '".$usuario->getCpf()."', '".$usuario->getSenha()."', 'medico')";
				$conn->exec($sql);
			}
		}

		public function listarPacientes() {
			$conn = self::getConexao();

			$result = $conn->query("SELECT * FROM paciente");	

			$pacientes = array();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$paciente = new Paciente();
				$paciente->setCpf($row['cpf']);
				$paciente->setNomeCompleto($row['nome_completo']);
				$paciente->setDataAniversario($row['data_aniversario']);
				$paciente->setTelefone($row['telefone']);
				$paciente->setEmail($row['email']);
				$paciente->setTipoSanguineo($row['tipo_sanguineo']);
				$paciente->setAlergias($row['alergias']);
				$paciente->setPlanoSaude($row['plano_saude']);
				$paciente->setProntuario($row['prontuario']);

				array_push($pacientes, $paciente);
			}

			return $pacientes;
		}

		public function atualizarProntuarioPaciente($cpf, $prontuario) {
			$conn = self::getConexao();

			$sql = "UPDATE paciente SET prontuario = '".$prontuario."' WHERE cpf = '".$cpf."'";

			$conn->exec($sql);
		}

	}
