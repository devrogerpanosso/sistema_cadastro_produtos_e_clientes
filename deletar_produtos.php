<?php

		//inicia sessão
		session_start();

		//define classe contendo dado da requisicao
		class Requisicao {
			private $id_produto;

			//define metodo construtor inicializando atributo para
			//ser armazenado como atributo interno do objeto 
			//para ser lido posteriormente
			public function __construct($id_produto) {
				if(is_string($_GET["Id_Produto"]) AND isset($_GET["Id_Produto"]) AND !empty($_GET["Id_Produto"])) {
					//referencia atributo da classe internamente
					$this->id_produto = addslashes(htmlspecialchars(trim($_GET["Id_Produto"]))) ?? "Id do produto não informado";
				}else {
					echo error_get_last();
				}
			}
			//define metodo de retorno de valores dos atributos depois de processado e validado
			//getter
			public function getIdproduto() {
				return $this->id_produto;
			}
		}
		//realiza instancia da classe Requisicao criando objeto referenciando e definindo
		//dados a seu atributo inicializando metodo construtor
		$dados = new Requisicao($_GET["Id_Produto"]);
		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta de exclusão de dados
		$query = "DELETE FROM produtos WHERE id = :id_produto";

		//prepara query para ser executada
		$query = $db->prepare($query);
		$query->bindValue(":id_produto", $dados->getIdproduto());
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}

		//testa se numero de dados inseridos na table produtos é maior que 0 e
		//define sessão de exclusão ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacoesexclusoes"] = "
			<div class='container text-center'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-danger bd-lead fade show' role='alert'>
							<span class='text-danger bd-lead text-center'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Produto Deletado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_produtos.php");
			exit;
		}else {
			echo "<p class='text text-danger text-lowercase'>Não há produtos selecionados para exclusão</p>";
			header("Location:acessar_produtos.php");
			exit;
		}
?>