<?php

		//Inicia sessão
		session_start();

		//Define classe contendo dados da requisicao
		class Requisicao {
			private $id_produto;
			private $produto;
			private $marca;
			private $preco;
			private $quantidade;
			private $data_cadastro;
			private $status_produto;
			private $material;
			private $codigo;
			private $descricao;

			//define metodo construtor inicializando dados do objeto para
			//em seguida serem processados e validados
			public function __construct($id_produto, $produto, $marca, $preco, $quantidade, $data_cadastro, $status_produto, $material, $codigo, $descricao) {
				if(is_numeric($_GET["Id_Produto"]) AND isset($_GET["Id_Produto"]) AND !empty($_GET["Id_Produto"])) {
					//referencia atributo da classe internamente
					$this->id_produto = addslashes(htmlspecialchars(trim($_GET["Id_Produto"]))) ?? "Id do produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["produto"]) AND isset($_POST["produto"]) AND !empty($_POST["produto"])) {
					//referencia atributo da classe internamente
					$this->produto = addslashes(htmlspecialchars(trim(ucwords($_POST["produto"])))) ?? "Produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["marca"]) AND isset($_POST["marca"]) AND !empty($_POST["marca"])) {
					//referencia atributo da classe internamente
					$this->marca = addslashes(htmlspecialchars(trim(ucwords($_POST["marca"])))) ?? "Marca não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["preco"]) AND isset($_POST["preco"]) AND !empty($_POST["preco"])) {
					//referencia atributo da classe internamente
					$this->preco = addslashes(htmlspecialchars(trim($_POST["preco"]))) ?? "Preço não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["quantidade"]) AND isset($_POST["quantidade"]) AND !empty($_POST["quantidade"])) {
					//referencia atributo da classe internamente
					$this->quantidade = addslashes(htmlspecialchars(trim($_POST["quantidade"]))) ?? "Quantidade não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["data_cadastro"]) AND isset($_POST["data_cadastro"]) AND !empty($_POST["data_cadastro"])) {
					//referencia atributo da classe internamente
					$this->data_cadastro = addslashes(htmlspecialchars(trim($_POST["data_cadastro"]))) ?? "Data de Cadastro não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["status_produto"]) AND isset($_POST["status_produto"]) AND !empty($_POST["status_produto"])) {
					//referencia atributo da classe internamente
					$this->status_produto = addslashes(htmlspecialchars(trim(ucwords($_POST["status_produto"])))) ?? "Status do Produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["material"]) AND isset($_POST["material"]) AND !empty($_POST["material"])) {
					//referencia atributo da classe internamnete
					$this->material = addslashes(htmlspecialchars(trim(ucwords($_POST["material"])))) ?? "Material do produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_numeric($_POST["codigo"]) AND isset($_POST["codigo"]) AND !empty($_POST["codigo"])) {
					//referencia atributo da classe internamnete
					$this->codigo = addslashes(htmlspecialchars(trim($_POST["codigo"]))) ?? "Código do produto não informado";
				}else {
					echo error_get_last();
				}


				if(is_string($_POST["descricao"]) AND isset($_POST["descricao"]) AND !empty($_POST["descricao"])) {
					//referencia atributo da classe internamente
					$this->descricao = addslashes(htmlspecialchars(trim(ucfirst($_POST["descricao"])))) ?? "Descrição do Produto não informada";
				}else {
					echo error_get_last();
				}
			}
			//Define metodos de retorno de valores dos atributos depois de processados Getters
			//para serem lidos posteriormente
			public function getIdproduto() {
				return $this->id_produto;
			}
			public function getProduto() {
				return $this->produto;
			}
			public function getMarca() {
				return $this->marca;
			}
			public function getPreco() {
				return $this->preco;
			}
			public function getQuantidade() {
				return $this->quantidade;
			}
			public function getDatacadastro() {
				return $this->data_cadastro;
			}
			public function getStatusproduto() {
				return $this->status_produto;
			}
			public function getMaterialproduto() {
				return $this->material;
			}
			public function getCodigo() {
				return $this->codigo;
			}
			public function getDescricao() {
				return $this->descricao;
			}
		}
		//Realiza instancia da classe requisicao criando objeto referenciando
		//e definindo valores a seus atributos inicializando o metodo construtor
		$dados = new Requisicao($_GET["Id_Produto"], $_POST["produto"], $_POST["marca"], $_POST["preco"],
		$_POST["quantidade"], $_POST["data_cadastro"], $_POST["status_produto"], $_POST["material"],
		$_POST["codigo"], $_POST["descricao"]);

		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define consulta query de atualização de dados
		$query = "UPDATE produtos SET produto = :produto, marca = :marca, preco = :preco, quantidade = :quantidade, 
		data_cadastro = :data_cadastro, status_produto = :status_produto, material = :material, codigo = :codigo, descricao = :descricao WHERE id = :id_produto";

		//prepara query para ser executada
		$query = $db->prepare($query);
		$query->bindValue(":produto", $dados->getProduto());
		$query->bindValue(":marca", $dados->getMarca());
		$query->bindValue(":preco", $dados->getPreco());
		$query->bindValue(":quantidade", $dados->getQuantidade());
		$query->bindValue(":data_cadastro", $dados->getDatacadastro());
		$query->bindValue(":status_produto", $dados->getStatusproduto());
		$query->bindValue(":material", $dados->getMaterialproduto());
		$query->bindValue(":codigo", $dados->getCodigo());
		$query->bindValue(":descricao", $dados->getDescricao());
		$query->bindValue(":id_produto", $dados->getIdproduto());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "Consulta realizada com suscesso";
		}else {
			echo $db->errorInfo();
		}

		//testa se quantidade de dados inseridos na table produtos é maior que 0
		//e define sessão de atualização ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacoesexclusoes"] = "
			<div class='container text-center'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-success fade show' role='alert'>
							<span class='text-success bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Produto Atualizado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_produtos.php");
			exit;
		}else {
			echo "<p class='text text-danger text-lowercase' style='font-family:verdana;'>Não há dados para serem Atualizados !!</p>";
			header("Location:acessar_produtos.php");
		}
?>