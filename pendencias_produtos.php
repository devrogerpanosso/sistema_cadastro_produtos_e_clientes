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
		<title>Pendencias de Produtos</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="p-4"></div>
						<H1 class="page-header lead text-center text-primary" style="font-size:36px;">
							Cadastrar Pêndencias
						</H1>
					</div>
				</div>
			</div>
			<div class="p-1"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 text-center">
						<div class="p-1"></div>
						<a class="nav-link-item link-striped alert-link text-center badge badge-success" title="Pagina Incial" href="index.php">Página Incial</a>
						<a class="nav-link-item link-striped alert-link text-center m-2  badge badge-success" title="Acessar Produtos" href="acessar_pendencias_produtos.php">Obter Acesso a Produtos Pendentes</a>
					</div>
					<div class="col-lg-6">
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
		<div class="p-2"></div>
		<?php
			//define sessão de cadastro
			if(isset($_SESSION["cadastro_pendencia"]) AND !empty($_SESSION["cadastro_pendencia"])) {
				echo $_SESSION["cadastro_pendencia"];
				//finaliza sessão
				unset($_SESSION["cadastro_pendencia"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="container">
				<form name="pendencias" method="POST" action="cadastro_pendencias.php">
					<div class="form-row">
						<div class="col-lg-2">
							<div class="form-row">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="id_produto">Id</label>
								<input type="number" name="id_produto" class="form-control form-control-lg text-success border border-info" autocomplete="off" placeholder=" Id.. " id="id_produto" required/>
								<small class='text-info text-capitalize form-text'>Informe o Id da pendencia.</small>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="produto">Produto</label>
								<input type="text" name="produto" class="form-control form-control-lg text-success border border-info" autocomplete="off" placeholder=" Informe o Produto.. " id="produto" required/>
								<small class='text-info text-capitalize form-text'>Informe o nome do produto corretamente.</small>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group"> 
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="marca">Marca</label>
								<input type="text" name="marca" class="form-control form-control-lg text-success border border-info" autocomplete="off" placeholder=" Informe a Marca.. " id="marca" required/>
								<small class='text-info text-capitalize form-text'>Informe a marca do produto corretamente.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="quantidade_minima">Quantidade Minima</label>
								<input type="text" name="quantidade_minima" class="form-control form-control-lg text-success border border-info" autocomplete="off" placeholder=" Informe a Quantidade.. " id="quantidade_minima" required/>
								<small class='text-info text-capitalize form-text'>Informe a quantidade correta do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="codigo_produto">Código do Produto</label>
								<input type="number" name="codigo_produto" class="form-control form-control-lg text-success border border-info" autocomplete="off" placeholder=" Informe o Código.. " id="codigo_produto" required/>
								<small class='text-info text-capitalize form-text'>Informe o codigo do produto corretamente.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="data_cadastro">Data de Cadastro</label>
								<input type="datetime-local" name="data_cadastro" class="form-control form-control-lg text-success border border-info" autocomplete="off" id="data" required/>
								<small class='text-info text-capitalize form-text'>Informe a data de cadastro do produto corretamente.</small>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize form-label" style="font-family:verdana;" for="descricao_produto">Descrição</label>
								<textarea name="descricao" rows="5" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Descreva as Caracteristicas do Produto.. " id="descricao" required></textarea>
								<small class='text-info text-capitalize form-text'>Informe detalhadamente a descrição do produto.</small>
							</div>
						</div>
					</div>
					<div class="form-row justify-content-center">
						<div class="col-lg-6 text-center">
							<div class="form-group">
								<button type="submit" class="btn btn-skin btn btn-success btn-lg m-1">Cadastrar Pêndencia</button>
								<button type="button" class=" btn btn-skin btn btn-danger btn-lg m-1" data-toggle="modal" data-target="#ModalApagarForm">Resetar Dados</button>
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
				<button type="reset" onclick="window.location.href='pendencias_produtos.php'" class="btn btn-skin btn btn-danger btn-lg">Resetar Dados</button>
				<button type="button" class="btn btn-skin btn btn-secondary btn-lg" data-dismiss="modal">Fechar</button>
      		</div>
    	</div>
  	</div>
</body>
</html>