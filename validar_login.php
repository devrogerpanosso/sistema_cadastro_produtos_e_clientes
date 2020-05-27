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

		//define query consulta para seleção de dados de acordo com usuario e senha 
		$query = "SELECT * FROM cadastro_usuarios WHERE usuario = :usuario AND senha = :senha";

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
			echo "<font color='red'>" . $db->errorInfo() . "</font>";
		}

		//recebe dados do usuario se a contagem de linhas for maior que 0
		//e define id do usuario na sessão através do metodo fetch()
		if($query->rowCount() > 0) {
			$dados_usuario = $query->fetch();

			//grava id do usuario na sessão de login
			$_SESSION["usuario"] = $dados_usuario["usuario"];

			//redireciona usuario para pagina inicial
			header("Location:index.php");
			exit;
		}else {
			$_SESSION["login"] = "
			<div class='alert alert-danger text-center fade show' role='alert'>
				<span class='text-danger bd-lead text-center'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					Usuário ou Senha Incorretos !!
				</span>
			</div>";
			header("Location:login.php");
			exit;
		}
?>