<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Paciente.php';

	class PacienteDAO {
	
		public function consultarPacientePorCpf($cpf) {
			$conn = Database::getConexao();

			$result = $conn->prepare("SELECT * FROM paciente WHERE cpf = :cpf");
			$result->execute(array(
				':cpf' => $cpf
			));

			$rows = $result->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($rows) == 0) {
				return null;
			}
			
			$row = $rows[0];
			
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

			return $paciente;
		}
		
		public static function salvarPaciente($usuario) {
			$conn = Database::getConexao();

			$sql = "SELECT COUNT(1) FROM paciente WHERE cpf = :cpf";

			$result = $conn->prepare($sql);
			$result->execute(array(
				':cpf' => $usuario->getCpf()
			));
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				$sql = "UPDATE paciente SET nome_completo = :nome_completo,
					   	data_aniversario = :data_aniversario,
					   	telefone = :telefone,
					   	email = :email,
					   	tipo_sanguineo = :tipo_sanguineo,
					   	alergias = :alergias,
					   	plano_saude = :plano_saude,
					   	prontuario = :prontuario
					   		WHERE cpf = :cpf";
				$result = $conn->prepare($sql);
				$result->execute(array(
					':nome_completo' => $usuario->getNomeCompleto(),
					':data_aniversario' => $usuario->getDataAniversario(),
					':telefone' => $usuario->getTelefone(),
					':email' => $usuario->getEmail(),
					':tipo_sanguineo' => $usuario->getTipoSanguineo(),
					':alergias' => $usuario->getAlergias(),
					':plano_saude' => $usuario->getPlanoSaude(),
					':prontuario' => $usuario->getProntuario(),
					':cpf' => $usuario->getCpf()
				));
			} else {
				$sql = "INSERT INTO paciente (cpf,nome_completo,data_aniversario,telefone,email,tipo_sanguineo,alergias,plano_saude,prontuario)VALUES(:cpf, :nome_completo, :data_aniversario, :telefone, :email, :tipo_sanguineo, :alergias, :plano_saude, :prontuario)";
				$result = $conn->prepare($sql);
				$result->execute(array(
					':nome_completo' => $usuario->getNomeCompleto(),
					':data_aniversario' => $usuario->getDataAniversario(),
					':telefone' => $usuario->getTelefone(),
					':email' => $usuario->getEmail(),
					':tipo_sanguineo' => $usuario->getTipoSanguineo(),
					':alergias' => $usuario->getAlergias(),
					':plano_saude' => $usuario->getPlanoSaude(),
					':prontuario' => $usuario->getProntuario(),
					':cpf' => $usuario->getCpf()
				));
			}
		}
		
		public function atualizarProntuarioPaciente($cpf, $prontuario) {
			$conn = Database::getConexao();

			$sql = "UPDATE paciente SET prontuario = :prontuario WHERE cpf = :cpf";

			$result = $conn->prepare($sql);
			$result->execute(array(
				':cpf' => $cpf,
				':prontuario' => $prontuario
			));
		}
		
		public function listarPacientes() {
			$conn = Database::getConexao();

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
		
	}