<?php
	class Usuario {

		private $cpf;
		private $nome;
		private $usuario;
		private $senha;
		private $cargo;

		public function getCpf() {
			return $this->cpf;
		}

		public function setCpf ($cpf) {
		    $this->cpf = $cpf;
		}

		public function getNome() {
			return $this->nome;
		}

		public function setNome ($nome) {
		    $this->nome = $nome;
		}

		public function getUsuario() {
			return $this->usuario;
		}

		public function setUsuario ($usuario) {
		    $this->usuario = $usuario;
		}

		public function getSenha() {
			return $this->senha;
		}

		public function setSenha ($senha) {
		    $this->senha = $senha;
		}

		public function getCargo() {
			return $this->cargo;
		}

		public function setCargo ($cargo) {
		    $this->cargo = $cargo;
		}

	}
?>