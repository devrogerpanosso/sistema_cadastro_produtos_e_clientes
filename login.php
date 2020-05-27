<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login | Developer Roger Panosso</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="login img-responsive">
	<article>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 text-center">
						<H1 class="page-header text-center text-capitalize lead" style="font-size:40px; color:#34A96F;">
							<div class="p-4"></div>
							Login
						</H1>
						<?php
							//define sessão de login
							session_start();
							if(isset($_SESSION["login"]) AND !empty($_SESSION["login"])) {
								echo $_SESSION["login"];
								//finaliza sessão
								unset($_SESSION["login"]);
							}
						?>
						<hr class="bg-primary">	
					</div>
				</div>
			</div>
		</header>
		<section>
			<div class="p-1"></div>
			<div class="container">
				<form name="login" method="POST" action="validar_login.php">
					<div class="form-row">
						<div class="col-lg-6 offset-lg-3">
							<div class="form-group">
								<label style="padding-right:5px;" class="text text-warning" for="usuario">
									<img src="imgs/user.png" class="img-responsive img-fluid" title="Usuário">
								</label>
								<input type="text" name="usuario" autofocus class="form-control form-control-lg text-dark border border-info" autocomplete="off" placeholder=" Informe seu Usuário.. " id="usuario" required/>
								<small class="form-text text text-primary" style="font-family:verdana;">Não compartilharemos esta informação.</small>
							</div>
						</div>
						<div class="p-1"></div>
						<div class="col-lg-6 offset-lg-3">
							<div class="form-group">
								<label class="text text-warning" for="senha">
									<img src="imgs/password.png" class="img-responsive img-fluid" for="senha">
								</label>
								<input type="password" name="senha" class="form-control form-control-lg text-dark border border-info" autocomplete="off" placeholder=" Informe sua Senha.. " id="senha" required/>
								<small class="form-text text text-primary" style="font-family:verdana;">Não compartilharemos esta informação.</small>
							</div>
						</div>
						<div class="col-lg-6 offset-lg-3">
							<div class="form-group">
								<button type="submit" class="btn btn-success btn btn-skin btn-hover btn-block btn-lg">Entrar</button>
								<button onclick="window.location.href='cadastrar_usuarios.php'" class="btn btn-warning btn btn-skin btn-hover btn-block btn-lg">Cadastre-se</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</article>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>
</body>
</html>