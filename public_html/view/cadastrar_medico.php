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
	 	<title>Trabalho 3 - Cadastrar médico</title>
	</head>
	<body>	
		<?php
			include 'menu_lateral.php';
		?>

		<div id="conteudo_principal">
			<h2>Cadastrar médico</h2><hr>
			<form id="formulario_medico" action="" method="POST">
				<?php 
					if(isset($_SESSION['erro_cadastro_medico'])) {
						echo "<p style='color: red;'>".$_SESSION['erro_cadastro_medico']."</p>";
					} else {
						echo "<p style='color: red;'></p>";
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

		<?php

			if(isset($_POST['salvar_medico_btn'])) {
				unset($_SESSION['erro_cadastro_medico']);

				if(empty($_POST["cpf"])) {
					$_SESSION['erro_cadastro_medico'] = "Informe um usuário";
					header("location:cadastrar_medico.php");
				}

				$usuarioMedico = new Usuario();
				
				$usuarioMedico->setCpf($_POST["cpf"]);
				$usuarioMedico->setNome($_POST["nome_completo"]);
				$usuarioMedico->setUsuario($_POST["usuario"]);
				$usuarioMedico->setSenha($_POST["senha"]);

				Database::salvarUsuarioMedico($usuarioMedico);
			}
		?>
	</body>
</html>