<!-- By Mateus Hikari Tanaka - RA 184082 -->
<?php
	include_once 'Aluno.php';
	session_start();
?>
<!DOCTYPE html >
<html lang="pt">
<head>
	<meta charset="UTF-8" />
	<title>Listar Alunos</title>
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

		.listagem {
			padding: 10px;
			border-style: solid;
			float: left;
		}

		.listagem form {
			width: 100%;
		}

	</style>
</head>
<body>
    <div class="menu-lateral">
      <a href="cadastrar_aluno.php" >Cadastrar Aluno</a>
      <a href="#" class="active">Listar Alunos</a>
    </div>

    <div class="listagem">
		<h1>Listar Alunos</h1>
	    <?php
	    	function cmp($a, $b)
	    	{
	    	    return strcmp($a->getRa(), $b->getRa());
	    	}

	    	$alunos = $_SESSION["alunos"];
			usort($alunos, "cmp");
	    	foreach ($alunos as $aluno) {
	    		echo "<hr>";
				echo "Nome: " . $aluno->getNome() . "<br>";
				echo "RA: " . $aluno->getRa() . "<br>";
				echo "Sexo: " . $aluno->getSexo() . "<br>";
				echo "Idade: " . $aluno->getIdade() . "<br>";
				echo "Endereço: " . $aluno->getEndereco() . "<br>";
				echo "Telefone: " . $aluno->getTelefone() . "<br>";
				echo "E-mail: " . $aluno->getEmail() . "<br>";
				echo "<hr>";
	    	}
			
		?>

		<form action="" method="POST">
			<input type="submit" name="Limpar" value="Limpar"/>
		</form>
	</div>

    <?php
    	if (isset($_POST['Limpar'])) {
			unset($_SESSION['alunos']);
			header("refresh: 0;");
    	}
    ?>  
</body>
</html>
