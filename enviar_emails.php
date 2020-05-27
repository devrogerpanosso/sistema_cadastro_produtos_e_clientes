<?php
		//define sessão de login
		session_start();
		if(isset($_SESSION["usuario"]) AND !empty($_SESSION["usuario"])) {
			//echo $_SESSION["usuario"];
		}else {
			header("Location:login.php");
			exit;
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Enviar E-Mails</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head> 
<body class="bg-dark">
	<article>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="p-4"></div>
						<H1 class="page-header text-center text-primary text-capitalize lead" style="font-size:36px;">
							Enviar E-Mails
						</H1>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-6 text-center">
						<div class="p-2"></div>
						<a class="nav-link-item link-striped alert-link badge badge-success" title="Página Inicial" href="index.php">
							Página Inicial
						</a>
					</div>
					<div class="col-lg-6">
						<div class="p-1"></div>
						<img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
						<span class="text text-success m-1" style="font-family:verdana;"><?php echo $_SESSION["usuario"];?></span>
						<a class="nav-link-item link-striped alert-link m-2" style="text-decoration:none" title="Finalizar Sessão" href="sair.php">
							<img src="imgs/off.png" width="40" class="img-responsive img-fluid" title="Finalizar Sessão"/>
						</a>
						<span class="text text-success" style="font-family:verdana;">Encerrar Sessão</span>
					</div>
				</div>
			</div>
		</header>
		<div class="p-1"></div>
		<?php
			//define sessão de envio de email
			if(isset($_SESSION["envio_email"]) AND !empty($_SESSION["envio_email"])) {
				echo $_SESSION["envio_email"];
				//finaliza sessão
				unset($_SESSION["envio_email"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="container">
				<form name="email" method="POST" action="receber_email.php">
					<div class="form-row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="email_remetente">E-Mail Remetente</label>
								<input type="email" name="email_remetente" class="form-control form-control-lg border border-info text text-success" autocomplete="off" placeholder=" E-Mail do Remetente.. " id="email_remetente" required/>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="email_destinatario">E-Mail Destinatario</label>
								<input type="email" name="email_destinatario" class="form-control form-control-lg border border-info text text-success" autocomplete="off" placeholder=" E-Mail do Detinatário.. " id="email_destinatario" required/>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="assunto_email">Assunto do E-Mail</label>
								<select name="assunto_email" class="form-control form-control-lg border border-info text text-success" autocomplete="off" id="mensagem" required>
									<option class="text text-success" value="desenvolvimentoweb">Desenvolvimento Web</option>
									<option class="text text-success" value="Linguagem php">Linguagem PHP</option>
									<option class="text text-success" value="orientacaoobjetos">Orientação a Objetos</option>
									<option class="text text-success" value="websites">Web sites</option>
									<option class="text text-success" value="websistemas">Web Sistemas</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="mensagem">Mensagem</label>
								<textarea name="mensagem" word="wrap" rows="6" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Escreva sua Mensagem.. " id="mensagem" required></textarea>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-6 text-center">
								<div class="form-group">
									<button type="submit" class="btn btn-skin btn btn-success btn-lg m-1">Enviar E-Mail</button>
									<button type="reset" class="btn btn-skin btn btn-danger btn-lg m-1" data-toggle="modal" data-target="#ModalApagarForm">Resetar Dados</button>
								</div>
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

	<div class='modal fade bd-example-modal-lg' id="ModalApagarForm" tabindex='-1' role='dialog' aria-labelledby="ResetarDadosForm" aria-hidden='true'><div class='modal-dialog modal-lg' role='document'>
    	<div class='modal-content'>
      		<div class='modal-header bg-light'>
        		<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id="ResetarDadosForm">Resetar Dados</h5>
        		<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          			<span aria-hidden='true'>&times;</span>
        		</button>
      		</div>
      		<div class='modal-body'>
        		<p class='text text-danger' style='font-family:verdana;'>
        			Tem certeza de que deseja Resetar os Dados ?
				</p>
      		</div>
      		<div class='modal-footer'>
				<button type="reset" onclick="window.location.href='enviar_emails.php'" class="btn btn-skin btn btn-danger btn-lg">Resetar Dados</button>
				<button type="button" class="btn btn-skin btn btn-secondary btn-lg" data-dismiss="modal">Fechar</button>
      		</div>
    	</div>
  	</div>
</body>
</html>