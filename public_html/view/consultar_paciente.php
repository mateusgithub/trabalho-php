<?php
	include_once '../dao/Database.php';
	include_once '../model/Paciente.php';
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
			include 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Consultar pacientes</h2><hr>

			<form id="formulario_consulta_paciente" action="" method="GET">
				<p>Informe o CPF: <input type="text" name="cpf" maxlength="11" value="<?php echo $_GET['cpf'];?>"> </p>
				<input type="submit" value="Consultar" />
			</form>

			<br>

			<?php 
				if(isset($_SESSION['status_atualizar_paciente'])) {
					echo "<p class='mensagem-sucesso'>".$_SESSION['status_atualizar_paciente']."</p>";
				}
			?>

			<form id="formulario_editar_paciente" action="" method="POST">
				<?php
					$paciente = Database::consultarPacientePorCpf($_GET['cpf']);
					unset($_SESSION['status_atualizar_paciente']);
				?>
				<p>CPF: <input type="text" maxlength="11" value="<?php echo ($paciente->getCpf() !== null)?$paciente->getCpf():'';?>" disabled /> </p>

				<p>Nome completo: <input type="text" value="<?php echo ($paciente->getNomeCompleto() !== null)?$paciente->getNomeCompleto():'';?>" disabled /> </p>

				<p>Data de aniversário: <input type="text" value="<?php echo ($paciente->getDataAniversario() !== null)?$paciente->getDataAniversario():'';?>" disabled /> </p>

				<p>Telefone: <input type="text" value="<?php echo ($paciente->getTelefone() !== null)?$paciente->getTelefone():'';?>" disabled /> </p>

				<p>E-mail: <input type="text" value="<?php echo ($paciente->getEmail() !== null)?$paciente->getEmail():'';?>" disabled/> </p>

				<p>Tipo sanguíneo: <input type="text" value="<?php echo ($paciente->getTipoSanguineo() !== null)?$paciente->getTipoSanguineo():'';?>" disabled /> </p>

				<p>Alergias: <input type="text" value="<?php echo ($paciente->getAlergias() !== null)?$paciente->getAlergias():'';?>" disabled /> </p>

				<p>Plano de saúde: <input type="text" value="<?php echo ($paciente->getPlanoSaude() !== null)?$paciente->getPlanoSaude():'';?>" disabled /> </p>

				<p>Prontuário: 
					<textarea rows="5" cols="50" name="prontuario" >
						<?php echo ($paciente->getProntuario() !== null)?htmlspecialchars($paciente->getProntuario()):'';?>
					</textarea>
				</p>

				<input type="submit" name="editar_paciente_btn" value="Salvar">
			</form>

			<?php
				if(isset($_POST['editar_paciente_btn'])) {
					Database::atualizarProntuarioPaciente($paciente->getCpf(), htmlspecialchars($_POST['prontuario']));

					$_SESSION['status_atualizar_paciente'] = 'Paciente atualizado com sucesso';

					header("location:consultar_paciente.php?cpf=".$paciente->getCpf());
				}
			?>
		</div>
	</body>
</html>