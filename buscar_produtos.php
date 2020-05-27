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
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Developer Roger Panosso</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body class="bg-dark">
	<article>
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="p-3"></div>
						<H1 class="page-header text-center text-primary lead" style="font-size:36px;">
							Busca por Produtos
						</H1>
					</div>
				</div>
			</div>
			<div class="p-1"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="p-1"></div>
						<a class="nav-link-item link-striped alert-link badge badge-success" title="Página Incial" href="index.php">
							Página Incial
						</a>
						<a class="nav-link-item link-striped alert-link badge badge-success m-2" title="Acessar Produtos" href="acessar_produtos.php">
							Obter Acesso a Produtos
						</a>
					</div>
					<div class="col-lg-6">
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
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<caption class="text text-primary">Search of Products</caption>
						<thead class="text-center thead-light">
							<tr class="tr-active">
								<th class="text-center text-primary" scope="col">#</th>
								<th class="text-center text-primary" scope="col">Produto</th>
								<th class="text-center text-primary" scope="col">Marca</th>
								<th class="text-center text-primary" scope="col">Preço</th>
								<th class="text-center text-primary" scope="col">Quantidade</th>
								<th class="text-center text-primary" scope="col">Data_Cadastro</th>
								<th class="text-center text-primary" scope="col">Status_Produto</th>
								<th class="text-center text-primary" scope="col">Material_Produto</th>
								<th class="text-center text-primary" scope="col">Descrição</th>
							</tr>
						</thead>
						<?php
							//recebe dados da requisicao "form"
							if(isset($_POST["search"]) AND !empty($_POST["search"])) {
								$search = addslashes(htmlspecialchars(trim($_POST["search"]))) ?? "Busca não informada";
							}else {
								echo "<p class='text text-danger text-lowercase'>Busca não informada !!</p>";
							}

							//estabelece conexão com MySQL
							require "include/connect_mysql.php";

							//define query consulta para seleção de dados de acordo com Busca
							$query = "SELECT * FROM produtos WHERE produto LIKE '%$search%'";

							//seleciona consulta na classe PDO executando no MySQL através de seu metodo query
							$query = $db->query($query);

							//Testa se há dados na table produtos para exibição de acordo co busca
							if($query->rowCount() > 0) {
								//exibe dados referentes a busca através da estrutura de repetição foreach
								//que ira decompor todos os dados vindos da requisicao da query select
								//através de seu metodo fetchAll(), que tera por finalidade trazer de sua
								//requisicao um array com todos os dados nescessarios para exibições dos dados
								//referentes a table produtos. De modo que cada indice associativo do array represente
								//o campo atual da tabela e seus repectivos valores referentes
								echo "<tbody>";
								foreach ($query->fetchAll() as $value) {
									echo "<tr class='tr-active'>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['id']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['produto']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['marca']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['preco']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['quantidade']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['data_cadastro']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['status_produto']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['material']}</td>";
									echo "<td class='text-center text-success p-3' style='font-family:verdana;'>{$value['descricao']}</td>";
								}
								echo "</tbody>";
							}else {
								echo "<p class='text-center text-danger'>Não há dados referentes há Busca !!</p>";
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