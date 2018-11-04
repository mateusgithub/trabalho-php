<!-- By Mateus Hikari Tanaka - RA 184082 -->
<?php
include_once 'Aluno.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="UTF-8" />
	<title>Cadastrar Aluno</title>
	<style>
		.menu-lateral {
		    width: 20%;
			float: left;
			margin-right: 10px;
		}

		.menu-lateral a {
		    display: block;
		    color: black;
		    background-color: #d5e6ff;
		    padding: 15px;
		}

		.menu-lateral a:hover {
		    background-color: #eff5ff;
		}

		.menu-lateral a.active {
		    background-color: #93beff;
		    color: white;
		}

		.formulario {
			padding: 10px;
			border-style: solid;
			float: left;
			
		}

		.formulario form {
			width: 100%;
		}

	</style>
</head>
<body>

	<div class="menu-lateral">
	  <a href="#" class="active">Cadastrar Aluno</a>
	  <a href="listar_alunos.php">Listar Alunos</a>
	</div>
      
    <div class="formulario">
    	<h1>Cadastrar Aluno</h1>

		<form action="" method="POST">
			<p>Nome: <input type="text" name="nome" /> </p>
			<p>RA: <input type="text" name="ra" /> </p>
			<p>Sexo:</p>
				<p><input type="radio" name="sexo" value="Masculino" /> Masculino </p>
				<p><input type="radio" name="sexo" value="Feminino" /> Feminino </p>
			<p>Idade: <input type="text" name="idade" /> </p>
			<p>Endereço: <input type="text" name="endereco" /> </p>
			<p>Telefone: <input type="text" name="telefone" /> </p>
			<p>E-mail: <input type="text" name="email" /> </p>

			<input type="submit" name="Cadastrar" value="Cadastrar"/>
		</form>
	</div>

	<?php
		if (isset($_POST['Cadastrar'])) {

			$aluno = new Aluno();
			$aluno->nome = $_POST['nome'];
			$aluno->ra = $_POST['ra'];
			$aluno->sexo = $_POST['sexo'];
			$aluno->idade = $_POST['idade'];
			$aluno->endereco = $_POST['endereco'];
			$aluno->telefone = $_POST['telefone'];
			$aluno->email = $_POST['email'];

			if (!isset($_SESSION['alunos'])) {
				$_SESSION['alunos'] = array();
			}

			array_push($_SESSION['alunos'], $aluno);
		}

	?>
</body>
</html>
