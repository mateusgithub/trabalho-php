<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Paciente.php';
	require_once '../dao/PacienteDAO.php';
	
	$cpf = "";
	
	if(isset($_GET['cpf'])) {
		$cpf = preg_replace("/[^0-9]/", "", $_GET['cpf']);
	}
	
	$paciente = null;
	if(!empty($cpf)) {
		$paciente = PacienteDAO::consultarPacientePorCpf($_GET['cpf']);
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
				if(isset($_SESSION['status_atualizar_paciente'])) {
					echo "<p class='mensagem-sucesso'>".$_SESSION['status_atualizar_paciente']."</p>";
	
					unset($_SESSION['status_atualizar_paciente']);
				}
			?>

			<?php
			if($paciente != null) {
			?>
			<form id="formulario_editar_paciente" action="" method="POST">
				<p>CPF: <input type="text" maxlength="11" value="<?php echo ($paciente !== null)?$paciente->getCpf():'';?>" disabled /> </p>

				<p>Nome completo: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getNomeCompleto():'';?>" disabled /> </p>

				<p>Data de aniversário: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getDataAniversario():'';?>" disabled /> </p>

				<p>Telefone: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getTelefone():'';?>" disabled /> </p>

				<p>E-mail: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getEmail():'';?>" disabled/> </p>

				<p>Tipo sanguíneo: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getTipoSanguineo():'';?>" disabled /> </p>

				<p>Alergias: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getAlergias():'';?>" disabled /> </p>

				<p>Plano de saúde: <input type="text" value="<?php echo ($paciente !== null)?$paciente->getPlanoSaude():'';?>" disabled /> </p>

				<p>Prontuário: 
					<textarea rows="5" cols="50" name="prontuario" ><?php
						echo ($paciente !== null)? htmlspecialchars($paciente->getProntuario()) : '';
					?></textarea>
				</p>

				<input type="submit" name="editar_paciente_btn" value="Salvar">
			</form>
			<?php
			}
			?>
			
			<?php
				if(isset($_POST['editar_paciente_btn']) && $paciente != null) {
					Database::atualizarProntuarioPaciente($paciente->getCpf(), htmlspecialchars($_POST['prontuario']));

					$_SESSION['status_atualizar_paciente'] = 'Paciente atualizado com sucesso';

					header("location:consultar_paciente.php?cpf=".$paciente->getCpf());
				}
			?>
		</div>
	</body>
</html>