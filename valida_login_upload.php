<?php
		//Define sessão
		session_start();

		//define classe contendo dados da requisicao
		class Requisicao {
			private string $usuario;
			private string $senha;

			//define metodo construtor inicializando dados(atributos) do objeto
			//para serem retornados posteriormente
			public function __construct($usuario, $senha) {
				if(is_string($usuario) AND isset($usuario) AND !empty($usuario)) {
					//referencia atributo da classe internamente
					$this->usuario = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS)))) ?? "Usuario não informado";
					file_put_contents("usuario_login_upload.txt", "Usuario: {$this->usuario}\n", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($senha) AND isset($senha) AND !empty($senha)) {
					//referencia atributo da classe internamente
					$this->senha = addslashes(htmlspecialchars(trim(md5((filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS)))))) ?? "Senha não informada";
				}else {
					echo error_get_last();
				}
			}
			//define metodos de retorno de valores dos atributos getters
			public function getUsuario() {
				return $this->usuario;
			}
			public function getSenha() {
				return $this->senha;
			}
		}
		//realiza instancia da classe Requisica criando objeto definindo valores
		//a seus atributos
		$dados = new Requisicao(filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS)) ?? "Dados não informados";

		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta SELECT verificando se dados de usuario e email são corretos vindos da requisicao
		$query = "SELECT * FROM usuarios_uploaded_files WHERE usuario = :usuario AND senha = :senha";

		//Prepara query para ser executa no servidor MySQL
		$query = $db->prepare($query);
		$query->bindValue(":usuario", $dados->getUsuario());
		$query->bindValue(":senha", $dados->getSenha());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}

		//testa se quantidade de dados é maior que 0 na table de cadastro de usuarios
		//para upload e recupera dado do usuario através da requisicão pelo método fetch()
		//da classe PDO
		if($query->rowCount() > 0) {
			$informacao_usuario = $query->fetch();

			//grava informacao do usuario na sessão de usuario_files para logar
			$_SESSION["usuario_files"] = $informacao_usuario["usuario"];

			//redireciona usuario para pagina de upload
			header("Location:enviar_images.php");
			exit;
		}else {
			//define sessão de login
			$_SESSION["login"] = "
			<div class='container'>
				<div class='row'>
					<div class='col-lg-12 text-center'>
						<div class='alert alert-primary lead' role='alert'>
							<span class='text-center text-danger' style='font-family:verdana;'>
								Usuário ou Senha Incorretos !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:login_upload_files.php");
			exit;
		}
?>