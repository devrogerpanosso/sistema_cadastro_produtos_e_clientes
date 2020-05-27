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
		<meta name="viewport" contet="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<title>Acessar Produtos</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="p-3"></div>
						<H1 class="page-header lead text-primary text-center" style="font-size:36px;">
							Produtos Cadastrados
						</H1>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 text-center">
						<div class="p-2"></div>
						<a class="nav-link-item link-striped alert-link badge badge-success" title="Pagina Inicial"
						href="index.php">Página Inicial
						</a>
						<a class="nav-link-item link-striped alert-link badge badge-success m-2" title="Cadastrar Produtos"
						href="cadastrar_produtos.php">Cadastrar Produtos
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
		</header>
		<hr class="bg-success">
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3">
						<form name="ordenacao" method="GET">
							<div class="form-group">
								<label class="text text-warning text-capitalize" style="font-family:verdana;" for="ordenar">Ordenar</label>
								<?php

									//estabelece conexão com MySQL
									require "include/connect_mysql.php";

									//verifica se existe dado vindo da requisicao
									if(isset($_GET["ordenacao"]) AND !empty($_GET["ordenacao"])) {
										$ordenacao = addslashes(htmlspecialchars(trim($_GET["ordenacao"])));
										//define query consulta para seleção de dados de acordo com ordenação 
										$query = "SELECT * FROM produtos ORDER BY {$ordenacao} ASC";
									}else {
										//define query com ordenacao por id 
										$ordenacao = NULL;
										$query = "SELECT * FROM produtos ORDER BY id {$ordenacao} ASC";
									}
								?>
								<select name="ordenacao" class="form-control form-control-lg text-success border border-info" autocomplete="off" id="ordenacao" required onchange="this.form.submit()">
									<option value="id" class="text text-success" <?php echo($ordenacao == "id")?"selected=selected":"";?>>Ordenar por Id</option>
									<option value="produto" class="text text-success" <?php echo($ordenacao == "produto")?"selected=selected":"";?>>Ordenar por Produto</option>
									<option value="marca" class="text text-success" <?php echo($ordenacao == "marca")?"selected=selected":"";?>>Ordenar por Marca</option>
									<option value="preco" class="text text-success" <?php echo($ordenacao == "preco")?"selected=selected":"";?>>Ordenar por Preço</option>
									<option value="quantidade" class="text text-success" <?php echo($ordenacao == "quantidade")?"selected=selected":"";?>>Ordenar por Quantidade</option>
									<option value="data_cadastro" class="text text-success" <?php echo($ordenacao == "data_cadastro")?"selected=selected":"";?>>Ordenar por Data_Cadastro</option>
									<option value="status_produto" class="text text-success" <?php echo($ordenacao == "status_produto")?"selected=selected":"";?>>Ordenar por Status_Produto</option>
									<option value="material" class="text text-success" <?php echo($ordenacao == "material")?"selected=selected":"";?>>Ordenar por Material_Produto</option>
									<option value="descricao" class="text text-success" <?php echo($ordenacao == "descricao")?"selected=selected":"";?>>Ordenar por Descricao</option>
								</select>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="p-1"></div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-6">
							<span class="text text-warning text-capitalize" style="font-family:verdana;">Total de Produtos:</span>
							<?php
								//define query selecionando dados da table de produtos
								$total_produtos = "SELECT produto FROM produtos ORDER BY produto";

								//seleciona query a classe PDO executando-a através do metodo query
								$total_produtos = $db->query($total_produtos);

								//testa se consulta foi realizada no DB
								if(isset($total_produtos) AND $total_produtos == TRUE) {
									//echo "Consulta realizada com suscesso !!";
								}else {
									echo $db->errorInfo();
								}

								//seleciona quantidade de linhas presentes na table e informa quantidade
								//de produtos registrados
								$quantidade = $total_produtos->rowCount();
								if($quantidade > 0) {
									echo "<span class='text-success'>$quantidade</span>";
								}else {
									echo "<span class='text-danger'>0</span>";
								}
							?>
						</div>
					</div>
				</div>
			<div class="p-1"></div>
			<?php
				//define sessão de atualizações e exclusões de dados
				if(isset($_SESSION["atualizacoesexclusoes"]) AND !empty($_SESSION["atualizacoesexclusoes"])) {
					echo $_SESSION["atualizacoesexclusoes"];
					//finaliza sessão
					unset($_SESSION["atualizacoesexclusoes"]);
				}
			?>
			<div class="p-1"></div>
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<caption class="text text-warning text-capitalize" style="font-family:verdana;">List of Products</caption>
						<thead class="thead-light text-center">
							<tr class="tr tr-active">
								<th class="text-center text text-primary text-capitalize" scope="col">#</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Produto</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Marca</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Preço</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Quantidade</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Data_Cadastro</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Status_Produto</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Material_Produto</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Código_Produto</th>
								<th class="text-center text text-primary text-capitalize" scope="col">Descrição</th>
								<th class="text-center text text-primary text-capitalize" scope="col"></th>
								<th class="text-center text text-primary text-capitalize" scope="col"></th>
							</tr>
						</thead>
						<?php
							//seleciona query a classe PDO executando-a através do metodo query
							$query = $db->query($query);

							//testa se há dados na table produtos para exibição de dados 
							//através do metodo da classe PDO rowCount()
							if($query->rowCount() > 0) {
								//exibe dados através da estrutura de repetição foreach que 
								//tera por finalidade exibir os dados vindos da requisicao
								//da query através de array pela funcao fetchAll() que 
								//ira decompor os dados vindos da requisicao da query
								//em forma de array associativo de modo que cada indice
								//associativo do array represente o campo atual da tabela
								//na base de dados com seus respectivos valores
									echo "<tbody>";
									foreach ($query->fetchAll() as $value) {
										echo "<tr class='tr-active'>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['id']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['produto']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['marca']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['preco']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['quantidade']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['data_cadastro']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['status_produto']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['material']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['codigo']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['descricao']}</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>
											<a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalDeUpdateProdutos1".$value['id']."' title='Atualizar Produto' href='atualizar_produtos.php'>
												<img src='imgs/update.png' width='35' class='img-responsive' title='Atualizar Produto'/>
											</a>
										</td>";
										echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>
											<a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalDelete".$value['id']."' title='Deletar Produto' href='deletar_produtos.php'>
												<img src='imgs/delete.png' width='35' class='img-responsive' title='Atualizar Produto'/>
											</a>
										</td>";
										echo "</tr>";
										echo "<div class='modal fade bd-example-modal-xl' id='ModalDeUpdateProdutos1".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='MyModal1".$value['id']."' aria-hidden='true'>
  												 <div class='modal-dialog modal-xl' role='document'>
    												<div class='modal-content'>
      													<div class='modal-header bg-light'>
        													<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id='MyModal1".$value['id']."'>Atualizar Produtos</h5>
        													<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          														<span aria-hidden='true'>&times;</span>
        													</button>
      													</div>
      												<div class='modal-body'>
        												<div class='container'>
        													<form name='atualizar' method='POST' action='atualizar_produtos.php?Id_Produto=".$value['id']."'>
        														<div class='form-row'>
        															<div class='col-lg-6'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='produto'>Produto</label>
        																	<input type='hidden' value='".$value['id']."' readonly='1'/>
																			<input type='text' name='produto' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['produto']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe o nome do produto corretamente.</small>
        																</div>
        															</div>
        															<div class='col-lg-6'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='marca'>Marca</label>
																			<input type='text' name='marca' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['marca']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe a marca do produto corretamente.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='preco'>Preço</label>
																			<input type='text' name='preco' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['preco']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe o Preço do produto corretamente.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='quantidade'>Quantidade</label>
																			<input type='text' name='quantidade' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['quantidade']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe a quantidade do produto corretamente.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='data_cadastro'>Data_Cadastro</label>
																			<input type='text' name='data_cadastro' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['data_cadastro']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe a data de cadastro corretamente do produto.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning' for='status_produto'>Status</label>
																			<input type='text' name='status_produto' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['status_produto']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe o status atual do produto.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='material'>Material</label>
																			<input type='text' name='material' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['material']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe o material corretamente do produto.</small>
        																</div>
        															</div>
        															<div class='col-lg-4'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='codigo'>Código do Produto</label>
																			<input type='number' name='codigo' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['codigo']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe o codigo corretamente do produto.</small>
        																</div>
        															</div>
        															<div class='col-lg-12'>
        																<div class='form-group'>
        																	<label class='text text-warning text-capitalize' style='font-family:verdana;' for='descricao'>Descrição</label>
																			<input type='text' name='descricao' class='form-control form-control-lg text-success border border-info' autocomplete='off' value='".$value['descricao']."'/>
																			<small class='text-dark text-capitalize form-text'>Informe detalhadamente a descrição do produto.</small>
        																</div>
        															</div>
        															<div class='col-lg-12 text-right'>
        																<div class='form-group'>
        																	<button type='submit' class='btn btn-success btn-lg'>Atualizar Produto</button>
        																	<button type='button' class='btn btn-danger btn-lg' data-dismiss='modal'>Fechar</button>
        																</div>
        															</div>
        														</div>
        													</form>
        												</div>
      												</div>
    											</div>
  											</div>
										</div>";
										echo "<div class='modal fade bd-example-modal-lg' id='ModalDelete".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='MyModalExcluir".$value['id']."' aria-hidden='true'>
  												 <div class='modal-dialog modal-lg' role='document'>
    												<div class='modal-content'>
      													<div class='modal-header bg-light'>
        													<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id='MyModalExcluir".$value['id']."'>Deletar Produtos</h5>
        													<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          														<span aria-hidden='true'>&times;</span>
        													</button>
      													</div>
      												<div class='modal-body'>
        												<p class='text text-danger' style='font-family:verdana;'>
        													Tem certeza de que deseja deletar este Produto ?
        												</p>
      												</div>
      												<div class='modal-footer'>
      													<form name='deletar' method='POST' action='deletar_produtos.php?Id_Produto=".$value['id']."'>
      														<button type='submit' class='btn btn-success btn-lg'>Delerar Produto</button>
      														<button type='button' class='btn btn-danger btn-lg' data-dismiss='modal'>Fechar</button>
      													</form>
      												</div>
    											</div>
  											</div>
										</div>";
									}
									echo "</tbody>";
							}else {
								echo "<p class='text text-danger text-center' style='font-family:verdana;'>Não há dados para serem Selecionados !!</p>";
							}
						?>
					</table>
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