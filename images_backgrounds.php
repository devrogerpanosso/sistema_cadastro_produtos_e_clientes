<?php
		//define sessão de usuario
		session_start();
		if(isset($_SESSION["usuario"]) AND !empty($_SESSION["usuario"])) {
			//echo $_SESSION["usuario"];
		}else {
			//redireciona para pagina de login
			header("Location:login.php");
			exit;
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Images Backgrounds</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<hgroup>
							<div class="p-3"></div>
							<H1 class="page-header text-center text-primary text-capitalize lead" style="font-size:36px;">
								Visualizar Backgrounds
							</H1>
						</hgroup>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="p-2"></div>
						<a class="nav-link-item link-striped alert-link badge badge-success" title="Página Inicial" href="index.php">
							Página Inicial
						</a>
					</div>
					<div class="col-lg-6 text-right">
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
		</header>
		<div class="p-1"></div>
		<?php
			//define sessão de exclusão de background
			if(isset($_SESSION["background_delete"]) AND !empty($_SESSION["background_delete"])) {
				echo $_SESSION["background_delete"];
				//finaliza sessão
				unset($_SESSION["background_delete"]);
			}
		?>
		<hr class="bg-success">
		<section>
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-striped table-hover table-condensed">
								<caption class="text-warning" style="font-family:verdana;">List of Backgrounds</caption>
								<thead class="thead-light text-center text-capitalize">
									<tr>
										<th class="text-center text-primary" scope="col">#</th>
										<th class="text-center text-primary" scope="col">Image_Background</th>
										<th class="text-center text-primary" scope="col"></th>
									</tr>	
								</thead>
								<?php
									//estabelece conexão com MySQL
									require "include/connect_mysql_db_imgs.php";

									//define consulta query para seleção de dados registrados
									$query = "SELECT * FROM enderecos_images ORDER BY id ASC";

									//Seleciona query a classe PDO executando-a através do metodo query no servidor MySQL
									$query = $connect->query($query);

									//testa se consulta foi realizada
									if(isset($query) AND $query == TRUE) {
										//echo "Consulta realizada com Suscesso !!";
									}else {
										echo $connect->errorInfo();
									}

									//testa se quantidade de dados registrados na table enderecos_images é maior que
									//o através do metodo PDO rowCount() para seleção de dados
									if($query->rowCount() > 0) {
										/*
											Exibe dados da table através da estrutura de repetição foreach()
											que tera por finalidade decompor os dados vindos da requisicao
											da query SELECT em forma de array através do método PDO fetchAll(),
											que ira selecionar todos os dados vindos da requisicao em forma de array
											de modo que cada indice associativo do array da requisicao vindo da consulta
											represente o nome da coluna da table com seus respectivos valores cadastrados
										*/
											echo "<tbody>";
											foreach ($query->fetchAll() as $value) {
												echo "<tr class='active'>";
												echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["id"] . "</td>";
												echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . "<a class='nav-link-item link-striped' title='Image Background' href=".$value["endereco_url"].">Visualizar Bckground</a></td>'";
												echo "<td class='text-center text-success p-3' style='font-family:verdana;'>
														<a class='nav-link-item link-striped' data-toggle='modal' data-target='#ModalDeleteBackground".$value['id']."' title='Deletar Background' href='deletar_backgrounds.php'>
															<img src='imgs/delete.png' width='35' class='img-responsive' title='Deletar Background'/>
														</a>
													</td>";
												echo "</tr>";
												echo "<div class='modal fade bd-example-modal-lg' id='ModalDeleteBackground".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='DeletarBackground".$value['id']."' aria-hidden='true'>
  														  <div class='modal-dialog modal-lg' role='document'>
   	 														  <div class='modal-content'>
      															  <div class='modal-header bg-light'>
        														  <h5 class='modal-title text-capitalize text-primary lead' style='font-size:36px;' id='DeletarBackground".$value['id']."'>Deletar Backgrounds</h5>
        														  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          															  <span aria-hidden='true'>&times;</span>
        														  </button>
      															</div>
      															<div class='modal-body'>
        															<p class='text-capitalize text-danger' style='font-family:verdana;'>
        																Tem Certeza de que deseja deletar Este Background ?
        															</p>
      															</div>
      															<div class='modal-footer'>
      															<form name='delete' method='POST' action='deletar_backgrounds.php?Id=".$value['id']."'>
      																<div class='form-group'>
        																<button type='submit' class='btn btn-success btn btn-skin btn-lg'>Deletar Background</button>
        																<button type='button' class='btn btn-danger btn btn-skin btn-lg' data-dismiss='modal'>Fechar</button>
        															</div>
        														</form>
      															</div>
   															</div>
  														</div>
													</div>";
											}
											echo "</tbody>";
									}else {
										echo "<p class='text-center text-danger text-capitalize lead'>Não há dados para serem selecionados !!</p>";
									}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</article>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>
</body>
</html>