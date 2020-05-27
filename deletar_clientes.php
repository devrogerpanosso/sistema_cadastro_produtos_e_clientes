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
					$this->id_cliente = addslashes(trim(floatval(filter_input(INPUT_GET, "Id_Cliente", "FILTER_SANITIZE_NUMBER_INT"))));
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
?>