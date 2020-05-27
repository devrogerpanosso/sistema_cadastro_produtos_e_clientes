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
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="p-3"></div>
						<H1 class="page-header lead text-primary text-center lead" style="font-size:36px;">
							Pêndencias Cadastradas
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
		</header>
		<hr class="bg-success"/>
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3">
						<form name="ordenacao" method="GET">
							<div class="form-group">
								<label class="form-text text text-warning text-capitalize" style="font-family:verdana;" for="ordenar">Ordenar</label>
								<?php
									//estabelece conexão com MySQL
									require "include/connect_mysql.php";

									//verifica se existe dado vindo da requisicao
									if(isset($_GET["ordenacao"]) AND !empty($_GET["ordenacao"])) {
										$ordenacao = addslashes(htmlspecialchars(trim($_GET["ordenacao"]))) ?? "Não informada";
										//define query consulta select com base em critério de ordenação selecionado
										$query = "SELECT * FROM pendencias_produtos ORDER BY {$ordenacao} ASC";
									}else {
										//caso não seja especificado criterio de ordenacao
										$ordenacao = NULL;
										$query = "SELECT * FROM pendencias_produtos ORDER BY id ASC";
									}
								?>
								<select name="ordenacao" class="form-control form-control-lg border border-info" autocomplete="off" id="ordenacao" onchange="this.form.submit()">
									<option class="text-success" value="id" <?php echo($ordenacao == "id")?"selected=selected":"";?>>Ordenar por Id</option>
									<option class="text-success" value="produto" <?php echo($ordenacao == "produto")?"selected=selected":"";?>>Ordenar ppor Produto</option>
									<option class="text-success" value="marca" <?php echo($ordenacao == "marca")?"selected=selected":"";?>>Ordenar por Marca</option>
									<option class="text-success" value="quantidade_minima" <?php echo($ordenacao == "quantidade_minima")?"selected=selected":"";?>>Ordenar POR Quantidade_Minima</option>
									<option class="text-success" value="codigo" <?php echo($ordenacao == "codigo")?"selected=selected":"";?>>Ordenar por Código</option>
									<option class="text-success" value="data_cadastro" <?php echo($ordenacao == "data_cadastro")?"selected=selected":"";?>>Ordenar por Data_Cadastro</option>
									<option class="text-success" value="descricao" <?php echo($ordenacao == "descricao")?"selected=selected":"";?>>Ordenar por Descricao</option>
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
							<span class='text text-warning text-capitalize' style="font-family:verdana;">
								Total de Produtos Pendentes:
							</span>
							<?php
								//define consulta selecionando produtos pendentes 
								$total_produtos_pendentes = "SELECT produto FROM pendencias_produtos ORDER BY produto";

								//Seleciona query a classe PDO executando a através do metodo query()
								$total_produtos_pendentes = $db->query($total_produtos_pendentes);

								//testa se consulta foi realizada no DB
								if(isset($total_produtos_pendentes) AND $total_produtos_pendentes == TRUE) {
									//echo "Consulta realizada com suscesso !!";
								}else {
									echo $db->errorInfo();
								}

								//testa se quantidade de linhas na table de pendencias de produtos é maior
								//que 0 através do metodo PDO rowCount(), sendo maior que 0 Define quantidade
								//de pendencias selecionadas
								$quantidade = $total_produtos_pendentes->rowCount();
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
				//define sessão de atualizações e exclusões de pendencias
				if(isset($_SESSION["atualizacao_exclusao"]) AND !empty($_SESSION["atualizacao_exclusao"])) {
					echo $_SESSION["atualizacao_exclusao"];
					//finaliza sessão
					unset($_SESSION["atualizacao_exclusao"]);
				}
			?>
			<div class="p-3"></div>
			<div class="container-fluid">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<caption class="text text-warning text-capitalize" style="font-family:verdana;">
							List of Products
						</caption>
						<thead class="bg-light text-capitalize">
							<tr class="active">
								<th class="text-center text-primary" scope="col">#</th>
								<th class="text-center text-primary" scope="col">Produto</th>
								<th class="text-center text-primary" scope="col">Marca</th>
								<th class="text-center text-primary" scope="col">Quantidade_Minima</th>
								<th class="text-center text-primary" scope="col">Código</th>
								<th class="text-center text-primary" scope="col">Data_Cadastro</th>
								<th class="text-center text-primary" scope="col">Descrição</th>
								<th class="text-center text-primary" scope="col"></th>
								<th class="text-center text-primary" scope="col"></th>
							</tr>
						</thead>
						<?php
							//executa query no servidor MySQL
							$query = $db->query($query);

							//testa se consulta foi realizada
							if($query == TRUE) {
								//echo "Consulta realizada com suscesso !!";
							}else {
								echo $db->errorInfo();
							}

							//testa se há dados inseridos e registrados na table pendencias_produtos, 
							//se for maior do que 0 exibe-os
							if($query->rowCount() > 0) {
								//como há dados registrados na table exibe-os através da estrutura de repetição
								//foreach que tera por finalidade decompor os dados vindos da requisicao da query
								//SELECT do DB em forma de array, utilizando o metodo da classe PDO fetchAll(), que ira
								//selecionar todos os dados da requisicao, sendo assim os dados vindos da requisicao "SELECT",
								//Sera retornado em forma de array, de modo que cada indice associativo do array represente o campo atual 
								//da tabela com seus respectivos valores
								echo "<tbody>";
									foreach ($query->fetchAll() as $value) {
										echo "<tr class='active'>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["id"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["produto"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["marca"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["quantidade_minima"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["codigo"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["data_cadastro"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>" . $value["descricao"] . "</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>
												<a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalUpdatePendencia".$value['id']."' title='Atualizar Pendencia' href='atualizar_pendencias.php'>
													<img src='imgs/update.png' width='35' class='img-responsive' title='Atualizar Pêndencia'/>
												</a>
											</td>";
										echo "<td class='text-center text-success p-3' style='font-family:verdana;'>
												<a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalDeletePendencia".$value['id']."' title='Deletar Pendencia' href='deletar_pendencias.php'>
													<img src='imgs/delete.png' width='35' class='img-responsive' title='Deletar Pendencia'/>
												</a>
											</td>";
										echo "</tr>";
										echo "<div class='modal fade bd-example-modal-xl' id='ModalUpdatePendencia".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='UpdatePendencia".$value['id']."' aria-hidden='true'>
  												 <div class='modal-dialog modal-xl'>
    												<div class='modal-content'>
      													<div class='modal-header bg-light'>
        													<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id='UpdatePendencia".$value['id']."'>Atualizar Pêndencia</h5>
        													<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          														<span aria-hidden='true'>&times;</span>
        													</button>
      													</div>
      													<div class='modal-body'>
        													<div class='container'>
        														<form name='update_pendencia' method='POST' action='atualizar_pendencias.php?Id=".$value['id']."'>
        															<div class='form-row'>
        																<div class='col-lg-6'>
        																	<div class='form-group'>
        																		<input type='hidden' name='id_pendencia' value='".$value['id']."'/>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='id_produto'>Produto</label>
																				<input type='text' name='produto' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['produto']."' id='produto'/>
																				<small class='text-dark text-capitalize form-text'>Informe o nome do produto corretamente.</small>
        																	</div>
        																</div>
        																<div class='col-lg-6'>
        																	<div class='form-group'>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='marca'>Marca</label>
																				<input type='text' name='marca' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['marca']."' id='marca'/>
																				<small class='text-dark text-capitalize form-text'>Informe a marca do produto corretamente.</small>
        																	</div>
        																</div>
        																<div class='col-lg-4'>
        																	<div class='form-group'>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='quantidade_minima'>Quantidade Minima</label>
																				<input type='text' name='quantidade_minima' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['quantidade_minima']."' id='quantidade_minima'/>
																				<small class='text-dark text-capitalize form-text'>Informe a quantidade correta do produto.</small>
        																	</div>
        																</div>
        																<div class='col-lg-4'>
        																	<div class='form-group'>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='codigo_produto'>Codigo do Produto</label>
																				<input type='number' name='codigo_produto' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['codigo']."' id='codigo_produto'/>
																				<small class='text-dark text-capitalize form-text'>Informe o código do produto corretamente.</small>
        																	</div>
        																</div>
        																<div class='col-lg-4'>
        																	<div class='form-group'>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='data_cadastro'>Data de Cadastro</label>
																				<input type='text' name='data_cadastro' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['data_cadastro']."' id='data_cadastro'/>
																				<small class='text-dark text-capitalize form-text'>Informe a data de cadastro do produto corretamente.</small>
        																	</div>
        																</div>
        																<div class='col-lg-12'>
        																	<div class='form-group'>
        																		<label class='text text-warning text-capitalize form-label' style='font-family:verdana;' for='descricao'>Descrição</label>
																				<input type='text' name='descricao' class='form-control form-control-lg border border-info text-success' autocomplete='off' value='".$value['descricao']."' id='descricao'/>
																				<small class='text-dark text-capitalize form-text'>Informe detalhadamente a descrição do produto.</small>
        																	</div>
        																</div>
        															</div>
        															<div class='form-row justify-content-right'>
        																<div class='col-lg-12 text-right'>
        																	<div class='form-group'>
        																		<button type='submit' class='btn btn-success btn btn-skin btn-lg'>Atualizar Pendencia</button>
        																		<button type='button' class='btn btn-danger btn btn-skin btn-lg' data-dismiss='modal'>Fechar</button>
        																	</div>
        																</div>
        															</div>
        														</form>
        													</div>
      													</div>
    												</div>
  												</div>
											</div>";
										echo "
											<div class='modal fade bd-example-modal-lg' id='ModalDeletePendencia".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='DeletePendencia".$value['id']."' aria-hidden='true'>
  												<div class='modal-dialog modal-lg' role='document'>
    												<div class='modal-content'>
      													<div class='modal-header bg-light'>
        													<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id='DeletePendencia".$value['id']."'>Deletar Pêndencia</h5>
        													<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          														<span aria-hidden='true'>&times;</span>
        													</button>
      													</div>
      													<div class='modal-body'>
        													<p class='text-danger text-capitalize' style='font-family:verdana;'>
        														Tem certeza de que deseja deletar esta Pendencia ?
        													</p>
      													</div>
      												<div class='modal-footer'>
      													<form name='delete_pendencia' method='POST' action='deletar_pendencias.php?Id=".$value['id']."'>
      														<div class='form-group'>
        														<button type='submit' class='btn btn-success btn btn-skin btn-lg'>Deletar Pendencia</button>
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
								echo "<p class='text-danger lead' style='font-family:verdana;'>Não há dados para seleção !!</p>";
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