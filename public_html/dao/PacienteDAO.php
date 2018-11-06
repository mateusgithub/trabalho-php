<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Usuario.php';

	class PacienteDAO {
	
		public function consultarPacientePorCpf($cpf) {
			$conn = Database::getConexao();

			$result = $conn->query("SELECT * FROM paciente WHERE cpf = '".$cpf."'");

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

			$sql = "SELECT COUNT(1) FROM paciente WHERE cpf = '".$usuario->getCpf()."'";

			$result = $conn->prepare($sql);
			$result->execute();
			$count_rows = $result->fetchColumn();

			if ($count_rows > 0) {
				$sql = "UPDATE paciente SET nome_completo = '".$usuario->getNomeCompleto()."',
					   	data_aniversario = '".$usuario->getDataAniversario()."',
					   	telefone = '".$usuario->getTelefone()."',
					   	email = '".$usuario->getEmail()."',
					   	tipo_sanguineo = '".$usuario->getTipoSanguineo()."',
					   	alergias = '".$usuario->getAlergias()."',
					   	plano_saude = '".$usuario->getPlanoSaude()."',
					   	prontuario = '".$usuario->getProntuario()."'
					   		WHERE cpf = '".$usuario->getCpf()."'";
				$conn->exec($sql);
			} else {
				$sql = "INSERT INTO paciente (cpf,nome_completo,data_aniversario,telefone,email,tipo_sanguineo,alergias,plano_saude,prontuario)VALUES('".$usuario->getCpf()."', '".$usuario->getNomeCompleto()."', '".$usuario->getDataAniversario()."', '".$usuario->getTelefone()."', '".$usuario->getEmail()."', '".$usuario->getTipoSanguineo()."', '".$usuario->getAlergias()."','".$usuario->getPlanoSaude()."', '".$usuario->getProntuario()."')";
				$conn->exec($sql);
			}
		}
		
	}