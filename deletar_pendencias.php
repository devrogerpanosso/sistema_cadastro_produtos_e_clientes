<?php
		//inicia sessão
		session_start();

		//define classe contendo atributo da requisicao
		class Requisicao {
			private string $id_pendencia = "";

			//define metodo de acesso setter para processar e validar
			//atributo, para supostamente gerar requisições externas ao objeto
			public function setIdpendencia(string$id_pendencia) {
				if(is_string($id_pendencia) AND isset($id_pendencia) AND !empty($id_pendencia)) {
					//referencia atributo da classe internamente
					$this->id_pendencia = addslashes(htmlspecialchars(trim(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_SPECIAL_CHARS))));
				}else {
					echo error_get_last();
				}
			}
			//define metodo de retorno de valores de atributos getter
			public function getIdpendencia() {
				return $this->id_pendencia ?? "Id da Pêndencia não informado";
			}
		}
		//Realiza instancia da classe Requisicao criando objeto definindo valores
		//a seus atributos através de requisições externas metodos de acesso setter
		$pendencia = new Requisicao();
		$pendencia->setIdpendencia(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_SPECIAL_CHARS));

		//Exibe estrutura do objeto com seus dados
		echo "<pre>";
		print_r($pendencia);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define consulta query para exclusão de dados
		$query = "DELETE FROM pendencias_produtos WHERE id = :id_pendencia";

		//Prepara query para ser executa no servidor MySQL
		$query = $db->prepare($query);
		$query->bindValue(":id_pendencia", $pendencia->getIdpendencia());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada no DB
		if(isset($query) AND $query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}

		//testa se há dados registrados na table de pendencias de produtos
		//através do metodo de contagem da classe PDO rowCount() sendo maior
		//que 0 define sessão de exclusão de pendencia ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacao_exclusao"] = "
			<div class='container text-center'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-danger fade show' role='alert'>
							<span class='text-center text-danger bd-lead'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Pendencia Excluida com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_pendencias_produtos.php");
			exit;
		}else {
			echo "<p class='text-danger text-center text-capitalize' style='font-family:verdana'>Não há pendencias para seleção !!</p>";
		}

?>