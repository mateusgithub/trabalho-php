<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../model/Usuario.php';
	if(!isset($_SESSION['usuario_logado'])) {
		header("location:../view/index.php");
	}
	else if(unserialize($_SESSION['usuario_logado'])->getCargo() != 'enfermeiro-chefe') {
		header("location:../view/home.php");
	}
	
	require_once '../model/Paciente.php';
	require_once '../dao/PacienteDAO.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Listar pacientes</title>
	</head>
	<body>	
		<?php
			require 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Listar pacientes</h2><hr>

			<div style="overflow-x: auto; width: 100%; padding: 5px">
				<table id="pacientes">
					<tr>
						<th>CPF</th>
						<th>Nome</th>
						<th>Aniverário</th>
						<th>Telefone</th>
						<th>Email</th>
						<th>Tipo sanguíneo</th>
						<th>Alergias</th>
						<th>Plano de saúde</th>
						<th>Prontuário</th>
					</tr>
					<?php
					$pacientes = PacienteDAO::listarPacientes();

					foreach ($pacientes as $paciente) {
						echo "<tr>";
							echo "<td>".$paciente->getCpf()."</td>";
							echo "<td>".$paciente->getNomeCompleto()."</td>";
							echo "<td>".$paciente->getDataAniversario()."</td>";
							echo "<td>".$paciente->getTelefone()."</td>";
							echo "<td>".$paciente->getEmail()."</td>";
							echo "<td>".$paciente->getTipoSanguineo()."</td>";
							echo "<td>".$paciente->getAlergias()."</td>";
							echo "<td>".$paciente->getPlanoSaude()."</td>";
							echo "<td>".$paciente->getProntuario()."</td>";
						echo "</tr>";
					}
					?>

				</table>
			</div>
		</div>
	</body>
</html>