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
	
	$statusCadastroPaciente = "";
	$erroCadastroPaciente = "";
	
	if(isset($_POST['salvar_paciente_btn'])) {
		if(empty($_POST["cpf"])) {
			$erroCadastroPaciente = "Informe um CPF";
		}
		else {
			$paciente = new Paciente();
			
			$cpf = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['cpf']);
			
			$paciente->setCpf($cpf);
			$paciente->setNomeCompleto($_POST["nome_completo"]);
			$paciente->setDataAniversario($_POST["data_aniversario"]);
			$paciente->setTelefone($_POST["telefone"]);
			$paciente->setEmail($_POST["email"]);
			$paciente->setTipoSanguineo($_POST["tipo_sanguineo"]);
			$paciente->setAlergias($_POST["alergias"]);
			$paciente->setPlanoSaude($_POST["plano_saude"]);
			$paciente->setProntuario(htmlspecialchars($_POST["prontuario"]));

			PacienteDAO::salvarPaciente($paciente);

			$statusCadastroPaciente = "Paciente ".$paciente->getCpf()." cadastrado com sucesso";
		}
	}
	
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Cadastrar paciente</title>
	</head>
	<body>	
		<?php
			require 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Cadastrar paciente</h2><hr>
			<form id="formulario_paciente" action="cadastrar_paciente.php" method="POST">
				<?php
					if(!empty($erroCadastroPaciente)) {
						echo "<p class='mensagem-erro'>".$erroCadastroPaciente."</p>";
					}
					if(!empty($statusCadastroPaciente)) {
						echo "<p class='mensagem-sucesso'>".$statusCadastroPaciente."</p>";
					}
				?>

				<p>CPF: <input type="text" name="cpf" id="cpf_field" maxlength="11" required /> </p>
				<script>document.getElementById("cpf_field").focus();</script>
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
	</body>
</html>