<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Paciente.php';
	require_once '../dao/PacienteDAO.php';
	require_once '../model/Usuario.php';
	
	if(!isset($_SESSION['usuario_logado']) || (unserialize($_SESSION['usuario_logado'])->getCargo() != 'medico')) {
		echo '<h2>Erro: Usuário não tem permissão para realizar esta operação.</h2>';
		exit();
	}

	$cpf = "";
	
	if(isset($_GET['cpf'])) {
		$cpf = preg_replace("/[^0-9]/", "", $_GET['cpf']);
	}
	
	$paciente = null;
	if(!empty($cpf)) {
		$paciente = PacienteDAO::consultarPacientePorCpf($cpf);
	}
	
	$statusAtualizarPaciente = "";
	
	if(isset($_POST['editar_paciente_btn']) && isset($_POST['prontuario']) && $paciente != null) {
		Database::atualizarProntuarioPaciente($paciente->getCpf(), htmlspecialchars($_POST['prontuario']));

		$statusAtualizarPaciente = 'Paciente atualizado com sucesso';
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Consultar paciente</title>
	</head>
	<body>	
		<?php
			require 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Consultar pacientes</h2><hr>

			<form id="formulario_consulta_paciente" action="" method="GET">
				<p>Informe o CPF: <input type="text" name="cpf" maxlength="11" value="<?php echo $cpf;?>"> </p>
				<input type="submit" value="Consultar" />
			</form>

			<br>

			<?php 
				if(!empty($statusAtualizarPaciente)) {
					echo "<p class='mensagem-sucesso'>".$statusAtualizarPaciente."</p>";
				}
			?>

			<?php
			if($paciente != null) {
			?>
			<form id="formulario_editar_paciente" action="" method="POST">
				<p>CPF: <input type="text" maxlength="11" value="<?php echo $paciente->getCpf();?>" disabled /> </p>

				<p>Nome completo: <input type="text" value="<?php echo $paciente->getNomeCompleto();?>" disabled /> </p>

				<p>Data de aniversário: <input type="text" value="<?php echo $paciente->getDataAniversario();?>" disabled /> </p>

				<p>Telefone: <input type="text" value="<?php echo $paciente->getTelefone();?>" disabled /> </p>

				<p>E-mail: <input type="text" value="<?php echo $paciente->getEmail();?>" disabled/> </p>

				<p>Tipo sanguíneo: <input type="text" value="<?php echo $paciente->getTipoSanguineo();?>" disabled /> </p>

				<p>Alergias: <input type="text" value="<?php echo $paciente->getAlergias();?>" disabled /> </p>

				<p>Plano de saúde: <input type="text" value="<?php echo $paciente->getPlanoSaude();?>" disabled /> </p>

				<p>Prontuário:
					<textarea rows="5" cols="50" name="prontuario" ><?php
						echo htmlspecialchars($paciente->getProntuario());
					?></textarea>
				</p>

				<input type="submit" name="editar_paciente_btn" value="Salvar">
			</form>
			<?php
			}
			?>
		</div>
	</body>
</html>