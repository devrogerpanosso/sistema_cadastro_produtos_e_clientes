<?php
	//inicia sessão
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
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Cadastrar Produtos</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="p-4"></div>
						<H1 class="page-header lead text-center text-primary" style="font-size:36px;">Cadastrar Produtos</H1>
					</div>
				</div>
			</div>
			<div class="p-1"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 text-center">
						<div class="p-1"></div>
						<a class="nav-link-item link-striped alert-link text-center badge badge-success" title="Pagina Incial" href="index.php">Página Incial</a>
						<a class="nav-link-item link-striped alert-link text-center m-2  badge badge-success" title="Acessar Produtos" href="acessar_produtos.php">Obter acesso a produtos</a>
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
			if(isset($_SESSION["cadastro"]) AND !empty($_SESSION["cadastro"])) {
				echo $_SESSION["cadastro"];
				//finaliza sessão
				unset($_SESSION["cadastro"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="container">
				<form name="cadastro_produtos" method="POST" action="cadastro.php">
					<div class="form-row">
						<div class="col-lg-2">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="id_produto">Id</label>
								<input type="number" name="id_produto" class="form-control form-control-lg text text-success border border-info" autocomplete="ff" placeholder=" Id.. " id="id" required/>
								<small class="text-info text-capitalize form-text">Informe o Id do Produto.</small>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="produto">Produto</label>
								<input type="text" name="produto" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Produto.. " id="produto" required/>
								<small class="text-info text-capitalize form-text">Informe o nome Completo do produto.</small>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="marca">Marca</label>
								<input type="text" name="marca" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Marca.. " id="marca" required/>
								<small class="text-info text-capitalize form-text">Informe a marca correta do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="preco">Preço</label>
								<input type="text" name="preco" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Preço.. " id="preco" required/>
								<small class="text-info text-capitalize form-text">Informe o preço correto do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="quantidade">Quantidade</label>
								<input type="text" name="quantidade" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Quantidade.. " id="quantidade" required/>
								<small class="text-info text-capitalize form-text">Informe a quantidade correta do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="data_cadastro">Data de Cadastro</label>
								<input type="datetime-local" name="data_cadastro" class="form-control form-control-lg text text-success border border-info" autocomplete="off" id="data" required/>
								<small class="text-info text-capitalize form-text">Informe a data de cadastro correta do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="staus">Status</label>
								<select name="status_produto" class="form-control form-control-lg border border-info" autocomplete="off">
									<option value="disponivel" class="text text-success">Disponivel</option>
									<option value="indisponivel" class="text text-success">Indisponivel</option>
									<option value="ausente" class="text text-success">Ausente</option>
								</select>
								<small class="text-info text-capitalize form-text">Informe o status atual do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="material">Material</label>
								<select name="material_produto" class="form-control form-control-lg border border-info" autocomplete="off">
									<option value="eletricidade" class="text text-success">Eletricidade</option>
									<option value="tecnologia" class="text text-success">Tecnologia</option>
									<option value="acrilico" class="text text-success">Acrilico</option>
									<option value="madeirado" class="text text-success">Madeirado</option>
									<option value="couro" class="text text-success">Couro</option>
									<option value="enborrachado" class="text text-success">Enborrachado</option>
									<option value="franelado" class="text text-success">Franelado</option>
									<option value="cobre" class="text text-success">Cobre</option>
									<option value="ferragem" class="text text-success">Ferragem</option>
								</select>
								<small class="text-info text-capitalize form-text">Informe o material correto do produto.</small>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="codigo">Código do Produto</label>
								<input type="number" name="codigo" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Informe o Código.. " id="codigo" required/>
								<small class="text-info text-capitalize form-text">Informe o codigo correto do produto.</small>
							</div> 
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="descricao">Descrição</label>
								<textarea name="descricao" rows="5" class="form-control form-control-lg text text-success border border-info" autocomplete="off" placeholder=" Descreva as Caracteristicas do Produto.. " id="descricao" required></textarea>
								<small class="text-info text-capitalize form-text">Informe detalhadamente a descrição do produto.</small>
							</div>
						</div>
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-6 text-center">
									<button type="submit" onclick="validar_codigo_produto()" class="btn btn-success btn-lg m-1" title="Cadastrar Produto">Cadastrar Produto</button>
									<button type="button" class="btn btn-danger btn-lg m-1" title="Resetar Dados" data-toggle="modal" data-target="#ModalApagarForm">Resetar Dados</button>
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

	<div class='modal fade bd-example-modal-xl' id="ModalApagarForm" tabindex='-1' role='dialog' aria-labelledby="ResetarDadosForm" aria-hidden='true'><div class='modal-dialog modal-lg' role='document'>
    	<div class='modal-content modal-xl'>
      		<div class='modal-header'>
        		<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id="ResetarDadosForm">Resetar Dados</h5>
        		<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          			<span aria-hidden='true'>&times;</span>
        		</button>
      		</div>
      		<div class='modal-body bg-light'>
        		<p class='text text-danger' style='font-family:verdana;'>
        			Tem certeza de que deseja Resetar os Dados ?
				</p>
      		</div>
      		<div class='modal-footer'>
				<button type="reset" onclick="window.location.href='cadastrar_produtos.php'" class="btn btn-skin btn btn-danger btn-lg">Resetar Dados</button>
				<button type="button" class="btn btn-skin btn btn-secondary btn-lg" data-dismiss="modal">Fechar</button>
      		</div>
    	</div>
  	</div>
</div>
</body>
</html>