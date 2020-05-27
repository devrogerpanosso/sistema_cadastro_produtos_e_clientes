<?php
        //inicia sessão
        session_start();

        //define classe contendo atributos da requisicao 
        class Requisicao {
            private int $id_cliente = 0;
            private string $nome = "";
            private string $email = "";
            private string $telefone = "";
            private string $cpf = "";
            private string $data_nascimento = "";
            private string $endereco = "";
            private string $bairro = "";
            private string $cidade = "";
            private string $estado_civil = "";
            private string $sexo = "";
            private int $referencial = 0;

            //define metodo construtor inicializando atributos do objeto para
            //serem retornados posteriormente no momento de sua criação gerando requisições
            //externas definindo valores a seus atributos internamente.
            public function __construct(int $id_cliente, string $nome, string $email, string $telefone, 
            string $cpf, string $data_nascimento, string $endereco, string $bairro, string $cidade, 
            string $estado_civil, string $sexo, int $referencial) {
                if(is_numeric($id_cliente) AND isset($id_cliente) AND !empty($id_cliente) AND floatval($id_cliente)) {
                    //referencia atributo da classe internamente
                    $this->id_cliente = addslashes(trim(floatval(filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT))));
                }

                if(is_string($nome) AND isset($nome) AND !empty($nome)) {
                    if(strlen($nome) <= 2) {
                        echo "<script>
                            alert('Nome informado Invalido !!');
                        </script>" . "<br>\n";
                        //referencia atributo da classe internamente 
                        $this->nome = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Nome informado Valido !!" . "<br>\n";
                        $this->nome = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }
                }

                if(is_string($email) AND isset($email) AND !empty($email)) {
                    //referencia atributo da classe internamente
                    $this->email = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL))));
                }else {
                    echo error_get_last();
                }

                if(is_string($telefone) AND isset($telefone) AND !empty($telefone)) {
                    if(strlen($telefone) > 15) {
                        echo "Telefone Invalido !!" . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->telefone = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS))));
                    }else {
                        echo "Telefone Valido !!"  . "<br>\n";
                        $this->telefone = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS))));
                    }
                }

                if(is_string($cpf) AND isset($cpf) AND !empty($cpf)) {
                    //referencia atributo da classe internamente
                    $this->cpf = addslashes(htmlspecialchars(trim(filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING))));
                }else {
                    echo error_get_last();
                }

                if(is_string($data_nascimento) AND isset($data_nascimento) AND !empty($data_nascimento)) {
                    //referencia atributo da classe internamente
                    $this->data_nascimento = addslashes(htmlspecialchars(trim(date("d/m/Y", strtotime(filter_input(INPUT_POST, "data_nascimento", FILTER_SANITIZE_SPECIAL_CHARS))))));
                }else {
                     echo error_get_last();
                }

                if(is_string($endereco) AND isset($endereco) AND !empty($endereco)) {
                    if(strlen($endereco) <= 2) {
                        echo "Endereço invalido !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->endereco = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Endereço Valido !!"  . "<br>\n";
                        $this->endereco = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "endereco", FILTER_SANITIZE_SPECIAL_CHARS)))));

                    }
                }

                if(is_string($bairro) AND isset($bairro) AND !empty($bairro)) {
                    if(strlen($bairro) <= 2) {
                        echo "Bairro informado Invalido !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->bairro = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Bairro informado Valido !!"  . "<br>\n";
                        $this->bairro = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }
                }

                if(is_string($cidade) AND isset($cidade) AND !empty($cidade)) {
                    if(strlen($cidade) <= 2) {
                        echo "Cidade Informada invalida !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->cidade = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Cidade informada valida !!"  . "<br>\n";
                        $this->cidade = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }
                }

                if(is_string($estado_civil) AND isset($estado_civil) AND !empty($estado_civil)) {
                    if(strlen($estado_civil) <= 2) {
                        echo "Cidade Informada invalida !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->estado_civil = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "estado_civil", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Cidade informada valida !!"  . "<br>\n";
                        $this->estado_civil = addslashes(htmlspecialchars(trim(ucwords(filter_input(INPUT_POST, "estado_civil", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }
                }

                if(is_string($sexo) AND isset($sexo) AND !empty($sexo)) {
                    if(strlen($sexo) <= 2) {
                        echo "Sexo informado invalido !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->sexo = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }else {
                        echo "Sexo informado valido !!"  . "<br>\n";
                        $this->sexo = addslashes(htmlspecialchars(trim(ucfirst(filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS)))));
                    }
                }

                if(is_numeric($referencial) AND isset($referencial) AND !empty($referencial)) {
                    if($referencial <= 4) {
                        echo "Referencia do cliente valido !!"  . "<br>\n";
                        //referencia atributo da classe internamente
                        $this->referencial = addslashes(trim(floatval(filter_input(INPUT_POST, "referencial", FILTER_SANITIZE_NUMBER_INT))));
                    }else {
                        echo "Referencial do cliente invalido !!"  . "<br>\n";
                        $this->referencial = addslashes(trim(floatval(filter_input(INPUT_POST, "referencial", FILTER_SANITIZE_NUMBER_INT))));
                    }
                }
            }
            //Define metodos de retorno de valores getters para retornar valores dos atributos para serem 
            //lidos posteriormente como atriburos internos do objeto
            public function getIdcliente() {
                return $this->id_cliente ?? "Id do cliente não informado !!";
            }
            public function getNome() {
                return $this->nome ?? "Nome do Cliente não informado !!";
            }
            public function getEmail() {
                return $this->email ?? "E-Mail do Cliente não informado !!";
            }
            public function getTelefone() {
                return $this->telefone ?? " Telefone do Cliente não informado !!";
            }
            public function getCpf() {
                return $this->cpf ?? "CPF do Cliente não informado !!";
            }
            public function getDatanascimento() {
                return $this->data_nascimento ?? "Data de Nascimento do Cliente não informada !!";
            }
            public function getEndereco() {
                return $this->endereco ?? "Endereço do Cliente não informado !!";
            }
            public function getBairro() {
                return $this->bairro ?? "Bairro do Cliente não informado !!";
            }
            public function getCidade() {
                return $this->cidade ?? "Cidade do Cliente não informada !!";
            }
            public function getEstadocivil() {
                return $this->estado_civil ?? "Estado Civil do Cliente não informado !!";
            }
            public function getSexo() {
                return $this->sexo ?? "Sexo do Cliente não informado !!";
            }
            public function getReferencial() {
                return $this->referencial ?? "Referencial do Cliente não informado !!";
            }
        }
        //Realiza instancia da classe Requisicao Criando objeto inicializando metodo construtor
        //e retorna valores de seus atributos 
        $dados_cliente = new Requisicao(filter_input(INPUT_POST, "id_cliente", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS), 
        filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING), filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, "data_nascimento"), filter_input(INPUT_POST, "endereco"), filter_input(INPUT_POST, "bairro"), 
        filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "estado_civil", FILTER_SANITIZE_SPECIAL_CHARS), filter_input(INPUT_POST, "sexo", FILTER_SANITIZE_SPECIAL_CHARS), 
        filter_input(INPUT_POST, "referencial", FILTER_SANITIZE_NUMBER_INT));

        //exibe estrutura do objeto com seus dados
        echo "<pre>";
        print_r($dados_cliente);
        echo "</pre>";

        //estabelece conexão com MySQL
        require_once "include/connect_mysql.php";

        //Define consulta query de anexação para inserção de dados
        $query = "INSERT INTO clientes (id,nome,email,telefone,cpf,data_nascimento,endereco,bairro,cidade,estado_civil,sexo,referencial) 
        VALUES (:id_cliente, :nome, :email, :telefone, :cpf, :data_nascimento, :endereco, :bairro, :cidade, :estado_civil, :sexo, :referencial)";

        //prepara query para ser executada no MySQL
        $query = $db->prepare($query);
        $query->bindValue(":id_cliente", $dados_cliente->getIdcliente());
        $query->bindValue(":nome", $dados_cliente->getNome());
        $query->bindValue(":email", $dados_cliente->getEmail());
        $query->bindValue(":telefone", $dados_cliente->getTelefone());
        $query->bindValue(":cpf", $dados_cliente->getCpf());
        $query->bindValue(":data_nascimento", $dados_cliente->getDatanascimento());
        $query->bindValue(":endereco", $dados_cliente->getEndereco());
        $query->bindValue(":bairro", $dados_cliente->getBairro());
        $query->bindValue(":cidade", $dados_cliente->getCidade());
        $query->bindValue(":estado_civil", $dados_cliente->getEstadocivil());
        $query->bindValue(":sexo", $dados_cliente->getSexo());
        $query->bindValue(":referencial", $dados_cliente->getReferencial());
        //executa consulta no servidor MySQL
        $query->execute();

        //testa se consulta foi realizada no DB
        if(isset($query) AND $query == TRUE) {
            echo "Consulta realizada com suscesso !!";
        }else {
            echo $db->errorInfo();
        }

        //testa se quantidade de registros inseridos na table de cadastro de clientes
        //é maior que 0 através do metodo de contagem da classe PDO rowCount() e
        //define sessão de cadastro ao usuario
        if($query->rowCount() > 0) {
            $_SESSION["cadastro_cliente"] = "
            <div class='container'>
                <div class='row justify-content-center'>
                    <div class='col-lg-6 text-center'>
                        <div class='alert alert-success fade show' role='alert'>
                            <span class='text-center text-success bd-lead'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                Cliente Cadastrado com Suscesso !!
                            </span>
                        </div>
                    </div>
                </div>
            </div>";
            header("Location:cadastrar_clientes.php");
            exit;
        }else {
            header("Location:cadastrar_clientes.php");
            echo "<span class='text-center text-danger lead'>Não há Clientes Cadastrados !!</span>";
            exit;
        }
?>