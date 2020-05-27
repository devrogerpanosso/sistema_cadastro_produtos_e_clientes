<?php
		//define sessão de usuario
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
		<title>Acessar Produtos Pendentes</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<hgroup>
				<div class="col-lg-12">
					<H1 class="page-header text-center text-primary text-capitalize lead" style="font-size:36px;">
						<div class="p-4"></div>
						Deletar Imagens
					</H1>
				</div>
			</hgroup>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 text-center">
						<div class="p-2"></div>
						<a class="nav-link-item link-striped alert-link badge badge-success" title="Pagina Inicial"
						href="index.php">Página Inicial
						</a>
						<a class="nav-link-item link-striped alert-link badge badge-success m-2" title="Cadastrar Produtos"
						href="pendencias_produtos.php">Cadastrar Pendencias
						</a>
					</div>
					<div class="col-lg-6">
						<div class="p-1"></div>
						<img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
						<span class="text text-success" style="font-family:verdana;"><?php echo $_SESSION["usuario"];?></span>
						<a class="nav-link-item link-striped alert-link m-2" style="text-decoration:none" title="Finalizar Sessão" href="sair.php">
							<img src="imgs/off.png" width="40" class="img-responsive img-fluid" title="Finalizar Sessão"/>
						</a>
						<span class="text text-success" style="font-family:verdana;">Encerrar Sessão</span>
					</div>
				</div>
			</div>
		</div>
		<div class="p-1"></div>
		<?php
			//define sessão de exclusão de images
			if(isset($_SESSION["img_delete"]) AND !empty($_SESSION["img_delete"])) {
				echo $_SESSION["img_delete"];
				//finaliza sessão
				unset($_SESSION["img_delete"]);
			}

			if(isset($_SESSION["img_invalida"]) AND !empty($_SESSION["img_invalida"])) {
				echo $_SESSION["img_invalida"];
				//finaliza sessão
				unset($_SESSION["img_invalida"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="p-2"></div>
			<div class="container">
				<form name="delete_images" method="POST" action="delete_img.php">
					<div class="form-row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text-warning text-capitalize lead" for="deletar">Informe a imagem a ser excluida</label>
								<input type="text" name="imagem" class="form-control form-control-lg border border-info" autocomplete="off" autofocus placeholder=" Informe o nome da Imagem a ser execluida.. " id="imagem" required/>
								<small class="form-text text-capitalize text-info">Atenção a Imagem a ser selecionada irá ser deletada do sistema.</small>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-lg-6">
							<div class="form-group">
								<button type="submit" class="btn btn-skin btn btn-success btn-lg">Deletar Imagem</button>
								<button type="reset" class="btn btn-skin btn btn-danger btn-lg">Resetar Imagem</button>
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