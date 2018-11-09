<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../dao/Database.php';
	require_once '../model/Paciente.php';
	
	$statusCadastroMedico = "";
	$erroCadastroMedico = "";
	if(isset($_POST['salvar_medico_btn'])) {
		if(empty($_POST["cpf"])) {
			$erroCadastroMedico = "Informe um CPF";
		}
		else {
			$usuarioMedico = new Usuario();
			
			$usuarioMedico->setCpf($_POST["cpf"]);
			$usuarioMedico->setNome($_POST["nome_completo"]);
			$usuarioMedico->setUsuario($_POST["usuario"]);
			$usuarioMedico->setSenha($_POST["senha"]);

			Database::salvarUsuarioMedico($usuarioMedico);

			$statusCadastroMedico = "Médico ".$usuarioMedico->getCpf()." cadastrado com sucesso";
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	 	<title>Trabalho 3 - Cadastrar médico</title>
	</head>
	<body>	
		<?php
			require 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Cadastrar médico</h2><hr>
			<form id="formulario_medico" action="" method="POST">
				<?php
					if(!empty($erroCadastroMedico)) {
						echo "<p class='mensagem-erro'>".$erroCadastroMedico."</p>";
					}
					if(!empty($statusCadastroMedico)) {
						echo "<p class='mensagem-sucesso'>".$statusCadastroMedico."</p>";
					}
				?>

				<p>CPF: <input type="text" name="cpf" maxlength="11" /> </p>
				<p>Nome: <input type="text" name="nome_completo" /> </p>
				<p>Usuário: <input type="text" name="usuario" /> </p>
				<p>Senha: <input type="password" name="senha" /> </p>

				<input type="submit" name="salvar_medico_btn" value="Cadastrar"/>
				<input type="reset" value="Limpar">
			</form>
		</div>
	</body>
</html>