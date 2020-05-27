<?php
		//inicia sessão
		session_start();

		//define classe contendo atributo da requisicao
		class Requisicao {
			private string $id_background = "";

			//define metodo de acesso setter processando e validando
			//atributos para serem executados externanmente gerando requisicoes
			//externas
			public function setIdbackground(string$id_background) {
				if(is_numeric($id_background) AND isset($id_background) AND !empty($id_background)) {
					//referencia atributo da classe internamente
					$this->id_background = addslashes(htmlspecialchars(trim(floatval(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_NUMBER_INT)))));
				}else {
					echo error_get_last();
				}
			}
			//define metodo de retorno de valores do atributo getter
			public function getIdbackground() {
				return $this->id_background ?? "Id não informado";
			}
		}
		//Realiza instancia da classe criando objeto referenciando e definindo
		//valor a seu atributo através de requisções externas metodos setter
		$dados = new Requisicao();
		$dados->setIdbackground(filter_input(INPUT_GET, "Id", FILTER_SANITIZE_NUMBER_INT));

		print_r($dados);

		//estabelece conexão com MySQL
		require "include/connect_mysql_db_imgs.php";

		//define query consulta de exclusão de dados
		$query = "DELETE FROM enderecos_images WHERE id = :id";
		$query = $connect->prepare($query);
		$query->bindValue(":id", $dados->getIdbackground());
		//executa query consulta no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada no db
		if(isset($query) AND $query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $connect->errorInfo();
		}

		//testa se numero de dados registrados na table é maior que
		//0 e define sessão de exclusão de background ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["background_delete"] = "
			<div class='container'>
				<div class='row'>
					<div class='col-lg-12'>
						<div class='alert alert-primary text-center' role='alert'>
							<span class='text-center text-danger text-capitalize lead'>
								Background Deletado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:images_backgrounds.php");
			exit;
		}else {
			echo "<p class='text-center text-danger text-capitalize lead'>Não há dados referentes a backgrounds</p>";
		}
?>