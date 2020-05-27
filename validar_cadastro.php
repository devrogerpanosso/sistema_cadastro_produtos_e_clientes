<?php
		//inicializa sessão
		session_start();

		class Requisicao {
			private $usuario;
			private $senha;

			//define metodos construtor inicializando dados do objeto
			//processando-os e validando-os
			public function __construct($usuario, $senha) {
				if(is_string($_POST["usuario"]) AND isset($_POST["usuario"]) AND !empty($_POST["usuario"])) {
					//referencia atributo da classe internamente
					$this->usuario = addslashes(htmlspecialchars(trim(ucwords($_POST["usuario"]))));
					//grava em arquivo usuario informado para login
					file_put_contents("users.txt", "Usuário: {$this->usuario}\n", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["senha"]) AND isset($_POST["senha"]) AND !empty($_POST["senha"])) {
					//referencia atributo da classe internamente
					$this->senha = addslashes(htmlspecialchars(trim(md5($_POST["senha"]))));
				}else {
					echo error_get_last();
				}
			}
			//define metodos de retorno de valores dos atributos depois
			//de processados para serem lidos posteriormente getters
			public function getUsuario() {
				return $this->usuario;
			}
			public function getSenha() {
				return $this->senha;
			}
		}
		//realiza instancia da classe Requisicao criando objeto referenciando seus atributos
		//inicializando método construtor 
		$dados = new Requisicao($_POST["usuario"], $_POST["senha"]);
		echo "<pre>";
		var_dump($dados);
		echo "<pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta anexação para inserção de dados
		$query = "INSERT INTO cadastro_usuarios (usuario,senha) VALUES (:usuario, :senha)";

		//prepara query para ser executada
		$query = $db->prepare($query);
		$query->bindValue(":usuario", $dados->getUsuario());
		$query->bindValue(":senha", $dados->getSenha());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "<font color='green'>Consulta realizada com suscesso !!</font>";
		}else {
			echo "<font color='red'>Erro" . $db->errorInfo() . "</font>";
		}

		//testa se numero de dados na table cadastro_usuarios é maior que
		//0 e define sessão de cadastro ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["cadastro"] = "
			<div class='alert alert-success fade show' role='alert'>
				<span class='text-success text-center bd-lead'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Usuário Cadastrado com Suscesso !!
				</span>
			</div>";
			header("Location:cadastrar_usuarios.php");
		}else {
			echo "<div class='container text-center'>
				<div class='row'>
					<div class='col-lg-12'>
						<div class='alert alert-primary' role='alert'>
							<span class='text text-danger' style='font-family:verdana;'>
								Não há usuarios cadastrados !!
							</span>
						</div>
					</div>
				</div>
			</div>";
		}
?>