<?php
	if(isset($_POST['login_btn'])){
		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];
		
		$conn = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');

		$sql = "SELECT COUNT(1) FROM usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
		$result = $conn->prepare($sql);
		$result->execute();
		$count_rows = $result->fetchColumn();

		if($count_rows > 0) {
			echo "<h3>Logado</h3>";
		} else {
			echo "<h3>Não Logado</h3>";
		}
	}

?>