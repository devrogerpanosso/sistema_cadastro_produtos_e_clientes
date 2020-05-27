<?php
		//inicia sessão
		session_start();

		//define classe contendo atributos da requisicao
		class Requisicao {
			private int $id_cliente = 0;
			private string $nome = "";
			private string $email = "";
			private string $cpf = "";
			private string $data_nascimento = "";
			private string $endereco = "";
			private string $bairro = "";
			private string $cidade = "";
			private string $estado_civil = "";
			private string $sexo = "";
			private string $referencial = "";

			//define metodo construtor inicializando atributos do objeto processando-os
			//e validando-os para receberem requisicoes externas no momento da criação do objeto
			public function __construct(int $id_cliente, string $nome, string $email, string $cpf, string $data_nascimento, 
			string $endereco, string $bairro, string $cidade, string $estado_civil, string $sexo, string $referencial) {
				if(is_numeric($id_cliente) AND isset($id_cliente) AND !empty($id_cliente)) {
					//referencia atributo da classe internamente
					$this->id_cliente = addslashes(trim(floatval(filter_input(INPUT_GET, "Id_Cliente", FILTER_SANITIZE_NUMBER_INT)))) ?? "ID não informado";
				}else {
					echo error_get_last();
				}
				
				if(is_string($nome) AND isset($nome) AND !empty($nome)) {
					if(strlen($nome) <= 2) {
						echo "Nome informado Invalido !!";
						//referencia atributo da classe internamente
						$this->nome = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Nome não informado";
					}else {
						echo "Nome valido !!";
						$this->nome = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Nome não informado";
					}
				}else {
					echo error_get_last();
				}

				if(is_string($email) AND isset($email) AND !empty($email)) {
					if(strlen($email) <= 2) {
						echo "E-Mail informado Invalido !!";
						//referencia atributo da classe internamente
						$this->email = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)))) ?? "E-mail não informado";
					}else {
						echo "E-Mail valido !!";
						$this->email = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)))) ?? "E-mail não informado";
					}
				}else {
					echo error_get_last();
				}

				if(is_string($cpf) AND isset($cpf) AND !empty($cpf)) {
					//referencia atributo da classe internamente
					$this->cpf = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS)))) ?? "CPF não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($data_nascimento) AND isset($data_nascimento) AND !empty($data_nascimento)) {
					//referencia atributo da classe internamente
					$this->data_nascimento = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_STRING)))) ?? "Data de Nascimento não informada";
				}else {
					echo error_get_last();
				}

				if(is_string($endereco) AND isset($endereco) AND !empty($endereco)) {
					if(strlen($endereco) <= 5) {
						echo "Endereço Invalido !!";
						//referencia atributo da classe internamente
						$this->endereco = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Endereço não informado";
					}else {
						echo error_get_last();
					}
				}

				if(is_string($bairro) AND isset($bairro) AND !empty($bairro)) {
					if(strlen($bairro) <= 2) {
						echo "Bairro informado Invalido !!";
						//referencia atributo da classe internamente
						$this->bairro = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Bairro não informado";
					}else {
						echo "Bairro Valido !!";
						$this->bairro = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Bairro não informado";
					}
				}else {
					echo error_get_last();
				}

				if(is_string($cidade) AND isset($cidade) AND !empty($cidade)) {
					if(strlen($cidade) <= 2) {
						echo "Cidade informada invalida !!";
						//referencia atributo da classe internamente
						$this->cidade = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Cidade não informada";
					}else {
						echo "Cidade valida !!";
						$this->cidade = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS)))) ?? "Cidade não informada";
					}
				}else {
					echo error_get_last();
				}

				if(is_string($estado_civil) AND isset($estado_civil) AND !empty($estado_civil)) {
					//referencia atributo da classe internamente
					$this->estado_civil = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "estado_civil", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Estado Civil não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($sexo) AND isset($sexo) AND !empty($sexo)) {
					//referencia atributo da classe internamente
					$this->sexo = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Sexo não informado";
				}else {
					echo error_get_last();
				}

				if(is_string($referencial) AND isset($referencial) AND !empty($referencial)) {
					//referencia atributo da classe internamente
					$this->referencial = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "referencial", FILTER_SANITIZE_SPECIAL_CHARS))))) ?? "Referencial não informado";
				}else {
					echo error_get_last();
				}
			}
			//define metodo de retorno de valores de atributos de processados e validados
			//para serem lidos posteriormente getters
			public function getIdcliente() {
				return $this->id_cliente ?? "Id não informado";
			}
			public function getNome() {
				return $this->nome ?? "Nome não informado";
			}
			public function getEmail() {
				return $this->email ?? "Email não informado";
			}
			public function getCpf() {
				return $this->cpf ?? "CPF não informado";
			}
			public function getDatanascimento() {
				return $this->data_nascimento ?? "Data de Nascimento não informada";
			}
			public function getEndereco() {
				return $this->endereco ?? "Endereço não informado";
			}
			public function getBairro() {
				return $this->bairro ?? "Bairro não informado";
			}
			public function getCidade() {
				return $this->cidade ?? "Cidade não informada";
			}
			public function getEstadocivil() {
				return $this->estado_civil ?? "Estado Civil não informado";
			}
			public function getSexo() {
				return $this->sexo ?? "Sexo não informado";
			}
			public function getReferencial() {
				return $this->referencial ?? "Referencial não informado";
			}
		}
		$dado = new Requisicao(filter_input(INPUT_GET, "Id_Cliente", FILTER_SANITIZE_NUMBER_INT),
		filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
		filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_STRING),
		filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS),
		filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "estado_civil", FILTER_SANITIZE_SPECIAL_CHARS),
		filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "referencial", FILTER_SANITIZE_SPECIAL_CHARS));

		//exibe estrutura do objeto com seus dados
		echo "<pre>";
		print_r($dado);
		echo "</pre>";

		//estabelece conexão com MySQL
		require_once "include/connect_mysql.php";

		//define consulta query de atualização de dados
		$query = "UPDATE clientes SET nome = :nome, email = :email, cpf = :cpf, data_nascimento = :data_nascimento, endereco = :endereco, 
		bairro = :bairro, cidade = :cidade, estado_civil = :estado_civil, sexo = :sexo, referencial = :referencial WHERE id = :id_cliente";

		//prepara query consulta para ser executada no MySQL
		$query = $db->prepare($query);
		$query->bindValue(":nome", $dado->getNome());
		$query->bindValue(":email", $dado->getEmail());
		$query->bindValue(":cpf", $dado->getCpf());
		$query->bindValue(":data_nascimento", $dado->getDatanascimento());
		$query->bindValue(":endereco", $dado->getEndereco());
		$query->bindValue(":bairro", $dado->getBairro());
		$query->bindValue(":cidade", $dado->getCidade());
		$query->bindValue(":estado_civil", $dado->getEstadocivil());
		$query->bindValue(":sexo", $dado->getSexo());
		$query->bindValue(":referencial", $dado->getReferencial());
		$query->bindValue(":id_cliente", $dado->getIdcliente());
		//executa consulta no servidor MySQL
		$query->execute();

		//testa se consulta foi realizada no DB
		if(isset($query) AND $query == TRUE) {
			echo "Consulta realizada com suscesso !!";
		}else {
			echo "Erro " . $db->errorInfo();
		}

		//testa se quantidade linhas de registros na table de clientes é maior que
		//0 através do metodo da classe PDO rowCount() e define sessão de atualização
		//ao usuario
		if($query->rowCount() > 0) {
			$_SESSION["atualizacoes_exclusoes"] = "
			<div class='container'>
				<div class='row justify-content-center'>
					<div class='col-lg-6 text-center'>
						<div class='alert alert-success fade show' role='alert'>
							<span class='text-success text-center bd-lead'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								Cliente Atualizado com Suscesso !!
							</span>
						</div>
					</div>
				</div>
			</div>";
			header("Location:acessar_clientes.php");
		}else {
			echo "<span class='text text-danger lead text-center'>Não há Clientes Cadastrados !!</span>";
			exit;
		}
?>