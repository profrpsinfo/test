<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
		<title>Resultado LOGIN</title>
    </head>
    
    <?php
		// Inicializar SESSION para utilizar nesta PAGINA
		session_start();

        // Variáveis recebem dados do POST (criptografados - ninguém vê)
        $u = $_POST["usuario"];
        $s = $_POST["senha"];

        $erro = "Nada";
        $link = "#";
        $botao = "Botao";

        // Conectar o BD
        $conexao = new mysqli("localhost","root","","banco");

        // Verifica se está conectado
        if($conexao->error)
            die("Erro: " . $conexao->error);
        
        // Verifica LOGIN
        if(($u=="")||($s=="")){
            $erro = "Você deixou Campo(s) Vazio(s)!!!";
            $link = "login.html";
            $botao = "Login";
        }else{
            $sql = "SELECT * FROM usuarios;";
            $resultado = $conexao->query($sql);
            while($campo = $resultado->fetch_assoc()){
                if(($u==$campo["usuario"])&&($s==$campo["senha"])){
                    $erro = "{$u}, você está logado!!!";
                    $link = "inicio.php";
                    $botao = "Home";
					$_SESSION["usuario"] = $campo["nome"];
                    break;
                }else{
                    $erro = "Os Dados informados são Inválidos!!!";
                    $link = "login.html";
                    $botao = "Login";
                    //$erro += ", Erro: " . $sql . "<br>" . $conexao->error;
                }
            }
        }
        $conexao->close();
    ?>

	<body>
		<div class="jumbotron container-fluid text-center">
			<h1>Formulário de Login</h1>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-3">&nbsp;</div>
				<div class="col-md-6" style="background: #ddd">
					<form action="<?php echo $link;?>">
						<div class="row form">
							<div class="form-group col-md-6">
								<label>&nbsp;</label>
							</div>
							<div class="form-group col-md-6">
								<label>&nbsp;</label>
							</div>
						</div>
						<div class="form">
							<div class="form-group text-center">
								<h4><b><i><?php echo $erro; ?></i></b></h4>
							</div>
							<div class="form-group">
								<label>&nbsp;</label>
							</div>
							<div class="form-group col-md-12 text-center">
								<button type="submit" class="btn btn-primary" style="width: 150px">Ir para <?php echo $botao;?></button>
							</div>
						</div>
						<div class="row form">
							<div class="form-group">
								<label>&nbsp;</label>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-3">&nbsp;</div>
			</div>
		</div>
	</body>
</html>