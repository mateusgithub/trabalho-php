<?php
	class Paciente {

		private $cpf;
		private $nomeCompleto;
		private $dataAniversario;
		private $telefone;
		private $email;
		private $tipoSanguineo;
		private $planoSaude;
		private $alergias;
		private $pronturario;

		public function getCpf() {
			return $this->cpf;
		}

		public function setCpf ($cpf) {
		    $this->cpf = $cpf;
		}

		public function getNomeCompleto() {
			return $this->nomeCompleto;
		}

		public function setNomeCompleto ($nomeCompleto) {
		    $this->nomeCompleto = $nomeCompleto;
		}

		public function getDataAniversario() {
			return $this->dataAniversario;
		}

		public function setDataAniversario ($dataAniversario) {
		    $this->dataAniversario = $dataAniversario;
		}

		public function getTelefone() {
			return $this->telefone;
		}

		public function setTelefone ($telefone) {
		    $this->telefone = $telefone;
		}

		public function getEmail() {
			return $this->email;
		}

		public function setEmail ($email) {
		    $this->email = $email;
		}

		public function getTipoSanguineo() {
			return $this->tipoSanguineo;
		}

		public function setTipoSanguineo ($tipoSanguineo) {
		    $this->tipoSanguineo = $tipoSanguineo;
		}

		public function getPlanoSaude() {
			return $this->planoSaude;
		}

		public function setPlanoSaude ($planoSaude) {
		    $this->planoSaude = $planoSaude;
		}

		public function getAlergias() {
			return $this->alergias;
		}

		public function setAlergias ($alergias) {
		    $this->alergias = $alergias;
		}

		public function getPronturario() {
			return $this->pronturario;
		}

		public function setProntuario ($pronturario) {
		    $this->pronturario = $pronturario;
		}
	}
?>