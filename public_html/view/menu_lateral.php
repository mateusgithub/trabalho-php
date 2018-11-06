<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    }
?>
<div class="menu-lateral">
	<?php
		require_once '../model/Usuario.php';

		if(isset($_SESSION['usuario_logado'])) {
			$usuarioLogado = unserialize($_SESSION['usuario_logado']);

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe') {
				echo "<a href='cadastrar_paciente.php' >Cadastrar Paciente</a>";
			}

			if($usuarioLogado->getCargo() == 'medico') {
				echo "<a href='consultar_paciente.php' >Consultar paciente</a>";
			}

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe') {
				echo "<a href='listar_pacientes.php' >Listar Pacientes</a>";
			}

			if($usuarioLogado->getCargo() == 'enfermeiro-chefe') {
				echo "<a href='cadastrar_medico.php' >Cadastrar Médico</a>";
			}
		}

		echo "<a href='../view/index.php' >Sair</a>";		
	?>
</div>
