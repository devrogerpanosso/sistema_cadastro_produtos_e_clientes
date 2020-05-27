<?php
		//define classe contendo atributos da requisicao
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

			//define método construtor inicializando dados do objeto
			//para serem retornados posteriormente e realizada validações
			//para serem armazenados como atributos internos do objeto
			public function __construct($id_produto, $produto, $marca, $preco, $quantidade, $data_cadastro, $status_produto, $material, $codigo, $descricao) {
				if(is_numeric($_POST["id_produto"]) AND isset($_POST["id_produto"]) AND !empty($_POST["id_produto"])) {
					//referencia atributo da classe internamente
					$this->id_produto = addslashes(htmlspecialchars(trim(intval($_POST["id_produto"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["produto"]) AND isset($_POST["produto"]) AND !empty($_POST["produto"])) {
					//referencia atributo da classe internamente
					$this->produto = addslashes(htmlspecialchars(trim(ucwords($_POST["produto"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["marca"]) AND isset($_POST["marca"]) AND !empty($_POST["marca"])) {
					//referencia atributo da classe internamente
					$this->marca = addslashes(htmlspecialchars(trim(ucwords($_POST["marca"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["preco"]) AND isset($_POST["preco"]) AND !empty($_POST["preco"])) {
					//referencia atributo da classe internamente
					$this->preco = addslashes(htmlspecialchars(trim($_POST["preco"])));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["quantidade"]) AND isset($_POST["quantidade"]) AND !empty($_POST["quantidade"])) {
					//referencia atributo da classe internamente
					$this->quantidade = addslashes(htmlspecialchars(trim(ucwords($_POST["quantidade"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["data_cadastro"]) AND isset($_POST["data_cadastro"]) AND !empty($_POST["data_cadastro"])) {
					//referencia atributo da classe internamente
					$this->data_cadastro = addslashes(htmlspecialchars(trim(ucwords($_POST["data_cadastro"]))));
					$this->data_cadastro = addslashes(htmlspecialchars(trim(date("d/m/Y H:i", strtotime($_POST["data_cadastro"])))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["status_produto"]) AND isset($_POST["status_produto"]) AND !empty($_POST["status_produto"])) {
					//referencia atributo da classe internamente
					$this->status_produto = addslashes(htmlspecialchars(trim(ucwords($_POST["status_produto"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["material_produto"]) AND isset($_POST["material_produto"]) AND !empty($_POST["material_produto"])) {
					//referencia atributo da classe internamente
					$this->material = addslashes(htmlspecialchars(trim(ucwords($_POST["material_produto"]))));
				}else {
					echo error_get_last();
				}

				if(is_numeric($_POST["codigo"]) AND isset($_POST["codigo"]) AND !empty($_POST["codigo"])) {
					//referencia atributo da classe internamente
					$this->codigo = addslashes(htmlspecialchars(trim($_POST["codigo"])));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["descricao"]) AND isset($_POST["descricao"]) AND !empty($_POST["descricao"])) {
					//referencia atributo da classe internamente
					$this->descricao = addslashes(htmlspecialchars(trim(ucfirst($_POST["descricao"]))));
				}else {
					echo error_get_last();
				}
			}
			//define metodos de retorno de valores dos atributos para serem lidos
			//posteriormente depois de validados getters
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
		//realiza isntancia da classe Requisicao inicializando método construtor
		$dados = new Requisicao($_POST["id_produto"], $_POST["produto"], $_POST["marca"], $_POST["marca"],
		$_POST["preco"], $_POST["quantidade"], $_POST["data_cadastro"], $_POST["status_produto"],
		$_POST["codigo"], $_POST["material_produto"], $_POST["descricao"]);

		//exibe estrutura do objeto com seus dados inicializados
		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta anexação para inserção de dados
		$query = "INSERT INTO produtos (id,produto,marca,preco,quantidade,data_cadastro,status_produto,material,codigo,descricao) 
		VALUES (:id_produto, :produto, :marca, :preco, :quantidade, :data_cadastro, :status_produto, :material, :codigo, :descricao)";

		//prepara query para ser executa no servidor MySQL
		$query = $db->prepare($query);
		$query->bindValue(":id_produto", $dados->getIdproduto());
		$query->bindValue("produto", $dados->getProduto());
		$query->bindValue(":marca", $dados->getMarca());
		$query->bindValue(":preco", $dados->getPreco());
		$query->bindValue(":quantidade", $dados->getQuantidade());
		$query->bindValue(":data_cadastro", $dados->getDatacadastro());
		$query->bindValue(":status_produto", $dados->getStatusproduto());
		$query->bindValue(":material", $dados->getMaterialproduto());
		$query->bindValue(":codigo", $dados->getCodigo());
		$query->bindValue(":descricao", $dados->getDescricao());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}

		//testa se numero de dados na table é maior que 0 e define sessão
		//de cadastro ao usuario
		$result = $query->rowCount() > 0;

		if($result) {
			session_start();
			$_SESSION["cadastro"] = "
			<div class='container text-center'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-success fade show' role='alert'>
							<span class='text-success bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Produto Cadastrado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:cadastrar_produtos.php");
			exit;
		}else {
			echo "<p class='text text-danger'>Não há dados de Produtos cadastrados !!</span>";
		}
?>