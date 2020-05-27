<?php

		//inicia sessão
		session_start();

		//define classe com atributos da requisicao
		class Contato {
			private $nome;
			private $email;
			private $telefone;
			private $endereco;
			private $assunto;
			private $mensagem;

			//define metodo construtor incializando dados do objeto
			//processando-os e validando-os para serem atribuidos
			//como atributos internos do objeto
			public function __construct($nome, $email, $telefone, $endereco, $assunto, $mensagem) {
				if(is_string($_POST["nome"]) AND isset($_POST["nome"]) AND !empty($_POST["nome"])) {
					//referencia atributo da classe internamente
					$this->nome = addslashes(htmlspecialchars(trim(ucwords($_POST["nome"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["email"]) AND isset($_POST["email"]) AND !empty($_POST["email"])) {
					//referencia atributo da classe internamente
					$this->email = addslashes(htmlspecialchars(trim($_POST["email"])));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["fone"]) AND isset($_POST["fone"]) AND !empty($_POST["fone"])) {
					//referencia atributo da classe internamente
					$this->telefone = addslashes(htmlspecialchars(trim($_POST["fone"])));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["endereco"]) AND isset($_POST["endereco"]) AND !empty($_POST["endereco"])) {
					//referencia atributo da classe internamente
					$this->endereco = addslashes(htmlspecialchars(trim(ucwords($_POST["endereco"]))));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["assunto"]) AND isset($_POST["assunto"]) AND !empty($_POST["assunto"])) {
					//referencia atributo da classe internamente
					$this->assunto = addslashes(htmlspecialchars(trim($_POST["assunto"])));
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["mensagem"]) AND isset($_POST["mensagem"]) AND !empty($_POST["mensagem"])) {
					//referencia atributo da classe internamente
					$this->mensagem = addslashes(htmlspecialchars(trim(ucfirst($_POST["mensagem"]))));
				}else {
					echo error_get_last();
				}
			}
			//define metodos getters para retorno de valores dos atributos
			//para serem lidos posteriormente
			public function getNome() {
				return $this->nome;
			}
			public function getEmail() {
				return $this->email;
			}
			public function getTelefone() {
				return $this->telefone;
			}
			public function getEndereco() {
				return $this->endereco;
			}
			public function getAssunto() {
				return $this->assunto;
			}
			public function getMensagem() {
				return $this->mensagem;
			}
		}
		//realiza instancia da classe Contato criando objeto referenciando
		//e definindo valores a seus atributos inicializando método construtor
		$dados = new Contato($_POST["nome"], $_POST["email"], $_POST["fone"],
		$_POST["endereco"], $_POST["assunto"], $_POST["mensagem"]);

		//exibe estrutura do objeto com seus dados
		echo "<pre>";
		var_dump($dados);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta para inserção de dados
		$query = "INSERT INTO mensagems (nome,email,telefone,endereco,assunto,mensagem) 
		VALUES (:nome, :email, :telefone, :endereco, :assunto, :mensagem)";

		//prepara query para ser executada
		$query = $db->prepare($query);
		$query->bindValue(":nome", $dados->getNome());
		$query->bindValue(":email", $dados->getEmail());
		$query->bindValue(":telefone", $dados->getTelefone());
		$query->bindValue(":endereco", $dados->getEndereco());
		$query->bindValue(":assunto", $dados->getAssunto());
		$query->bindValue(":mensagem", $dados->getMensagem());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada
		if($query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo $db->errorInfo();
		}
		
		//testa se numero de dados inseridos na table mensagems é maior
		//que 0 e define sessão ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["mensagem"] = "
				<div class='alert alert-primary text-center' role='alert'>
					<span class='text text-success' style='font-family:verdana;'>
						Mesnagem Enviada com Suscesso. Entraremos en contato em breve. Obrigado !!
					</span>
				</div>
			";
			header("Location:index.php");
		}else {
			echo "<p class='text text-danger'>Não há mensagems enviadas !!</p>";
		}
?>