<?php
		//define sessão para login de usuario
		session_start();
		if(isset($_SESSION["usuario"]) AND !empty($_SESSION["usuario"])) {
			//echo $_SESSION["usuario"];
		}else {
			//redireciona usuario para pagina de login 
			header("Location:login.php");
			exit;
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Developer Roger Panosso</title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css"/>
	</head>
<body>
	<article>
		<header class="bg-light">
			<div class="container-fluid bg-light">
				<div class="row">
					<div class="col-lg-6 descricao bg-light">
						<div class="p-1"></div>
						<img src="imgs/php.jpg" class="img-responsive" height="60" title="PHP"/>
					</div>
					<div class="col-lg-6">
						<div class="p-1"></div>
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
  							<button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    							<span class="navbar-toggler-icon"></span>
  							</button>
							<div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    							<ul class="navbar-nav mr-auto">
      								<li class="nav-item active">
        								<a class="nav-link link-striped text text-primary my-1 linkHover efect" href="cadastrar_produtos.php">Cadastrar Produtos<span class="sr-only">(página atual)</span></a>
      								</li>
      								<li class="nav-item">
        								<a class="nav-link link-striped text text-primary my-1 linkHover efect" href="acessar_produtos.php">Acessar Produtos</a>
      								</li>
      								<li class="nav-item">
        								<a class="nav-link link-striped text text-primary my-1 linkHover efect" href="pendencias_produtos.php">Pendencias</a>
      								</li>
      								<li class="nav-item">
        								<a class="nav-link link-striped text text-primary my-1 linkHover efect dropdown-toggle" href="relatorios_produtos.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Clientes</a>
										<ul class="dropdown-menu text-center">
										<li class="nav-item">
											<a class="nav-link dropdown-item link-striped text-center text-info linkUser" title="Cadastrar Clientes" href="cadastrar_clientes.php">
      											Cadastrar Clientes
      										</a>
										</li>
										<li class="nav-item">
											<a class="nav-link dropdown-item link-striped text-center text-info linkUser" title="Cadastrar Clientes" href="acessar_clientes.php">
												Acessar Clientes
      										</a>
										</li>
									</ul>
      								</li>
   	 							</ul>
    							<form class="form-inline my-2 my-lg-0" name="search" method="POST" action="buscar_produtos.php">
      								<input class="form-control mr-sm-2 border border-info text-success" type="search" name="search" placeholder=" Search.. " aria-label="Pesquisar" id="search" required/>
      								<button class="btn btn-success my-2 my-sm-0" type="submit" title="Pesquisar">Pesquisar</button>
    							</form>
  							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		</header>
		<section>
			<div class="container-fluid background">
				<div class="p-3"></div>
				<div class="container">
					<div class="row">
						<div class="col-lg-4 text-center">
							<img src="imgs/user.png" width="42" class="img-responsive img-fluid" title="Usuário Logado"/>
							<span class="text text-success m-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-family:verdana;"><?php echo $_SESSION["usuario"];?></span>
							<ul class="dropdown-menu">
								<li class="nav-item">
        							<a class="nav-link dropdown-item link-striped text-info linkUser" title="Cadastrar Imagens" href="enviar_images.php">
        								Cadastrar Imagens
        							</a>
      							</li>
      							<li class="nav-item">
      								<a class="nav-link dropdown-item link-striped text-info linkUser" title="Excluir Imagens" href="deletar_images.php">
      									Deletar Imagens
      								</a>
      							</li>
      							<li class="nav-item">
      								<a class="nav-link dropdown-item link-striped text-info linkUser" title="Visualizar Backgrounds" href="images_backgrounds.php">
      									Visualizar Backgrounds
      								</a>
      							</li>
							</ul>
						</div>
						<div class="col-lg-4 text-center">
							<a class="nav-link-item link-striped alert-link" style="text-decoration:none;" title="Finalizar Sessão" href="sair.php">
								<img src="imgs/off.png" width="42" class="img-responsive img-fluid" title="Finalizar Sessão"/>
							</a>
							<span class="text text-success m-1" style="font-family:verdana;">Encerrar Sessão</span>
						</div>
						<div class="col-lg-4 text-center">
							<a class="nav-link-item link-striped alert-link" style="text-decoration:none;" title="Enviar E-Mails" href="enviar_emails.php">
								<img src="imgs/mensagem.png" width="42" class="img-responsive img-fluid" title="Enviar E-Mails"/>
							</a>
							<span class="text text-success m-1" style="font-family:verdana;">Enviar E-Mails</span>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-4 ajust text-center">
							<img src="imgs/orientacao_objetos01.png" class="img-fluid" title="Orientação a Objetos"/>
							<div class="p-1"></div>
							<div><strong class="text-warning" style="color:#3900FF; font-family:verdana;">Orientação a Objetos</strong></div>
							<div class="p-1"></div>
							<p class="text-light lead" style="color:#7954BA; font-family:verdana;  font-size:14px;">
								O PHP é uma linguagem multiparadigma<br/>
								podendo ser desenvolvida de maneira<br/>
								estruturada e Orientada a Objetos.<br/>
								A Orientação a Objetos é considerado<br/>
								o paradigma mais novo, e atualmente é<br/>
								o mais utilizado no desenvolvimento de<br/>
								aplicações Web.
							</p>
						</div>
						<div class="col-lg-4 ajust text-center">
							<img src="imgs/orientacao_objetos02.png" class="img-fluid" title="Reestruturação do Código"/>
							<div class="p-1"></div>
							<div><strong class="text-warning" style="color:#3900FF; font-family:verdana;">Reestruturação do Código</strong></div>
							<div class="p-1"></div>
							<p class="text-light lead" style="color:#7954BA; font-family:verdana; font-size:14px;">
								Utilizando o paradigma de desenvolvimento<br/>
								Orientado a Objetos é possivel reestruturar<br/>
								o código fonte, tornando-o mais legivel e<br/>
								modularizado permitindo que agrupemos<br/>
								funcionalidades em comun atra<br/>
								vés de objetos coesos.
							</p>
						</div>
						<div class="col-lg-4 ajust text-center">
							<img src="imgs/orientacao_objetos03.png" class="img-fluid" title="Visibilidade"/>
							<div class="p-1"></div>
							<div><strong class="text-warning" style="color:#3900FF; font-family:verdana;">Visibilidade</strong></div>
							<div class="p-1"></div>
							<p class="text-light lead" style="color:#7954BA; font-family:verdana; font-size:14px;">
								Utilizando o paradigma de desenvolvimento<br/>
								orientado a objetos, nos facilita obtermos<br/>
								uma melhor visibilidade, em procedimentos<br/>
								definidos ou pré-definidos na aplicação.<br/>
								Ou seja tornando o processo de novas fun<br/>
								cionalidades mais visiveis e acessiveis no<br/>
								escopo principal do programa.
							</p>
						</div>
					</div>
				</div>
				<div class="container text-center">
					<div class="p-5"></div>
						<div class="col-lg-12">
							<form name="visualizar" method="POST" action="#">
							<div class="form-group">
							<button type="button" style="padding:12px; color:#FFFFFF;" data-toggle="modal" data-target="#myModalDefinitionPoo" class=" btn btn-success btn-lg buttonAcess m-1"
							title="Sobre Orientação a Objetos">
								Sobre Orientação a Objetos
							</button>
							<button type="button" style="padding:12px; color:#FFFFFF;" data-toggle="modal" data-target="#myModalDefinition" class="btn btn-success btn-lg buttonAcess m-1"
							title="PHP Orientado a Objetos">
								PHP Orientado a Objetos
							</button>
						</div>
					</form>
					</div>
				</div>
				<div class="p-2"></div>
			</div>
			<div class="p-1 bg-success border"></div>
			<div class="container-fluid bg-dark altura">
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 					<div class="carousel-inner">
    					<div class="carousel-item active">
      						<img class="d-block w-100 altura" src="imgs/image01.jpg" alt="Primeiro Slide" title="Desenvolvimento Web"/>
    					</div>
    					<div class="carousel-item">
      						<img class="d-block w-100" src="imgs/image02.jpg" alt="Segundo Slide" title="Desenvolvimento Web">
    					</div>
    					<div class="carousel-item">
      						<img class="d-block w-100" src="imgs/image03.jpg" alt="Terceiro Slide" title="Desenvolvimento Web">
    					</div>
  					</div>
  					<a class="carousel-control-prev text text-success" href="#carouselExampleControls" role="button" data-slide="prev">
    					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    					<span class="sr-only">Anterior</span>
  					</a>
  					<a class="carousel-control-next text text-success" href="#carouselExampleControls" role="button" data-slide="next">
    					<span class="carousel-control-next-icon" aria-hidden="true"></span>
    					<span class="sr-only">Próximo</span>
  					</a>
				</div>
			</div>
			<div class="p-1 bg-success border"></div>
			<div class="container-fluid bg-warning">
				<div class="row">
					<div class="col-lg-6">
						<div class="p-3"></div>
						<h3 class="page-header lead" id="h3" style="color:#7954BA; font-size:30px;" >Seja Um Desenvolvedor de Suscesso !!</h3>
						<img src="imgs/programador.jpg" class="img-thumbnail img-responsive border border-success" height="300" title="Desenvolvimento Web"/>
						<div class="p-3"></div>
					</div>
					<div class="col-lg-6">
						<div class="p-3"></div>
						<h3 class="page-header lead" style="color:#7954BA; font-size:30px;" id="h3">Envie sua Mensagem</h3>
						<?php
							//define sessão de mensagem
							if(isset($_SESSION["mensagem"]) AND !empty($_SESSION["mensagem"])) {
								echo $_SESSION["mensagem"];
								//finaliza sessão
								unset($_SESSION["mensagem"]);
							}
						?>
						<form name="contato" method="POST" action="contato.php">
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="nome">Nome</label>
								<input type="text" name="nome" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe seu Nome" id="nome" required/>
							</div>
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="email">E-Mail</label>
								<input type="email" name="email" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe seu E-Mail " id="email" required/>
							</div>
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="telefone">Telefone</label>
								<input type="tel" name="fone" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe seu Telefone " id="telefone" required/>
							</div>
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="Endereço">Endereço</label>
								<input type="tel" name="endereco" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Informe seu Endereço " id="endereco" required/>
							</div>
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="assunto">Assunto</label>
								<select name="assunto" class="form-control form-control-lg border border-info" require>
									<option class="text text-success" value="desenvolvimentoweb">Desenvolvimento Web</option>
									<option class="text text-success" value="Linguagem php">Linguagem PHP</option>
									<option class="text text-success" value="orientacaoobjetos">Orientação a Objetos</option>
									<option class="text text-success" value="websites">Web sites</option>
									<option class="text text-success" value="websistemas">Web Sistemas</option>
								</select>
							</div>
							<div class="form-group">
								<label class="text-dark text-capitalize form-label" style="font-size:20px;" for="mensagem">Mensagem</label>
								<textarea name="mensagem" rows="5" class="form-control form-control-lg border border-info" autocomplete="off" placeholder=" Escreva sua Mensagem.. " id="mensagem"></textarea>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<button type="submit" style="padding:12px; color:#FFFFFF;" class=" btn btn-success btn-lg buttonAcess m-1"
									title="Enviar Mensagem">
										Enviar Mensagem
									</button>
									<button type="submit" style="padding:12px; color:#FFFFFF;" data-toggle="modal" data-target="#myModalForm" class=" btn btn-danger btn-lg buttonAcess m-1"
									title="Resetar Dados">
										Resetar dados
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="container-fluid bg-dark">
				<div class="row">
					<div class="col-lg-12">
						<header>
							<div class="p-3"></div>
							<h3 class="page-header text-center text-uppercase lead" style="color:#7954BA; font-size:32px;" id="h3">
								Materiais Recomendados
							</h3>
						</header>
					</div>
				</div>
			</div>
			<div class="container-fluid bg-dark">
				<div class="row">
					<div class="col-lg-4 text-center">
						<div class="p-3"></div>
						<img src="imgs/livro_php.jpg" class="img-thumbnail border border-success" title="Livro PHP Programando com Orientação a Objetos"/>
						<div class="p-2"></div>
						<div>
							<span class="text text-primary text-truncate" style="font-family:verdana;">
								Livro PHP programando com<br/> Orientação a Objetos
								<div class="p-1"></div>
								Pablo Dall'Oglio
								<div class="p-1"></div>
								<span class="text-capitalize text text-warning">4ª edição</span>
								<div class="p-1"></div>
									<a class="nav-link-item link-striped alert-link badge badge-success" style="padding:8px;" title="Amazon"
									href="https://www.amazon.com.br/Php-Programando-com-Orientação-Objetos/dp/8575226916/ref=sr_1_1?hvadid=71605822421196&hvbmt=be&hvdev=c&hvqmt=e&keywords=livro+php+orientado+a+objetos&qid=1584219438&sr=8-1">
										www.amazon.com.br
									</a>
								<div class="p-1"></div>
							</span>
						</div>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-3"></div>
						<img src="imgs/livro_php2.jpg" class="img-thumbnail border border-success" title="Livro PHP:Estruturado, Orientado a Objetos e Padrões de Projeto"/>
						<div class="p-2"></div>
						<div>
							<span class="text text-primary text-truncate" style="font-family:verdana;">
								Livro PHP:Estruturado, Orientado<br/>
								 a Objetos e Padrões de Projeto
								<div class="p-1"></div>
								Itamar Pena Nieradka
								<div class="p-1"></div>
								<span class="text-capitalize  text text-warning">1ª edição</span>
								<div class="p-1"></div>
									<a class="nav-link-item link-striped alert-link badge badge-success" style="padding:8px;" title="Amazon"
									href="https://www.amazon.com.br/PHP-Estruturado-orientado-objetos-padrões-ebook/dp/B077XLWPL6/ref=sr_1_2?hvadid=71605822421196&hvbmt=be&hvdev=c&hvqmt=e&keywords=livro+php+orientado+a+objetos&qid=1584221444&sr=8-2">
										www.amazon.com.br
									</a>
								<div class="p-1"></div>
							</span>
						</div>
						<div class="p-1"></div>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-3"></div>
						<img src="imgs/livro_php3.jpg" class="img-thumbnail border border-success" title="Livro PHP Construindo aplicações web com PHP e MySQL"/>
						<div class="p-2"></div>
						<div>
							<span class="text text-primary text-truncate" style="font-family:verdana;">
								Construindo aplicações web com<br/>
								PHP e MySQL
								<div class="p-1"></div>
								André Milani
								<div class="p-1"></div>
								<span class="text-capitalize  text text-warning">1ª edição</span>
								<div class="p-1"></div>
								<a class="nav-link-item link-striped alert-link badge badge-success" style="padding:8px;" title="Amazon"
									href="https://www.amazon.com.br/Construindo-Aplicações-Web-com-MYSQL/dp/8575225294/ref=sr_1_2?__mk_pt_BR=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=NYAQ569CZD5Y&keywords=livro+php&qid=1584310493&sprefix=livro+PHP%2Caps%2C506&sr=8-2">
										www.amazon.com.br
									</a>
								<div class="p-1"></div>
							</span>
						</div>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class="container-fluid bg-light">
				<div class="row">
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<p style="color:#7954BA; font-family:verdana; font-size:14px;">
							Created By Roger Panosso
						</p>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<p style="color:#7954BA; font-family:verdana; font-size:14px;">
							WebSites/WebSistemas
						</p>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<a class="nav-link-item link-striped alert-link" style="text-decoration:none;" title="Facebook" href="http://www.facebook.com/roger.panosso">
							<img src="imgs/facebook.png" class="img-responsive img-fluid" title="Facebook"/>
						</a>
						<a class="nav-link-item link-striped alert-link" style="text-decoration:none;" title="Instagram" href="http://www.instagram.com/roger.panosso">
							<img src="imgs/instagram.png" class="img-responsive img-fluid" title="Instagram"/>
						</a>
						<a class="nav-link-item link-striped alert-link" style="text-decoration:none;" title="Twitter" href="http://www.twitter.com/roger.panosso">
							<img src="imgs/twitter.png" class="img-responsive img-fluid" title="Twitter"/>
						</a>
						<img src="imgs/whatsapp.png" class="img-responsive img-fluid" title="Whatsapp (44) 99131-3841"/>
						<img src="imgs/email.png" class="img-responsive img-fluid" title="rogerpanosso@hotmail.com/rogerninopa@gmail.com"/>
					</div>
				</div>
			</div>
			<div class="container-fluid bg-light">
				<div class="row">
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<img src="imgs/copyright.png" width="14" class="img-responsive img-fluid" title="Copyright"/>
						<span style="color:#7954BA; font-family:verdana; font-size:14px;">
							Copyright Roger Panosso
						</span>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<span style="color:#7954BA; font-family:verdana; font-size:14px;">
							Todos os Direitos Reservados
						</span>
					</div>
					<div class="col-lg-4 text-center">
						<div class="p-2"></div>
						<span style="color:#7954BA; font-family:verdana; font-size:14px;">
							Created in Abr 15, 2020
						</span>
					</div>
					<div class="col-lg-12 text-center">
						<div class="p-2"></div>
						<button type="button" style="color:#FFFFFF;" class="btn btn-primary btn btn-skin btn-md buttonAcess" data-toggle="modal" data-target="#HistoryDeveloper">
							Developer Roger Panosso
						</button>
						<div class="p-1"></div>
					</div>
				</div>
			</div>
		</footer>
	</article>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"/></script>
	<script type="text/javascript" src="bootstrap/js/script.js"/></script>

	<!--modal Description Developer -->
	<div class="modal fade bd-example-modal-xl" id="HistoryDeveloper" tabindex="-1" role="dialog" aria-labelledby="DeveloperRogerPanosso" aria-hidden="true">
  		<div class="modal-dialog modal-xl" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-primary text-capitalize lead"  style="font-size:28px;" id="DeveloperRogerPanosso">Developer Roger Panosso</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body bg-light">
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12 text-center">
        						<img src="imgs/developer02.jpg" class=" img-thumbnail border border-success" title="Developer Roger Panosso"/>
  	      					</div>
        				</div>
        			</div>
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12 text-center">
        						<div class="p-2"></div>
        						<p style="color:#7954BA; font-family:verdana; font-size:14px;">
			        				Olá Sou Roger Panosso. Sou Estudante de Desenvolvimento Web há cinco anos, atualmente curso Graduação em Técnologia em Analise e Desenvolvimento de Sistemas. E trabalho com linguagens
			        				especificas para este fim como PHP, HTML, CSS e JAVASCRIPT bem como Frameworks especificos para desenvolvimento Web como Bootstrap(FrontEnd) e Laravel(BackEnd). Cujo intuito é realizar o planejamento, e desenvolvimento de WebSites e WebSistemas dinâmicos. Bem como trabalhar com dados
			        				provenientes e seguros através de interações com bancos de dados relacionais, como por exemplo o MySQL. Diante este processo atuo em desenvolvimento de projetos Web, oferecendo soluções 
			        				produtivas e capacitadas, para que seu negócio possa se expandir exponencialmente perante aplicações Web. Portanto o desenvolvimento de aplicações Web requer dinâmismo e facilidade para
			        				que você possa controlar seu negócio diariamente executando tarefas nescessárias visando sempre o crescimento profissional, bem como atraindo novos clientes e novos meios de comunicações.
			        				Para que este processo ocorra de maneira gradativamente eficaz é nescessario dedicar-se ao planejamento de seu próprio negócio, e sintetizar pontos positivos bem como as devidas soluções a
			        				serem implantadas para que seu projeto obtenha suscesso na Web. Não perca tempo e realize agora mesmo uma aplicação Web totalmente segura e dinâmica para seu negócio e alavanque ainda mais seu
			        				cresimento profissional no mercado.
        						</p>
        					</div>
        				</div>
        			</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-danger btn btn-skin btn-lg" data-dismiss="modal">Fechar</button>
      			</div>
    		</div>
  		</div>
	</div>

	<!--modal de definicao PHPOO-->
	<div class="modal fade bd-example-modal-xl" id="myModalDefinition" tabindex="-1" role="dialog" aria-labelledby="OrientacaoObjeto1" aria-hidden="true">
  		<div class="modal-dialog modal-xl" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-primary text-capitalize lead" style="font-size:28px;" id="OrientacaoObjeto1">PHP Orientado a Objetos</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body bg-light">
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12 lead">
        						<p style="color:#7954BA; font-family:verdana; font-size:14px;">
        							Ola sejá Bem Vindo. Como você pode ter analisado o PHP é uma
        							das linguagens server-side mais populares e utilizadas no âmbito de desenvolvimento
        							de aplicações Web. Seja um Website, Websistema, Lojas Virtuais e entre
        							outras diversas aplicações.

        							Dentre estas aplicações muito populares na Web utilizamos o paradigma
        							de desenvolvimento <i style="color:green;">Orientado a Objetos</i>,
        							que tem por finalidade nos auxiliar na construção destas aplicações
        							através de uma maneira totalmente modularizada e reestruturada.

        							Nos permitindo agrupar funcionalidades em comun para construir uma
        							aplicação que reuna estes elementos ou componentes nescessarios
        							através de <i style="color:green;">objetos coesos</i>, que nada mais
        							é do que uma entidade com um determinado comportamento especifico,
        							e que possui significados importantes para o software em si no mundo
        							real.

        							Sendo assim já conseguimos ter uma prévia visão de como este paradigma
        							póde nos auxiliar no desenvolvimento de uma aplicação Web complexa e
        							completa. Portanto para que este objetivo seja alcançado é nescessario
        							que estes objetos agrupem dados e comportamentos entre sí. E conversem
        							com outros objetos para realizar estas atividades nescessarias, tornando-se
        							parte de algo maior. Um <u style="color:green;">Sistema.</u>
        							<br/><br/>
        							<div class="row">
        								<div class="col-lg-12 text-center">
        									<img src="imgs/image_php.jpg" class="img-thumbnail img-fluid border border-info" height="300" title="PHP"/>
        								</div>
        							</div>
        						</p>
        					</div>
        				</div>
        			</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-danger btn btn-skin btn-lg" data-dismiss="modal">Fechar</button>
      			</div>
    		</div>
  		</div>
	</div>

	<!--modal de definicao POO-->
	<div class="modal fade bd-example-modal-xl" id="myModalDefinitionPoo" tabindex="-1" role="dialog" aria-labelledby="DefinitionPoo" aria-hidden="true">
  		<div class="modal-dialog modal-xl" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text-primary text-capitalize lead"  style="font-size:28px;" id="DefinitionPoo">Programação Orientada a Objetos</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body bg-light">
        			<div class="container">
        				<div class="row">
        					<div class="col-lg-12 lead">
        						<p style="color:#7954BA; font-family:verdana; font-size:14px;">
        							Á programação Orienta a Objetos é um paradigma de programação, que usa tipos dedos
        							personalizados. Portanto este paradigma é um dos mais difundidos e utilizados atualmente seja no âmbito Comercial, Ciêntifico e Acadêmico.

        							Este paradigma de desenvolvimento lida com conceitos e ópticas mais próximas do mundo
        							real, lidando com objetos que são estruturas que carregam dados sobre si ou propriedades
        							em comum sobre si. E um conjunto de comportamentos nescessarios(<U>Procedimentos</U>),
        							para atuar de maneira eficáz e produtiva sobre seus dados. Ou seja seus <u>Atributos</u>,
        							que sempre receberão requisições externas apartir dos comportamentos estabelecidos por
        							um objeto.

        							Sendo assim em vez de operarmos apenas com tipos de dados primitivos, podemos construir
        							novos tipos de dados, comforme nossa nescessidade.
        						</p>
        					</div>
        				</div>
        			</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-danger btn btn-skin btn-lg" data-dismiss="modal">Fechar</button>
      			</div>
    		</div>
  		</div>
	</div>

	<!--Modal de reset dados form-->
	<!-- Modal -->
	<div class="modal fade  bd-example-modal-lg" id="myModalForm" tabindex="-1" role="dialog" aria-labelledby="OrientacaoObjeto2" aria-hidden="true">
  		<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title text text-primary text-capitalize lead" id="OrientacaoObjeto2">Resetar Dados</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      		<div class="modal-body">
        		<p style="color:#7954BA; font-family:verdana; font-size:14px;">
        			Tem certeza de que deseja resetar os dados do Formulario ? 
        		</p>
      		</div>
      		<div class="modal-footer">
        		<button type="reset" class="btn btn-skin btn btn-success btn-lg" data-dismiss="modal">Não</button>
        		<button type="reset" onclick="window.location.href='index.php'" class="btn btn-skin btn btn-danger btn-lg">Sim</button>
      		</div>
    	</div>
  	</div>
</div>
</body>
</html>