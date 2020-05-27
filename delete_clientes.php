<?php
		//inicia sessão
		session_start();

		//define classe com atributos da requisicao
		class Requisicao {
			private int $id_cliente = 0;

			//define metodo construtor inicializando atributos do objeto
			//para serem executados externamente no momento de sua criação
			public function __construct(int $id_cliente = 0) {
				if(is_numeric($id_cliente) AND isset($id_cliente) AND !empty($id_cliente)) {
					//referencia atributo da classe internamente
					$this->id_cliente = addslashes(trim(floatval(filter_input(INPUT_GET, "Id_Cliente", FILTER_SANITIZE_NUMBER_INT))));
				}else {
					echo error_get_last();
				}
			}
			//Define metodo de retorno de valores de atributo getter
			public function getIdcliente() {
				return $this->id_cliente ?? "Id do Cliente não solicitado !!";
			}
		}
		//Realiza instancia da classe Requisicao criando objeto referenciando seus atributos
		//e gerando requisicoes externas, inicializando metodo construtor
		$dados = new Requisicao(filter_input(INPUT_GET, "Id_Cliente", FILTER_SANITIZE_NUMBER_INT));
		echo "<pre>";
		print_r($dados);
		echo "</pre>";

		//Estabelece conexão com MySQL
		require_once "include/connect_mysql.php";

		//define query consulta para exclusão de dados
		$query = "DELETE FROM clientes WHERE id = :id_cliente";

		//prepara query para ser executada no MySQL
		$query = $db->prepare($query);
		$query->bindValue(":id_cliente", $dados->getIdcliente());
		$query->execute(); //excuta consulta no servidor MySQL

		//Testa se consulta foi realizada no DB
		if(isset($query) AND $query == TRUE) {
			echo "Consulta realizada com Suscesso !!";
		}else {
			echo "Erro => " . $db->errorInfo();
		}

		//testa se quantidade de linhas na table de clientes é maior que 0
		//através do metodo de contagem rowCount() da classe PDO e define sessão
		//de exclusão ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacoes_exclusoes"] = "
			<div class='container'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-primary text-center lead' role='alert'>
							<span class='text-center text-danger lead'>
								Cliente Deletado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_clientes.php");
			exit;
		}else {
			echo "<span class='text-danger text-capitalize lead'>Não há Clientes cadastrados !!</span>";
			header("Location:acessar_clientes.php");
			exit;
		}
?>