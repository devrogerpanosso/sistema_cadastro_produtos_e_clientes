<?php
        //define sessão de usuario logado
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
        <mata name="viewport" content="width=device-width, initial-scale=1,  shrink-to-fit=no"/>
        <title>Cadastrar Clientes</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
    </head>
<body class="bg-dark">
    <article>
        <header>
            <hgroup>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="p-3"></div>
                            <H1 class="page-header text-center text-capitalize text-primary lead" style="font-size:36px;">
                                Cadastrar Clientes
                            </H1>
                        </div>
                    </div>
                </div>
                <div class="p-1"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 text-center">
						    <div class="p-1"></div>
						    <a class="nav-link-item link-striped alert-link text-center badge badge-success" title="Pagina Incial" href="index.php">Página Incial</a>
						    <a class="nav-link-item link-striped alert-link text-center m-2  badge badge-success" title="Acessar Produtos" href="acessar_clientes.php">Obter acesso a Clientes</a>
					    </div>
                        <div class="col-lg-6">
						<img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
						<span class="text text-success m-1" style="font-family:verdana;"><?php echo $_SESSION["usuario"];?></span>
						<a class="nav-link-item link-striped alert-link m-2" style="text-decoration:none" title="Finalizar Sessão" href="sair.php">
							<img src="imgs/off.png" width="40" class="img-responsive img-fluid" title="Finalizar Sessão"/>
						</a>
						<span class="text text-success" style="font-family:verdana;">Encerrar Sessão</span>
					</div>
                    </div>
                </div>
                <div class="p-2"></div>
                <?php
                    //define sessão de cadastro de clientes
                    if(isset($_SESSION["cadastro_cliente"]) AND !empty($_SESSION["cadastro_cliente"])) {
                        echo $_SESSION["cadastro_cliente"];
                        //finaliza sessão
                        unset($_SESSION["cadastro_cliente"]);
                     }
                 ?>
                <hr class="bg-success">
            </hgroup>
        </header>
        <div class="p-1"></div>
        <section>
            <div class="container">
                <form name="cadastro_clientes" method="POST" action="insert_clientes.php">
                    <div class="form-row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="id_produto">Id</label>
                                <input type="number" name="id_cliente" class="form-control form-control-lg border border-info text-success" autocomplete="off" placeholder=" Id.. " id="id_cliente" required/>
                                <small class="text-info text-capitalize form-text">Informe o id do cliente.</small>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control form-control-lg border border-info text-success" autocomplete="off" placeholder=" Informe o Nome.. " id="nome" required/>
                                <small class="text-info text-capitalize form-text">Informe o nome do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="email">E-Mail</label>
                                <input type="email" name="email" class="form-control form-control-lg border border-info text-success" autocomplete="off" placeholder=" Informe o E-Mail.. " id="email" required/>
                                <small class="text-info text-capitalize form-text">Informe o E-Mail do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="telefone">Telefone</label>
                                <input type="tel" name="telefone" class="form-control form-control-lg border border-info text-success" auotcomplete="off" placeholder=" Informe o Telefone.. " id="telefone" required/>
                                <small class="text-info text-capitalize form-text">Informe o telefone do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="cpf">CPF</label>
                                <input type="text" name="cpf" class="form-control form-control-lg border border-info text-success" auotcomplete="off" placeholder=" Informe o CPF.. " id="cpf" required/>
                                <small class="text-info text-capitalize form-text">Informe o CPF do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="data_nascimento">Data de Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control form-control-lg border border-info text-success" auotcomplete="off" id="data_nascimento" required/>
                                <small class="text-info text-capitalize form-text">Informe a data de nascimento do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="endereco">Endereço</label>
                                <input type="text" name="endereco" class="form-control form-control-lg border border-info text-success" auotcomplete="off" placeholder=" Informe o Endereço.. " id="endereco" required/>
                                <small class="text-info text-capitalize form-text">Informe o endereço do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="bairro">Bairro</label>
                                <input type="text" name="bairro" class="form-control form-control-lg border border-info text-success" auotcomplete="off" placeholder=" Informe o Bairro.. " id="bairro" required/>
                                <small class="text-info text-capitalize form-text">Informe o Bairro do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="cidade">Cidade</label>
                                <input type="text" name="cidade" class="form-control form-control-lg border border-info text-success" auotcomplete="off" placeholder=" Informe a Cidade.. " id="cidade" required/>
                                <small class="text-info text-capitalize form-text">Informe a Cidade do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="estado_civil">Estado Civil</label>
                                <select name="estado_civil" class="form-control form-control-lg border border-info text-success" autocomplete="off" id="estado_civil" required>
                                    <option class="text-success" value="solteiro">Solteiro(a)</option>
                                    <option class="text-success" value="casado">Casado(a)</option>
                                    <option class="text-success" value="separado">Separado(a)</option>
                                    <option class="text-success" value="divorciado">Divorciado(a)</option>
                                    <option class="text-success" value="noivo">Noivo(a)</option>
                                </select>
                                <small class="text-info text-capitalize form-text">Informe o estado civil atual do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="sexo">Sexo</label>
                                <select name="sexo" class="form-control form-control-lg border border-info text-success" autocomplete="off" id="sexo" required>
                                    <option class="text-success" value="masulino">Masculino(a)</option>
                                    <option class="text-success" value="feminino">Feminino(a)</option>
                                    <option class="text-success" value="outros">Outros(a)</option>
                                </select>
                                <small class="text-info text-capitalize form-text">Informe o sexo do cliente corretamente.</small>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text text-warning text-capitalize" style="font-family:verdana;" for="estado_civil">Referencial</label>
                                <select name="referencial" class="form-control form-control-lg border border-info text-success" autocomplete="off" id="referencial" required>
                                    <option class="text-success" value="1">1</option>
                                    <option class="text-success" value="2">2</option>
                                    <option class="text-success" value="3">3</option>
                                    <option class="text-success" value="4">4</option>
                                </select>
                                <small class="text-info text-capitalize form-text">Informe o estado referencial do cliente corretamente.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-skin btn btn-success btn-lg m-1">Cadastrar Cliente</button>
                                <button type="reset" class="btn btn-skin btn btn-danger btn-lg m-1" data-toggle="modal" data-target="#ModalResetClientes">Resetar Dados</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </article>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>

    <div class='modal fade bd-example-modal-lg' id="ModalResetClientes" tabindex='-1' role='dialog' aria-labelledby="ResetarDadosForm" aria-hidden='true'><div class='modal-dialog modal-lg' role='document'>
    	<div class='modal-content'>
      		<div class='modal-header bg-light'>
        		<h5 class='modal-title text-primary text-capitalize lead' style='font-size:36px;' id="ResetarDadosForm">Resetar Dados</h5>
        		<button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
          			<span aria-hidden='true'>&times;</span>
        		</button>
      		</div>
      		<div class='modal-body'>
        		<p class='text text-danger' style='font-family:verdana;'>
        			Tem certeza de que deseja Resetar os Dados ?
				</p>
      		</div>
      		<div class='modal-footer'>
				<button type="reset" onclick="window.location.href='cadastrar_clientes.php'" class="btn btn-skin btn btn-danger btn-lg">Resetar Dados</button>
				<button type="button" class="btn btn-skin btn btn-secondary btn-lg" data-dismiss="modal">Fechar</button>
      		</div>
    	</div>
  	</div>
</body>
</html>