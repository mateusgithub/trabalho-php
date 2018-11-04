<?php
	include_once 'Database.php';
	include_once 'Paciente.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	 	<title>Trabalho 3 - Cadastrar paciente</title>
	</head>
	<body>	
		<?php
			include 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Cadastrar paciente</h2><hr>
			<form id="formulario_paciente" action="" method="POST">
				<?php 
					if(isset($_SESSION['erro_cadastro'])) {
						echo "<p style='color: red;'>".$_SESSION['erro_cadastro']."</p>";
					} else {
						echo "<p style='color: red;'></p>";
					}
				?>

				<p>CPF: <input type="text" name="cpf" maxlength="11" /> </p>
				<p>Nome completo: <input type="text" name="nome_completo" /> </p>
				<p>Data de aniversário: <input type="text" name="data_aniversario" /> </p>
				<p>Telefone: <input type="text" name="telefone" /> </p>
				<p>E-mail: <input type="text" name="email" /> </p>
				<p>Tipo sanguíneo: <input type="text" name="tipo_sanguineo" /> </p>
				<p>Alergias: <input type="text" name="alergias" /> </p>
				<p>Plano de saúde: <input type="text" name="plano_saude" /> </p>
				<p>Prontuário: <textarea rows="5" cols="50" name="prontuario"></textarea> </p>

				<input type="submit" name="salvar_paciente_btn" value="Cadastrar"/>
				<input type="reset" value="Limpar">
			</form>
		</div>

		<?php

			if(isset($_POST['salvar_paciente_btn'])) {
				if(empty($_POST["cpf"])) {
					$_SESSION['erro_cadastro'] = "Informe um CPF";
					header("location:/cadastrar_paciente.php");
				}

				$paciente = new Paciente();
				
				$paciente->setCpf($_POST["cpf"]);
				$paciente->setNomeCompleto($_POST["nome_completo"]);
				$paciente->setDataAniversario($_POST["data_aniversario"]);
				$paciente->setTelefone($_POST["telefone"]);
				$paciente->setEmail($_POST["email"]);
				$paciente->setTipoSanguineo($_POST["tipo_sanguineo"]);
				$paciente->setAlergias($_POST["alergias"]);
				$paciente->setPlanoSaude($_POST["plano_saude"]);
				$paciente->setProntuario(htmlspecialchars($_POST["prontuario"]));

				Database::salvarPaciente($paciente);
			}
		?>
	</body>
</html>