<?php

		//inicia sessão
		session_start();

		//define classe contendo dados da requisicao "form"
		class Email {
			private $email_remetente;
			private $email_destinatario;
			private $assunto_email;
			private $mensagem;

			//define metodo construtor inicializando dados do objeto processando-os
			//e validando-os sendo armazenados como atributos internos do objeto
			//para serem lidos posteriormente
			public function __construct($email_remetente, $email_destinatario, $assunto_email, $mensagem) {
				if(is_string($_POST["email_remetente"]) AND isset($_POST["email_remetente"]) AND !empty($_POST["email_remetente"])) {
					//referencia atributo da classe internamente
					$this->email_remetente = addslashes(htmlspecialchars(trim($_POST["email_remetente"]))) ?? "Email de Remetente não informado";
					//grava email de remetente
					file_put_contents("email_remetente.txt", "Email Remetente:{$this->email_remetente}", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["email_destinatario"]) AND isset($_POST["email_destinatario"]) AND !empty($_POST["email_destinatario"])) {
					//referencia atributo da classe internamente
					$this->email_destinatario = addslashes(htmlspecialchars(trim($_POST["email_destinatario"]))) ?? "Email do Destinatario não informado";
					//grava email de destinatario
					file_put_contents("email_destinatario.txt", "Email Destinatario:{$this->email_destinatario}", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["assunto_email"]) AND isset($_POST["assunto_email"]) AND !empty($_POST["assunto_email"])) {
					//referencia atributo da classe internamente
					$this->assunto_email = addslashes(htmlspecialchars(trim(ucwords($_POST["assunto_email"])))) ?? "Assunto de Email não informado";
					//grava assunto de email
					file_put_contents("assunto_email.txt", "Assunto Email:{$this->assunto_email}", FILE_APPEND);
				}else {
					echo error_get_last();
				}

				if(is_string($_POST["mensagem"]) AND isset($_POST["mensagem"]) AND !empty($_POST["mensagem"])) {
					//referencia atributo da classe internamente
					$this->mensagem = addslashes(htmlspecialchars(trim(ucfirst($_POST["mensagem"])))) ?? "Mensagem de Email não informada";
					//grava mensagem de email enviada
					file_put_contents("mensagem_email.txt", "Mensagem de Email:{$this->mensagem}", FILE_APPEND);
				}else {
					echo error_get_last();
				}
			}
			//define metodos de retorno de valores para retornar valores dos atributos depois
			//de processados e validados getter
			public function getEmailremetente() {
				return $this->email_remetente;
			}
			public function getEmaildestinatario() {
				return $this->email_destinatario;
			}
			public function getAssuntoemail() {
				return $this->assunto_email;
			}
			public function getMensagem() {
				return $this->mensagem;
			}
		}
		//realiza instancia da classe email criando objeto referenciando e definindo valores
		//a seus atributos inicializando metodo construtor
		$dados_email = new Email($_POST["email_remetente"], $_POST["email_destinatario"], $_POST["assunto_email"], $_POST["mensagem"]);

		//exibe estrutura do objeto com seus dados
		echo "<pre>";
		var_dump($dados_email);
		echo "</pre>";

		//estabelece conexão com MySQL
		require "include/connect_mysql.php";

		//define query consulta de anexação para inserção de dados
		$query = "INSERT INTO dados_email (email_remetente,email_destinatario,assunto_email,mensagem_email) 
		VALUES (:email_remetente, :email_destinatario, :assunto_email, :mensagem_email)";

		//prepara query para ser executada
		$query = $db->prepare($query);
		$query->bindValue(":email_remetente", $dados_email->getEmailremetente());
		$query->bindValue(":email_destinatario", $dados_email->getEmaildestinatario());
		$query->bindValue(":assunto_email", $dados_email->getAssuntoemail());
		$query->bindValue(":mensagem_email", $dados_email->getMensagem());
		//executa query no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada e define envio de email ao usuario
		if($query == TRUE) {
			echo "Consulta realizada com suscesso !!";

			echo "<br>" . PHP_EOL;

			//Define variaveis especificas para armazenamento de dados para envio de email
			$para = "{$dados_email->getEmaildestinatario()}";
			$assunto = "{$dados_email->getAssuntoemail()} ! ! !";
			$message = "{$dados_email->getMensagem()}";
			$remetente = "From:{$dados_email->getEmailremetente()}";

			//utiliza funcao mail()
			//mail("$para", "$assunto", "$message", "$remetente");
		}else {
			echo $db->errorInfo();
		}

		//testa se numero de dados na table dados_email é maior que 0
		//e define sessão de email ao envio de email ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["envio_email"] = "
			<div class='container'>
				<div class='row'>
					<div class='col-lg-12 text-center'>
						<div class='alert alert-primary text-center lead' role='alert'>
							<span class='text text-success text-center lead' style='font-family:verdana;'>
							 	E-Mail enviado com Suscesso. Entraremos em contato em breve. Obrigado !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:enviar_emails.php");
		}else {
			echo "<p class='text text-danger text-lowercase' style='font-family:verdana;'>Não há E-Mails enviados !!</p>";
		}
?>