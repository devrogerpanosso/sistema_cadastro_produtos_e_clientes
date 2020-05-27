<?php
		//inicia sessão
		session_start();

		//define classe contendo atributos da requisicao "form"
		class Requisicao {
			private string $id_pendencia = "";
			private string $produto = "";
			private string $marca = "";
			private string $quantidade_minima = "";
			private string $codigo_produto = "";
			private string $data_cadastro = "";
			private string $descricao = "";

			//define metodo construtor inicializando atributos do objeto 
			//processando-os e definindo validações para serem executados
			//posteriormente no momento de sua criação ou seja sua instanciação
			public function __construct(string$id_pendencia, string$produto, string$marca, string$quantidade_minima, string$codigo_produto, string$data_cadastro, string$descricao) {
				if(is_string($id_pendencia) AND isset($id_pendencia) AND !empty($id_pendencia)) {
					//referencia atributo da classe internamente
					$this->id_pendencia = addslashes(htmlspecialchars(trim(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_SPECIAL_CHARS))));
				}else {
					echo error_get_last();
				}

				if(is_string($produto) AND isset($produto) AND !empty($produto)) {
					//referencia atributo da classe internamente
					$this->produto = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "produto", FILTER_SANITIZE_SPECIAL_CHARS)))));
				}else {
					echo error_get_last();
				}

				if(is_string($marca) AND isset($marca) AND !empty($marca)) {
					//referencia atributo da classe itnernamente
					$this->marca = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "marca", FILTER_SANITIZE_SPECIAL_CHARS)))));
				}else {
					echo error_get_last();
				}

				if(is_string($quantidade_minima) AND isset($quantidade_minima) AND !empty($quantidade_minima)) {
					//referencia atributo da classe internamente
					$this->quantidade_minima = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "quantidade_minima", FILTER_SANITIZE_SPECIAL_CHARS))));
				}else {
					echo error_get_last();
				}

				if(is_numeric($codigo_produto) AND isset($codigo_produto) AND !empty($codigo_produto)) {
					//referencia atributo da classe internamente
					$this->codigo_produto = addslashes(trim(floatval(filter_input(INPUT_POST, "codigo_produto", FILTER_SANITIZE_NUMBER_INT))));
				}else {
					echo error_get_last();
				}

				if(is_string($data_cadastro) AND isset($data_cadastro) AND !empty($data_cadastro)) {
					//referencia atributo da classe internamente
					$this->data_cadastro = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "data_cadastro", FILTER_SANITIZE_STRING))));
					$this->data_cadastro = addslashes(htmlspecialchars(trim(date("d/m/Y H:i", strtotime(filter_input(INPUT_POST, "data_cadastro"))))));
				}else {
					echo error_get_last();
				}

				if(is_string($descricao) AND isset($descricao) AND !empty($descricao)) {
					//referencia atributo da classe internamente
					$this->descricao = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS)))));
				}else {
					echo error_get_last();
				}
			} 
			//define metodos de retorno de valores de atributos para serem lidos posteriormente
			//depois de processados e validados getters
			public function getIdpendencia() {
				return $this->id_pendencia ?? "Id de Pendencia não informado";
			}
			public function getProduto() {
				return $this->produto ?? "Pendencia de produto não informada";
			}
			public function getMarca() {
				return $this->marca ?? "Pendencia de Marca não informada";
			}
			public function getQuantidademinima() {
				return $this->quantidade_minima ?? "Pendencia de Quantidade Minima não informada";
			}
			public function getCodigoproduto() {
				return $this->codigo_produto ?? "Pendencia de Codigo do produto não informado";
			}
			public function getDatacadastro() {
				return $this->data_cadastro ?? "Pendencia de Data de cadastro não informada";
			}
			public function getDescricao() {
				return $this->descricao ?? "Pendencia de descricao não informada";
			}
		}
		//Realiza instancia da classe Requisicao criando objeto definindo valores a seus atributos
		//inicializando metodo construtor 
		$dados = new Requisicao(filter_input(INPUT_GET, "Id"), filter_input(INPUT_POST, "produto"),
		filter_input(INPUT_POST, "marca"), filter_input(INPUT_POST, "quantidade_minima"),
		filter_input(INPUT_POST, "codigo_produto"), filter_input(INPUT_POST, "data_cadastro"),
		filter_input(INPUT_POST, "descricao"));

		//exibe estrutura do objeto com seus atributos
		echo "<pre>";
		print_r($dados);
		echo "</pre>";

		//Estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define consulta query de atualização de dados
		$query = "UPDATE pendencias_produtos SET produto = :produto, marca = :marca, marca = :marca,
		quantidade_minima = :quantidade_minima, codigo = :codigo_produto, data_cadastro = :data_cadastro,
		descricao = :descricao WHERE id = :id_pendencia";

		//prepara query para ser executada no servidor MySQL
		$query = $db->prepare($query);
		$query->bindValue(":produto", $dados->getProduto());
		$query->bindValue(":marca", $dados->getMarca());
		$query->bindValue(":quantidade_minima", $dados->getQuantidademinima());
		$query->bindValue(":codigo_produto", $dados->getCodigoproduto());
		$query->bindValue(":data_cadastro", $dados->getDatacadastro());
		$query->bindValue(":descricao", $dados->getDescricao());
		$query->bindValue(":id_pendencia", $dados->getIdpendencia());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada no DB
		if(isset($query) AND $query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}

		//testa se quantidade de linhas na table é maior que 0 através de metodo
		//da classe PDO rowCount(), sendo maior que 0 define sessão de atualização ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacao_exclusao"] = "
			<div class='container text-center'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-success fade show' role='alert'>
							<span class='text-success text-center bd-lead'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Pendencia de Produto Atualizada com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_pendencias_produtos.php");
			exit;
		}else {
			echo "<p class='text text-danger text-lowercase' style='font-family:verdana;'>Não há dados para serem Atualizados !!</p>";
			header("Location:acessar_produtos.php");
			exit;
		}
?>