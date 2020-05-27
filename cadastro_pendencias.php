<?php
		//inicia sessão
		session_start();

		//define classe contendo dados da requisicao "form"
		class Pendencia {
			private $id_produto;
			private $produto;
			private $marca;
			private $quantidade_minima;
			private $codigo_produto;
			private $data_cadastro;
			private $descricao;

			//define metodo construtor inicializando dados
			//do objeto processando-os e definindo validações
			//para serem lidos posteriormente
			public function __construct($id_produto, $produto, $marca, $quantidade_minima, $codigo_produto, $data_cadastro, $descricao) {
				if(is_string($_POST["id_produto"]) AND isset($_POST["id_produto"]) AND !empty($_POST["id_produto"])) {
					//referencia atributo da classe internamente
					$this->id_produto = addslashes(htmlspecialchars(trim($_POST["id_produto"]))) ?? "Id do produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["produto"]) AND isset($_POST["produto"]) AND !empty($_POST["produto"])) {
					//referencia atributo da classe internamente
					$this->produto = addslashes(htmlspecialchars(ucwords($_POST["produto"]))) ?? "Produto não informado";
					file_put_contents("produtos_pendentes/pendencias_produtos.txt", "Produto: {$this->produto}\n", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["marca"]) AND isset($_POST["marca"]) AND !empty($_POST["marca"])) {
					//referencia atributo da classe internamente
					$this->marca = addslashes(htmlspecialchars(trim(ucwords($_POST["marca"])))) ?? "Marca não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["quantidade_minima"]) AND isset($_POST["quantidade_minima"]) AND !empty($_POST["quantidade_minima"])) {
					//referencia atributo da classe internamente
					$this->quantidade_minima = addslashes(htmlspecialchars(trim($_POST["quantidade_minima"]))) ?? "Quantidade minima não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["codigo_produto"]) AND isset($_POST["codigo_produto"]) AND !empty($_POST["codigo_produto"])) {
					//referencia atributo da classe internamente
					$this->codigo_produto = addslashes(htmlspecialchars(trim($_POST["codigo_produto"]))) ?? "Código do produto não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["data_cadastro"]) AND isset($_POST["data_cadastro"]) AND !empty($_POST["data_cadastro"])) {
					//referencia atributo da classe internamente
					$this->data_cadastro = addslashes(htmlspecialchars(trim($_POST["data_cadastro"]))) ?? "Data de Cadastro não informada";
					$this->data_cadastro = addslashes(htmlspecialchars(trim(date("d/m/Y H:i", strtotime($_POST["data_cadastro"]))))) ?? "Data de Cadastro não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["descricao"]) AND isset($_POST["descricao"]) AND !empty($_POST["descricao"])) {
					//referencia atributo da classe internamente
					$this->descricao = addslashes(htmlspecialchars(trim(ucfirst($_POST["descricao"])))) ?? "Descricao do produto não informada";
					file_put_contents("produtos_pendentes/pendencia_data.txt", "data: {$this->data_cadastro}\n", FILE_APPEND);
				}else {
					echo error_get_last();
				}
			}
			//define metodos de retorno de valores de atributos 
			//depois de validados e processados getter
			public function getIdproduto() {
				return $this->id_produto;
			}
			public function getProduto() {
				return $this->produto;
			}
			public function getMarca() {
				return $this->marca;
			}
			public function getQuantidademinima() {
				return $this->quantidade_minima;
			}
			public function getCodigoproduto() {
				return $this->codigo_produto;
			}
			public function getDatacadastro() {
				return $this->data_cadastro;
			}
			public function getDescricao() {
				return $this->descricao;
			}
		}
		//realiza instancia da classe Pendencia criando objeto referenciando
		//e definindo valores a seus atributos, e inicializando método construtor
		//retornando o proprio objeto instanciado
		$dados = new Pendencia($_POST["id_produto"], $_POST["produto"], $_POST["marca"], 
		$_POST["quantidade_minima"], $_POST["codigo_produto"], $_POST["data_cadastro"], 
		$_POST["descricao"]);

		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define consulta query anexação para inserção de dados
		$query = "INSERT INTO pendencias_produtos (id,produto,marca,quantidade_minima,codigo,data_cadastro,descricao) 
		VALUES (:id_produto, :produto, :marca, :quantidade_minima, :codigo, :data_cadastro, :descricao)";

		//prepara query para ser executada no servidor MySQL
		$query = $db->prepare($query);
		$query->bindValue(":id_produto", $dados->getIdproduto());
		$query->bindValue(":produto", $dados->getProduto());
		$query->bindValue(":marca", $dados->getMarca());
		$query->bindValue(":quantidade_minima", $dados->getQuantidademinima());
		$query->bindValue(":codigo", $dados->getCodigoproduto());
		$query->bindValue(":data_cadastro", $dados->getDatacadastro());
		$query->bindValue(":descricao", $dados->getDescricao());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "<font color='green'>Consulta realizada com Suscesso !!</font>";
		}else {
			echo $db->errorInfo();
		}

		//testa se quantidade de dados inseridos na table pendencias_produtos
		//é maior que 0 e se possuir registro define sessão de cadastro ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["cadastro_pendencia"] = "
			<div class='container'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-success fade show' role='alert'>
							<span class='text-center text-success bd-lead'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Pêndencia Cadastrada com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:pendencias_produtos.php");
			exit;
		}else {
			echo "<p class='text text-danger text-center text-lowercase'>Não há dados de Pêndencias Cadastrados !!</p>";
		}
?>