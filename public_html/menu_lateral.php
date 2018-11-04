<div class="menu-lateral">
	<?php
		include_once 'Usuario.php';
		session_start();

		if(isset($_SESSION['usuario_logado'])) {
			$usuarioLogado = unserialize($_SESSION['usuario_logado']);

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe') {
				echo "<a href='cadastrar_paciente.php' >Cadastrar Paciente</a>";
			}

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe' || $usuarioLogado->getCargo() == 'medico') {
				echo "<a href='listar_pacientes.php' >Listar Pacientes</a>";
			}

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe') {
				echo "<a href='cadastrar_medico.php' >Cadastrar Médico</a>";
			}
		}

		echo "<a href='index.php' >Sair</a>";		
	?>
</div>
