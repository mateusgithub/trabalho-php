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
		
	}