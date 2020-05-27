<?php
        //define sessão de login de usuario
        session_start();
        if(isset($_SESSION["usuario"]) AND !empty($_SESSION["usuario"])) {
            //echo $_SESSION["usuario"];
        }else {
            header("Location:login.php");
            exit;
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1,  shrink-to-fit=no"/>
        <title>Acessar Clientes</title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
    </head>
<body class="bg-dark">
    <article>
        <header>
            <hgroup>
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-lg-12 text-center">
                       <div class="p-3"></div>
                            <H1 class="page-header text-center text-capitalize lead text-primary" style="font-size:36px;">
                                Clientes Cadastrados
                            </H1>
                       </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <div class="p-2"></div>
                            <a class="nav-link-item link-striped alert-link badge badge-success" data-toggle="modal" data-target="#ModalQuantidadeClientesReferencial" title="Visualizar Clientes Cadastrados por Referencial" href="#">
                                Visualizar Quantidade de Clientes por Cidade
                            </a>
                            <a class="nav-link-item link-striped alert-link badge badge-success m-2" title="Pagina Inicial" href="index.php">
                                Página Inicial
						    </a>
                            <a class="nav-link-item link-striped alert-link badge badge-success" title="Cadastrar Clientes" href="cadastrar_clientes.php">
                                Cadastrar Clientes
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-1"></div>
                            <img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
                            <span class="text text-success" style="font-family:verdana;"><?php echo $_SESSION["usuario"];?></span>
                            <a class="nav-link-item link-striped alert-link m-2" style="text-decoration:none" title="Finalizar Sessão" href="sair.php">
                                <img src="imgs/off.png" width="40" class="img-responsive img-fluid" title="Finalizar Sessão"/>
                            </a>
                            <span class="text text-success" style="font-family:verdana;">Encerrar Sessão</span>
                        </div>
                    </div>
                </div>
            </hgroup>
        </header>
        <hr class="bg-success">
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <form name="ordenacao" method="GET">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize form-label"  style="font-family:verdana;" for="ordenar">Ordenar</label>
                                <?php
                                    //estabelece conexão com MySQL
                                    require_once "include/connect_mysql.php";

                                    //verifica se existe dado vindo da requisicao e define consulta query para seleção de dados de acordo com ordenacao especifica
                                    if(isset($_GET["ordenacao"]) AND !empty($_GET["ordenacao"])) {
                                        $ordenacao = $_GET["ordenacao"] ?? "Ordenação não Selecionada !!";
                                        //define query de acordo com ordenacao selecionada
                                        $query = "SELECT clientes.id, clientes.nome, clientes.email, clientes.cpf, clientes.data_nascimento, clientes.endereco, 
                                        clientes.bairro, clientes.cidade, clientes.estado_civil, clientes.sexo, referencias_clientes.referencia_cliente
                                        FROM clientes INNER JOIN referencias_clientes ON referencias_clientes.id = clientes.referencial ORDER BY {$ordenacao} ASC";
                                    }else {
                                        $ordenacao = NULL;
                                        $query = "SELECT clientes.id, clientes.nome, clientes.email, clientes.cpf, clientes.data_nascimento, clientes.endereco, 
                                        clientes.bairro, clientes.cidade, clientes.estado_civil, clientes.sexo, referencias_clientes.referencia_cliente
                                        FROM clientes INNER JOIN referencias_clientes ON referencias_clientes.id = clientes.referencial ORDER BY id ASC";
                                    }
                                ?>
                                <select name="ordenacao" class="form-control form-control-lg border border-info text-success" autocomplete="off" id="ordenacao" onchange="this.form.submit()">
                                    <option class="text text-success" value="id" <?php echo ($ordenacao == "id")?"selected=selected":"";?>>Ordenar por Id</option>
                                    <option class="text text-success" value="nome" <?php echo ($ordenacao == "nome")?"selected=selected":"";?>>Ordenar por Nome</option>
                                    <option class="text text-success" value="email" <?php echo ($ordenacao == "email")?"selected=selected":"";?>>Ordenar por E-Mail</option>
                                    <option class="text text-success" value="telefone" <?php echo ($ordenacao == "telefone")?"selected=selected":"";?>>Ordenar por Telefone</option>
                                    <option class="text text-success" value="cpf" <?php echo ($ordenacao == "cpf")?"selected=selected":"";?>>Ordenar por CPF</option>
                                    <option class="text text-success" value="data_nascimento" <?php echo ($ordenacao == "data_nascimento")?"selected=selected":"";?>>Ordenar por Data_Nascimento</option>
                                    <option class="text text-success" value="endereco" <?php echo ($ordenacao == "endereco")?"selected=selected":"";?>>Ordenar por Endereço</option>
                                    <option class="text text-success" value="bairro" <?php echo ($ordenacao == "bairro")?"selected=selected":"";?>>Ordenar por Bairro</option>
                                    <option class="text text-success" value="cidade" <?php echo ($ordenacao == "cidade")?"selected=selected":"";?>>Ordenar por Cidade</option>
                                    <option class="text text-success" value="estado_civil" <?php echo ($ordenacao == "estado_civil")?"selected=selected":"";?>>Ordenar por Estado_Civil</option>
                                    <option class="text text-success" value="sexo" <?php echo ($ordenacao == "sexo")?"selected=selected":"";?>>Ordenar por Sexo</option>
                                    <option class="text text-success" value="referencial" <?php echo ($ordenacao == "referencial")?"selected=selected":"";?>>Ordenar por Referencial</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-1"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <span class="text text-warning text-capitalize" style="font-family:verdana;">Total de Clientes Cadastrados:</span>
                        <?php
                                //define consulta query para selecionar contagem de clientes cadastrados
                                $total_clientes = "SELECT nome FROM clientes ORDER BY nome";

                                //seleciona query a classe PDO e executa através do metodo query()
                                $total_clientes = $db->query($total_clientes);

                                //testa se consulta foi realizada no DB
                                if(isset($total_clientes) AND $total_clientes == TRUE) {
                                    //echo "Consulta realizada com Suscesso !!";
                                }else {
                                    echo $db->errorInfo();
                                }

                                $quantidade = $total_clientes->rowCount();

                                if(isset($quantidade) AND !empty($quantidade) AND $quantidade > 0) {
                                    echo "<span class='text text-success'>".$quantidade."</span>";
                                }else {
                                    echo "<span class='text text-danger'>0</span>";
                                }
                        ?>
                    </div>
                </div>
            </div>
            <div class="p-2"></div>
            <?php
                if(isset($_SESSION["atualizacoes_exclusoes"]) AND !empty($_SESSION["atualizacoes_exclusoes"])) {
                    echo $_SESSION["atualizacoes_exclusoes"];
                    //finaliza sessão
                    unset($_SESSION["atualizacoes_exclusoes"]);
                }
            ?>
            <div class="p-1"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed">
                                <caption class="text text-warning text-capitazlie" style="font-family:verdana">List Of Clients</caption>
                                <thead class="thead-light text-center">
                                    <tr class="tr tr-active">
                                        <th class="text text-primary" scope="col">#</th>
                                        <th class="text text-primary" scope="col">Nome</th>
                                        <th class="text text-primary" scope="col">E-Mail</th>
                                        <th class="text text-primary" scope="col">CPF</th>
                                        <th class="text text-primary" scope="col">Data_Nascimento</th>
                                        <th class="text text-primary" scope="col">Endereço</th>
                                        <th class="text text-primary" scope="col">Bairro</th>
                                        <th class="text text-primary" scope="col">Cidade</th>
                                        <th class="text text-primary" scope="col">Estado_Civil</th>
                                        <th class="text text-primary" scope="col">Sexo</th>
                                        <th class="text text-primary" scope="col">Referencial</th>
                                        <th class="text text-primary" scope="col"></th>
                                        <th class="text text-primary" scope="col"></th>
                                    </tr>
                                </thead>
                                <?php
                                   

                                    //Seleciona consulta a classe PDO e executa-a através do metodo de execução query() no servidor MySQL
                                    $query = $db->query($query);

                                    //testa se consulta foi realizada no DB
                                    if(isset($query) AND $query == TRUE) {
                                        //echo "Consulta realizada com Suscesso !!";
                                    }else {
                                        echo "Erro => " . $db->errorInfo();
                                    }

                                    //testa se quantidade de linhas de registros na table de clientes
                                    //é maior que 0 através do metodo de contagen da classe PDO rowCount()
                                    //e seleciona dados
                                    if($query->rowCount() > 0) {
                                        //echo "Há dados para serem selecionados !!";
                                        /*
                                            exibe dados através da estrutura de repetição foreach que 
								            tera por finalidade exibir os dados vindos da requisicao
								            da query através de array pela funcao fetchAll() que 
								            ira decompor os dados vindos da requisicao da query
								            em forma de array associativo de modo que cada indice
								            associativo do array represente o campo atual da tabela
								            na base de dados com seus respectivos valores
                                        */
                                        echo "<tbody>";
                                        foreach ($query->fetchAll() as $value) {
                                            echo "<tr class='active'>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['id']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['nome']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['email']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['cpf']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['data_nascimento']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['endereco']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['bairro']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['cidade']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['estado_civil']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['sexo']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>{$value['referencia_cliente']}</td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>
                                                <a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalUpdateClientes".$value['id']."' title='Atualizar Cliente' href='atualizar_clientes.php".$value['id']."'>
                                                    <img src='imgs/update.png' width='35' class='img-responsive ImgIconUpdateDelete' title='Atualizar Cliente'/>
                                                </a>
                                            </td>";
                                            echo "<td class='text text-success text-center p-3' style='font-family:verdana;'>
                                                <a class='nav-link-item link-striped alert-link' data-toggle='modal' data-target='#ModalDeleteClientes".$value['id']."' title='Atualizar Cliente' href='deletar_clientes.php".$value['id']."'>
                                                    <img src='imgs/delete.png' width='35' class='img-responsive ImgIconUpdateDelete' title='Deletar Cliente'/>
                                                </a>
                                            </td>";
                                            echo "</tr>";
                                            echo "<div class='modal fade bd-example-modal-xl' id='ModalUpdateClientes".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='AtualizacaoClientes".$value['id']."' aria-hidden='true'>
                                                     <div class='modal-dialog modal-xl' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-primary lead' id='AtualizacaoClientes".$value['id']."'>Atualizar Clientes</h5>
                                                                <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body text-left bg-light'>
                                                                <div class='container'>
                                                                    <form name='update_clientes' method='POST' action='update_clientes.php?Id_Cliente=".$value['id']."'>
                                                                        <div class='form-row'>
                                                                            <div class='col-lg-6'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='nome'>Nome</label>
                                                                                    <input type='hidden' name='id_cliente' value='".$value['id']."'>
                                                                                    <input type='text' name='nome' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='nome' value='".$value['nome']."'/>
                                                                                    <small class='text text-dark  text-capitalize form-text'>Informe o Nome Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-6'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='email'>E-Mail</label>
                                                                                    <input type='email' name='email' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='email' value='".$value['email']."'/>
                                                                                    <small class='text text-dark  text-capitalize form-text'>Informe um E-Mail valido Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='cpf'>CPF</label>
                                                                                    <input type='text' name='cpf' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='cpf' value='".$value['cpf']."'/>
                                                                                    <small class='text text-dark  text-capitalize form-text'>Informe o CPF Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='data_nascimento'>Data de Nascimento</label>
                                                                                    <input type='text' name='data_nascimento' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='data_nascimento' value='".$value['data_nascimento']."'/>
                                                                                    <small class='text text-dark  text-capitalize form-text'>Informe a Data de Nascimento Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='endereco'>Endereço</label>
                                                                                    <input type='text' name='endereco' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='endereco' value='".$value['endereco']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe o Endereço atual Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='bairro'>Bairro</label>
                                                                                    <input type='text' name='bairro' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='bairro' value='".$value['bairro']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe o Bairro atual Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='cidade'>Cidade</label>
                                                                                    <input type='text' name='cidade' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='cidade' value='".$value['cidade']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe a Cidade atual Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='estado_civil'>Estado Civil</label>
                                                                                    <input type='text' name='estado_civil' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='estado_civil' value='".$value['estado_civil']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe o Estado Civil atual Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='sexo'>Sexo</label>
                                                                                    <input type='text' name='sexo' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='sexo' value='".$value['sexo']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe o Sexo correspondente.</small>
                                                                                </div>
                                                                            </div>
                                                                            <div class='col-lg-3'>
                                                                                <div class='form-group'>
                                                                                    <label class='text text-warning text-capitalize' style='font-family:verdana;' for='referencial'>Referencial</label>
                                                                                    <input type='text' name='referencial' class='form-control form-control-lg border border-info text-dark' autocomplete='off' id='sexo' value='".$value['referencia_cliente']."'/>
                                                                                    <small class='text text-dark text-capitalize form-text'>Informe o Referencial Corretamente.</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='submit' class='btn btn-skin btn-hover btn-lg btn btn-success'>Atualizar Cliente</button>
                                                                    <button type='button' class='btn btn-skin btn-hover btn-lg btn btn-primary' data-dismiss='modal'>Fechar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>";
                                             echo "<div class='modal fade bd-example-modal-xl' id='ModalDeleteClientes".$value['id']."' tabindex='-1' role='dialog' aria-labelledby='DeleteClientes".$value['id']."' aria-hidden='true'>
                                                      <div class='modal-dialog modal-xl' role='document'>
                                                         <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title text-primary lead' id='DeleteClientes".$value['id']."'>Deletar Clientes</h5>
                                                                <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body text-left bg-light'>
                                                                <span class='text text-danger text-capitalize'>
                                                                    Tem certeza de que deseja deletar este cliente ?
                                                                </span>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <form name='delete_clientes' method='POST' action='delete_clientes.php?Id_Cliente=".$value['id']."'>
                                                                    <button type='submit' class='btn btn-skin btn-hover btn-lg btn btn-danger'>Deletar Cliente</button>
                                                                    <button type='button' class='btn btn-skin btn-hover btn-lg btn btn-primary' data-dismiss='modal'>Fechar</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                            
                                        }
                                        echo "</tbody>";
                                    }else {
                                        echo "<span class='text text-danger text-capitalize lead'>Não há dados de Clientes para serem selecionados !!</span>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>

    <!--modal quantidade clientes por referencial-->
    <div class='modal fade bd-example-modal-xl' id="ModalQuantidadeClientesReferencial" tabindex='-1' role='dialog' aria-labelledby="modalQuantidade" aria-hidden='true'>
        <div class='modal-dialog modal-xl' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title text-primary lead' id="modalQuantidade">Quantidade de Clientes Por Municipio</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body text-center bg-light'>
                    <span class="text-dark bd-lead text-capitalize"><strong>Total de Clientes Cadastrados do Municipio de Sarandi-PR:</strong></span>
                    <?php
                        //define consulta query selecionando total de clientes cadastrados do municipio de Sarandi-PR
                        $query = "SELECT * FROM clientes_sarandipr ORDER BY nome ASC";

                        //Seleciona consulta classe PDO e executa a através do metodo query()
                        $query = $db->query($query);

                        $clientes_sarandi = $query->rowCount();

                        //testa se quantidade de clientes é maior que 0 e seleciona total atrvés do metodo de contagem rowCount()
                        if(isset($clientes_sarandi) AND $clientes_sarandi > 0) {
                            echo "<span class='mr-2 text-success text-capitalize bd-lead'>$clientes_sarandi Clientes Cadastrados: </span>" . "<br>\n";
                        }else {
                            echo "<span class='mr-2 text-danger text-capitalize bd-lead'>0 Clientes Cadastrados</span>" . "<br>\n";
                        }

                        //exibe nome dos clientes cadastrados através da estrutura de repetição foreach que ira percorrer as chaves
                        //associativas do array de retorno da requisicao da query select com os seguintes dados. Retornando-os do DB
                        //atrvés da funcao fetchAll() que trata todos os dados em forma de array associativo de modo que cada chave
                        //associativa do array represente a coluna atual da tabela com seus respectivos dados
                        echo "<strong>Clientes: </strong>";
                        foreach ($query->fetchAll() as $value) {
                            //print_r($value);
                            echo "<span class='text-dark'>{$value['nome']} , </span>";
                        }
                    ?>
                    <div class="p-2"></div>
                    <span class="text-dark bd-lead text-capitalize"><strong>Total de Clientes Cadastrados do Municipio de Maringá-PR:</strong></span>
                    <?php
                        //define consulta query selecionando total de clientes cadastrados do municipio de Maringá-PR
                        $query = "SELECT * FROM clientes_maringapr ORDER BY nome ASC";

                        //Seleciona consulta a classe PDO e executa-a através do metodo query()
                        $query = $db->query($query);

                        $clientes_maringa = $query->rowCount();

                        //testa se quantidade de clientes é maior que 0 e seleciona total atrvés do metodo de contagem rowCount()
                        if(isset($clientes_maringa) AND $clientes_maringa > 0) {
                            echo "<span class='mr-2 text-success text-capitalize bd-lead'>$clientes_maringa Clientes Cadastrados</span>" . "<br>\n";
                        }else {
                            echo "<span class='mr-2 text-danger text-capitalize bd-lead'>0 Clientes Cadastrados</span>" . "<br>\n";
                        }

                        //exibe nome dos clientes cadastrados através da estrutura de repetição foreach que ira percorrer as chaves
                        //associativas do array de retorno da requisicao da query select com os seguintes dados. Retornando-os do DB
                        //atrvés da funcao fetchAll() que trata todos os dados em forma de array associativo de modo que cada chave
                        //associativa do array represente a coluna atual da tabela com seus respectivos dados
                        echo "<strong>Clientes: </strong>";
                        foreach ($query->fetchAll() as $value) {
                            //print_r($value);
                            echo "<span class='text-dark'>{$value['nome']} , </span>";
                        }
                    ?>
                    <div class="p-2"></div>
                    <span class="text-dark bd-lead text-capitalize"><strong>Total de Clientes Cadastrados do Municipio de Marialva-PR:</strong></span>
                    <?php
                        //define consulta query selecionando total de clientes cadastrados do municipio de Maringá-PR
                        $query = "SELECT * FROM clientes_marialvapr ORDER BY nome ASC";

                        //Seleciona consulta a classe PDO e executa-a através do metodo query()
                        $query = $db->query($query);

                        $clientes_marialva = $query->rowCount();

                        //testa se quantidade de clientes é maior que 0 e seleciona total atrvés do metodo de contagem rowCount()
                        if(isset($clientes_marialva) AND $clientes_marialva > 0) {
                            echo "<span class='mr-2 text-success text-capitalize bd-lead'>$clientes_marialva Clientes Cadastrados</span>" . "<br>\n";
                        }else {
                            echo "<span class='mr-2 text-danger text-capitalize bd-lead'>0 Clientes Cadastrados</span>" . "<br>\n";
                        }

                        //exibe nome dos clientes cadastrados através da estrutura de repetição foreach que ira percorrer as chaves
                        //associativas do array de retorno da requisicao da query select com os seguintes dados. Retornando-os do DB
                        //atrvés da funcao fetchAll() que trata todos os dados em forma de array associativo de modo que cada chave
                        //associativa do array represente a coluna atual da tabela com seus respectivos dados
                        echo "<strong>Clientes: </strong>";
                        foreach ($query->fetchAll() as $value) {
                            //print_r($value);
                            echo "<span class='text-dark'>{$value['nome']} , </span>";
                        }
                    ?>
                    <div class="p-2"></div>
                    <span class="text-dark bd-lead text-capitalize"><strong>Total de Clientes Cadastrados do Municipio de Arapongas-PR:</strong></span>
                    <?php
                        //define consulta query selecionando total de clientes cadastrados do municipio de Maringá-PR
                        $query = "SELECT * FROM clientes_arapongaspr ORDER BY nome ASC";

                        //Seleciona consulta a classe PDO e executa-a através do metodo query()
                        $query = $db->query($query);

                        $clientes_arapongas = $query->rowCount();

                        //testa se quantidade de clientes é maior que 0 e seleciona total atrvés do metodo de contagem rowCount()
                        if(isset($clientes_arapongas) AND $clientes_arapongas > 0) {
                            echo "<span class='mr-2 text-success text-capitalize bd-lead'>$clientes_arapongas Clientes Cadastrados</span>" . "<br>\n";
                        }else {
                            echo "<span class='mr-2 text-danger text-capitalize bd-lead'>0 Clientes Cadastrados</span>" . "<br>\n";
                        }

                        //exibe nome dos clientes cadastrados através da estrutura de repetição foreach que ira percorrer as chaves
                        //associativas do array de retorno da requisicao da query select com os seguintes dados. Retornando-os do DB
                        //atrvés da funcao fetchAll() que trata todos os dados em forma de array associativo de modo que cada chave
                        //associativa do array represente a coluna atual da tabela com seus respectivos dados
                        echo "<strong>Clientes: </strong>";
                        foreach ($query->fetchAll() as $value) {
                            //print_r($value);
                            echo "<span class='text-dark'>{$value['nome']} , </span>";
                        }
                    ?>
                    <div class="p-2"></div>
                    <span class="text-dark bd-lead text-capitalize"><strong>Total de Clientes Cadastrados do Municipio de Apucarana-PR:</strong></span>
                    <?php
                        //define consulta query selecionando total de clientes cadastrados do municipio de Maringá-PR
                        $query = "SELECT * FROM clientes_apucaranapr ORDER BY nome ASC";

                        //Seleciona consulta a classe PDO e executa-a através do metodo query()
                        $query = $db->query($query);

                        $clientes_apucaranapr = $query->rowCount();

                        //testa se quantidade de clientes é maior que 0 e seleciona total atrvés do metodo de contagem rowCount()
                        if(isset($clientes_apucaranapr) AND $clientes_apucaranapr > 0) {
                            echo "<span class='mr-2 text-success text-capitalize bd-lead'>$clientes_apucaranapr Clientes Cadastrados</span>" . "<br>\n";
                        }else {
                            echo "<span class='mr-2 text-danger text-capitalize bd-lead'>0 Clientes Cadastrados</span>" . "<br>\n";
                        }

                        //exibe nome dos clientes cadastrados através da estrutura de repetição foreach que ira percorrer as chaves
                        //associativas do array de retorno da requisicao da query select com os seguintes dados. Retornando-os do DB
                        //atrvés da funcao fetchAll() que trata todos os dados em forma de array associativo de modo que cada chave
                        //associativa do array represente a coluna atual da tabela com seus respectivos dados
                        echo "<strong>Clientes: </strong>";
                        foreach ($query->fetchAll() as $value) {
                            //print_r($value);
                            echo "<span class='text-dark'>{$value['nome']} , </span>";
                        }
                    ?>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-skin btn-hover btn-lg btn btn-primary' data-dismiss='modal'>Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>