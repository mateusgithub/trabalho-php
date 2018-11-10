<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
	
	require_once '../model/Usuario.php';
	require_once '../dao/MedicoDAO.php';
	
	$statusCadastroMedico = "";
	$erroCadastroMedico = "";
	if(isset($_POST['salvar_medico_btn'])) {
		if(empty($_POST["usuario"])) {
			$erroCadastroMedico = "Informe um nome de usuário";
		}
		else if(empty($_POST["senha"])) {
			$erroCadastroMedico = "Informe uma senha";
		}
		else {
			$usuario = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['usuario']);
			
			if($usuario == "admin") {
				$erroCadastroMedico = "Nome de usuário inválido";
			}
			else{
				$usuarioMedico = new Usuario();
				
				$usuarioMedico->setCpf($_POST["cpf"]);
				$usuarioMedico->setNome($_POST["nome_completo"]);
				$usuarioMedico->setUsuario($usuario);
				$usuarioMedico->setSenha($_POST["senha"]);

				MedicoDAO::salvarUsuarioMedico($usuarioMedico);

				$statusCadastroMedico = "Médico ".$usuarioMedico->getCpf()." cadastrado com sucesso";
			}
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

				<p>CPF: <input type="text" name="cpf" id="cpf_field" maxlength="11" /> </p>
				<script>document.getElementById("cpf_field").focus();</script>
				<p>Nome: <input type="text" name="nome_completo" /> </p>
				<p>Usuário: <input type="text" name="usuario" required /> </p>
				<p>Senha: <input type="password" name="senha" required /> </p>

				<input type="submit" name="salvar_medico_btn" value="Cadastrar"/>
				<input type="reset" value="Limpar">
			</form>
		</div>
	</body>
</html>