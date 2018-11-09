<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }

	class Database {

		private static $host = "localhost";
		private static $user = "root";
		private static $password = "root";
		private static $database = "banco_trabalho_php_si401";

		private static function conectar() {
			return new PDO("mysql:host=".self::$host.";dbname=".self::$database, self::$user, self::$password);
		}
		
		private static function criarBanco() {
			$connection = new PDO("mysql:host=".self::$host, self::$user, self::$password);

			$connection->exec("CREATE DATABASE `".self::$database."` CHARACTER SET utf8 COLLATE utf8_general_ci;;
					CREATE USER '".self::$user."'@'".self::$host."' IDENTIFIED BY '".self::$password."';
					GRANT ALL ON `".self::$database."`.* TO '".self::$user."'@'".self::$host."';
					FLUSH PRIVILEGES;");
			
			self::criarTabelas();
		}

		private static function criarTabelas() {
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
					tipo_sanguineo varchar(30) NULL,
					alergias varchar(255) NULL,
					plano_saude varchar(50) NULL,
					prontuario varchar(255) NULL);";
			$conn->exec($sql);

			$sql = "INSERT INTO usuario (usuario, nome, cpf, senha, cargo) VALUES ('admin', 'admin', '11111111111', 'admin', 'enfermeiro-chefe')";
			$conn->exec($sql);
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


	}
