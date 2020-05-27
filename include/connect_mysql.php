<?php
		//cria classe com atributos privados de conexão
		class Conexao {
			private $dsn;
			private $dbuser;
			private $dbpass;
			private $db;

			//cria metodo de acesso aos atributos
			public function mysql() {
				$this->dsn = "mysql:dbname=projetoa_oo;port=3306;host=localhost";
				$this->dbuser = "root";
				$this->dbpass = "";

				return $this->db = new PDO($this->dsn, $this->dbuser, $this->dbpass);
			}
		}
		//realiza instancia da classe conexão criando objeto
		$connect = new Conexao;
		$db = $connect->mysql();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//testa se conexão foi realizada
		if($db == TRUE) {
			//echo "<font color='green'>Conexão estabelecida com suscesso !!</font>";
		}else {
			echo "Erro => " . $db->getMessage();
		}
?> 