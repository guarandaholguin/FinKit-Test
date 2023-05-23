<?php
session_start();
if(isset($_SESSION["id_roles_usuarios"])!= 1)
{
	echo '<script>window.location = "error";</script>';
	return;
}
elseif($_SESSION["id_roles_usuarios"]!= 1){
	echo '<script>window.location = "error";</script>';
	return;
}
elseif(!isset($_SESSION["FIO"])){
	echo '<script>window.location = "login";</script>';
	return;
}elseif($_SESSION["ValIngreso"] != "ok"){
	echo '<script>window.location = "login";</script>';
	return;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<title>Личный кабинет студента: <?php echo $_SESSION["FIO"];?></title>
		<meta content="" name="description" />
		<meta content="" name="keywords" />
		<!-- Google Fonts -->
		<link
			href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
			rel="stylesheet"
		/>
		<!--End Google Fonts -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
		/>
		<!--Assets CSS-->
		<link href="Assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="Assets/icofont/icofont.min.css" rel="stylesheet" />
		<link href="Assets/boxicons/css/boxicons.min.css" rel="stylesheet" />
		<link href="Assets/venobox/venobox.css" rel="stylesheet" />
		<link href="Assets/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet" />
		<link href="Assets/aos/aos.css" rel="stylesheet" />
		<!--End Assets CSS-->
		<!-- Template Main CSS File -->
		<link href="CSS/styleuser.css" rel="stylesheet" />
		<!-- End Template Main CSS File -->
		<!--Css bootstrap Fileinput -->
		<link href="CSS/bootstrap-fileinput-master/css/fileinput.css" rel="stylesheet" />
		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
			crossorigin="anonymous"
		/>
		<link
			href="CSS/bootstrap-fileinput-master/themes/explorer-fas/theme.css"
			rel="stylesheet"
		/>
		<!--End Css bootstrap Fileinput -->
	</head>
	<body>
		<!-- ======= Mobile nav toggle button ======= -->
		<button type="button" class="mobile-nav-toggle d-xl-none">
			<i class="icofont-navigation-menu"></i>
		</button>
		<!-- ======= Header ======= -->
		<header id="header">
			<div class="d-flex flex-column">
				<div class="profile">
					<input
						type="image"
						id="profileImage2"
						src="<?php 
							$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
							echo $usuarios["profileImage_dir"];?>"
						alt=""
						class="img-fluid rounded-circle"
					/>
					<h2 style="text-align: center" id="fio_usuario_menu" class="text-light">
						<?php echo $_SESSION["FIO"];?>
					</h2>
				</div>

				<nav class="nav-menu">
					<ul>
						<li class="active">
							<a href="#hero"><i class="bx bx-home"></i> <span>Главная</span></a>
						</li>
						<li>
							<a href="#about"><i class="bx bx-user"></i> <span>Персональнные данные</span></a>
						</li>
						<li>
							<a href="#services"><i class="bx bx-server"></i> Заявки</a>
						</li>
						<li>
							<a href="#contact"><i class="bx bxs-file-doc"></i> Контакты</a>
						</li>
						<li>
							<a href="close"><button type="button"><i class="bx bxs-exit"></i></button>Выход</a>
						</li>
					</ul>
				</nav>
				<!-- .nav-menu -->
				<button type="button" class="mobile-nav-toggle d-xl-none">
					<i class="icofont-navigation-menu"></i>
				</button>
			</div>
		</header>
		<!-- End Header -->

		<!-- ======= Hero Section ======= -->
		<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
			<div class="hero-container" data-aos="fade-in">
				<p>
					<span class="typed" data-typed-items="Добро пожаловать"></span>
				</p>
				<h1 id="fio_usuario_perfil"><?php echo $_SESSION["FIO"];?></h1>
			</div>
		</section>
		<!-- End Hero -->
        
		<main id="main">
			<!-- ======= About Section ======= -->
			<section id="about" class="about">
				<div class="container">
					<div class="row">
						<div class="col-lg-4" data-aos="fade-right">
							<input type="image" id="profileImage1" src="<?php 
										$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
										echo $usuarios["profileImage_dir"];
							?>" alt="" class="img-fluid" />
						</div>
						<div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
							<h3>ПЕРСОНАЛЬННЫЕ ДАННЫЕ ПОЛЬЗОВАТЕЛЯ</h3>
							<h3 style="font-style:italic" id="fio_usuario_info" > <?php echo $_SESSION["FIO"]?></h3>
							<div class="row">
								<div class="col-lg-9">
									<ul>
										<li>
											<i class="icofont-rounded-right"></i> <strong>Имя Пользователя:</strong>
											<p style="display: inline-block" id="UserNameInfo">
											<?php 
											$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
											echo $usuarios["nombre"];
											?>
											</p>
										</li>
										<li>
											<i class="icofont-rounded-right"></i> <strong>Почта:</strong>
											<p style="display: inline-block" id="emailInfo">
											<?php 
											$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
											echo $usuarios["email"];
											?>
											</p>
										</li>
										<li>
											<i class="icofont-rounded-right"></i> <strong>Телефон:</strong>
											<p style="display: inline-block" id="telefono_info">
												<?php 
												$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["telefono"];
												?>
											</p>
										</li>
										<li>
											<i class="icofont-rounded-right"></i> <strong>Дата рождения:</strong>
											<p style="display: inline-block" id="fecha_de_nacimiento_info">
											<?php 
											$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["fecha_de_nacimiento"]?>
											</p>
										</li>
									</ul>
								</div>
								<div class="col-lg-6">
									<ul></ul>
								</div>
								<div class="container">
					                <div class="row">
						                <div class="col-lg-3 col-md-6 icon-box" data-aos="fade-up">
							                <div class="text-center">
								                <button type="submit" 
												class="btn btn-outline-primary" onclick="datospersonales()">Редактировать</button>
							                </div>
						                </div>
					                </div>
				                </div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- MODAL -->
			<div class="modal" id="datospersonales" tabindex="-2" role="dialog" >
				<div class="modal-dialog modal-lg animate__pulse" role="document" style="animation-duration: 0.4s;">
					<div class="modal-content" style="animation-duration: 5s;">
					    <div class="modal-header">
						    <h5 class="modal-title">ПЕРСОНАЛЬННЫЕ ДАННЫЕ ПОЛЬЗОВАТЕЛЯ</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						    </button>
					    </div>
						<div class="modal-body">
							<div id="formulario" class="offset">
								<div class="container border" style="margin-bottom: 5%">
									<form
										method="post"
										class="needs-validation form-register"
										enctype="multipart/form-data"
										novalidate
										id="formulario"
									>
									<input type="hidden" value="<?php 
											$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
											echo $usuarios["token"];
									?>" name="tokenUsuario" id="tokenUsuario">
									    <div class="form-group text-center formulario__grupo-input">
								                <img src="<?php 
													$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
													echo $usuarios["profileImage_dir"];?>" onclick="triggerClick()"  id="profileDisplay" />
								                <label
									            for="profileImage"
									            style="color: black; font-size: 1rem; letter-spacing: 0.05rem">
									            Профильное изображение
									            </label>
								                <input
									            type="file"
									            name="profileImage"
												class="form-control formulario__input"
									            onchange="displayImage(this)"
									            id="profileImage"
									            style="display: none"
								                />
							            </div>
										<div class="form-row">
										<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__Username">
												<label for="Username" class="formulario__label">Имя пользователя</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
											            echo $usuarios["nombre"];?>"
													id="Username"
													name="Username"
													placeholder="Например: Jose Maria"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>
											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__email">
												<label for="email" class="formulario__label">Электронная почта</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
											            echo $usuarios["email"];?>"
													id="email"
													name="email"
													placeholder="Например:josemaria@mail.ru"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>
										</div>
										<input type="hidden" name="tokenUsuario" value="<?php $usuarios = LoginControl::ControlSelectRegistros("ID_sesion_usuario", $_SESSION["ID_sesion_usuario"]);
									    echo $usuarios["token"];?>">
										<div class="col-md-12 mb-4" style="margin-top: 1%">
												<div class="modal-footer">
													<div id="error">

													</div>
					                            	<button type="button" class="btn btn-primary" onclick="CambiarInfoUsuarios()">Сохранить</button>
					                            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					                            </div>
											</div>
									</form>
								</div>
							</div>
							<!--END FORM-->
					    </div>
					</div>
				</div>
			</div>
			<!-- FIN MODAL -->
			<!-- ======= Services Section ======= -->
			<section id="services" class="services">
				<div class="container">
					<div class="section-title">
						<h2>Заявки</h2>
						<p>Выберите вашу заявку.</p>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
							<div class="icon"><i class="icofont-file-document"></i></div>
							<h4 class="title"><a href="">Договор найма</a></h4>
							<div class="text-center">
								<button type="submit" class="btn btn-outline-primary" onclick="openDogoborModal();">Создать заявку</button>
								<button type="button" class="btn btn-outline-secondary" onclick="ImprimirPeticion()">Печать</button>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
							<div class="icon"><i class="icofont-not-allowed"></i></div>
							<h4 class="title"><a href="">Расторжение договора </a></h4>
							<div class="text-center">
								<button type="submit" class="btn btn-outline-primary" onclick="ImprimirDesalojo()">Печать</button>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- End Services Section -->
			<!-- ======= Contact Section ======= -->
			<section id="contact" class="contact">
				<div class="container">
					<div class="section-title">
						<h2>Контакты</h2>
					<div class="row" data-aos="fade-in" id="location">
					<div class="container">
					<div class="section-title">
					</div>
					</div>
						<div class="col-lg-5 d-flex align-items-stretch">
							<div class="info">
								<div class="address">
									<i class="icofont-google-map"></i>
									<h4>Местоположение:</h4>
									<p> г. Ростов-на-Дону, ул. Зорге, 21, общежитие N9Б, к.143<br/>г. Таганрог, Октябрьская площадь, 5, общежитие N1</p>
								</div>
								<div class="email">
									<i class="icofont-envelope"></i>
									<h4>Электронная почта:</h4>
									<p>campus@sfedu.ru</p>
								</div>
								<div class="phone">
									<i class="icofont-phone"></i>
									<h4>телефон:</h4>
									<p>8(863)211-03-73 <br/> 8(863)211-01-33</p>
									
								</div>
								<iframe
									src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2710.440980846269!2d38.93722996379261!3d47.20795317242328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40e3fd3b9450bc67%3A0x84d3dbae9a91c566!2sDormitory%20%E2%84%96%201%20SFedU!5e0!3m2!1ses-419!2sru!4v1619088258869!5m2!1ses-419!2sru"
									frameborder="0"
									style="border: 0; width: 100%; height: 290px"
									allowfullscreen
								></iframe>
							</div>
						</div>
						<div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
							<form action="forms/contact.php" method="post" role="form" class="php-email-form">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="name">Ваше Имя</label>
										<input
											type="text"
											name="name"
											class="form-control"
											id="name"
											data-rule="minlen:4"
											data-msg="⚠️ Пожалуйста, введите данные!..."
										/>
										<div class="validate"></div>
									</div>
									<div class="form-group col-md-6">
										<label for="name">Ваш электронный адрес</label>
										<input
											type="email"
											class="form-control"
											name="email"
											
											data-rule="email"
											data-msg="⚠️ Пожалуйста, введите данные!..."
										/>
										<div class="validate"></div>
									</div>
								</div>
								<div class="form-group">
									<label for="name">Тема</label>
									<input
										type="text"
										class="form-control"
										name="subject"
										id="subject"
										data-rule="minlen:4"
										data-msg="⚠️ Пожалуйста, введите данные!..."
									/>
									<div class="validate"></div>
								</div>
								<div class="form-group">
									<label for="name">Сообщение</label>
									<textarea
										class="form-control"
										name="message"
										rows="10"
										data-rule="required"
										data-msg="⚠️ Пожалуйста, введите данные!..."
									></textarea>
									<div class="validate"></div>
								</div>
								<div class="mb-3">
									<div class="loading">Loading</div>
									<div class="error-message"></div>
									<div class="sent-message">Your message has been sent. Thank you!</div>
								</div>
								<div class="text-center"><button type="button"  class="btn btn-outline-danger">Отправить</button>
							</form>
						</div>
					</div>
				</div>
			</section>
			<!-- MODAL -->
			<div class="modal" id="vistaPreviaModal" tabindex="-2" role="dialog">
				<div class="modal-dialog modal-lg" style = "height:100%;" role="document">
					<div class="modal-content">
					    <div class="modal-header">
						    <h5 class="modal-title">ПРЕДВАРИТЕЛЬНЫЙ ПРОСМОТР ДОКУМЕНТА</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						    </button>
					    </div>
						<div class="modal-body">
							<div id="formulario" class="offset">
								<div class="container border" style="margin-bottom: 5%">
									<div id="vista_previa_doc" ></div>
								</div>
							</div>
							<!--END FORM-->
					    </div>
					</div>
				</div>
			</div>
			<!-- FIN MODAL -->
			<!-- MODAL -->
			<div class="modal" id="modalDogobor" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-xl  animate__pulse" style="animation-duration: 0.4s;" role="document">
					<div class="modal-content">
					    <div class="modal-header">
						    <h5 class="modal-title">ЛИЧНЫЕ ДАННЫЕ СТУДЕНТА</h5>
						    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						    </button>
					        </div>
					<div class="modal-body">
						<!--FORM-->
							<div id="formulario" class="offset">
								<div class="container border" style="margin-bottom: 5%">
									<form
										method="post"
										class="needs-validation form-register"
										enctype="multipart/form-data"
										novalidate
										id="formulario"
									>
										<div class="form-row"> 
										<!-- Grupo: FIO -->
											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__ID_tipo_genero">
												<label for="ID_tipo_genero" class="formulario__label">Пол</label>
												<div class="formulario__grupo-input">
													<select class="form-select form-control" 
													aria-label="Default select example"  id="genero_estudiante">
													<?php
													$respuesta = UserControl::UserControlSeleccionarTipoGenero();
													$html = '';
													foreach($respuesta as $res)
													{
														$html.='<option value="'.$res["ID_tipo_genero"].'">'.$res["genero"].'</option>';
													}
													echo $html;
													?>
												
												</select>
												<!--<input
													type="text"
													class="form-control formulario__input"
													id="FIO"
													name="FIO"
													placeholder="Например: Гладской Владислав Александрович"
													required
												/>-->
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>	
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>
										<!-- END Grupo: Nombre -->
											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__fecha_de_nacimiento">
												<label for="fecha_de_nacimiento" class="formulario__label">Дата рождения</label>
												<div class="formulario__grupo-input">
												<div class="input-group date fj_date">
													<input
														type="text"
														class="form-control formulario__input datepicker"
														value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["fecha_de_nacimiento"]?>"
														id="fecha_de_nacimiento"
														name="fecha_de_nacimiento"
														placeholder="Например: 1998-01-26"
														required
													/>
													<i class="formulario__validacion-estado fas fa-times-circle"></i>
													<span class="input-group-addon"
														><i class="glyphicon glyphicon-calendar"></i
													></span>
												</div>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__telefono">
												<label for="telefono" class="formulario__label">Номер телефона</label>
												<div class="formulario__grupo-input">
												<input
													type="tel"
													pattern="[+]7[0-9]{10}"
													maxlength="12"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["telefono"]?>"
													id="telefono"
													name="telefono"
													placeholder="Например: +7 918 571-74-41"
													value="+7"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__direccion">
												<label for="direccion" class="formulario__label">Адрес по прописке</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["direccion"]?>"
													id="direccion"
													name="direccion"
													placeholder="Например: ул. Дзержинского 144-3, подъезд 4, этаж 1, кв 52"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<!--COSAS QUE NO VAN EN EL USER-->
											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__instituto">
												<label for="instituto" class="formulario__label">Институт</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["instituto"]?>"
													id="instituto"
													name="instituto"
													placeholder="Например: Институт компьютерных технологий и информационной безопасности"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__cafedra">
												<label for="cafedra" class="formulario__label">Кафедра</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["cafedra"]?>"
													id="cafedra"
													name="cafedra"
													placeholder="Например: Кафедра систем автоматизированного проектирования"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__tipo_educacion">
												<label for="tipo_educacion" class="formulario__label">Тип обучения</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["tipo_educacion"]?>"
													id="tipo_educacion"
													name="tipo_educacion"
													placeholder="Например: Бакалавриат"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
												
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__forma_educacion">
												<label for="forma_educacion" class="formulario__label">Форма обучения</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["forma_educacion"]?>"
													id="forma_educacion"
													name="forma_educacion"
													placeholder="Например: Очная"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__curso">
												<label for="curso" class="formulario__label">Курс</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["curso"]?>"
													id="curso"
													name="curso"
													placeholder="Например: 1"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
												
											</div>

											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__grupo">
												<label for="grupo" class="formulario__label">Группа</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["grupo"]?>"
													id="grupo"
													name="grupo"
													placeholder="Например: КТбо4-5"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
												
											</div>

											<div class="col-md-4 mb-4" style="margin-top: 1%" id="grupo__promedio_academico">
												<label for="promedio_academico" class="formulario__label">Средняя успеваемость</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["promedio_academico"]?>"
													id="promedio_academico"
													name="promedio_academico"
													placeholder="Например: 87.05"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>
											<!--END COSAS QUE NO VAN EN EL USER-->

											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__numero_serie_pasaporte">
												<label for="numero_serie_pasaporte" class="formulario__label">Номер серии паспорта</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["numero_serie_pasaporte"]?>"
													id="numero_serie_pasaporte"
													name="numero_serie_pasaporte"
													placeholder="Например: 52 0022196"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-12 mb-4" style="margin-top: 1%" id="grupo__emitido_por_quien">
												<label for="emitido_por_quien" class="formulario__label">Паспорст Кем выдан</label>
												<div class="formulario__grupo-input">
													<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["emitido_por_quien"]?>"
													id="emitido_por_quien"
													name="emitido_por_quien"
													placeholder="Например: Отделом УфМС России по Ростовской области в Ворошиловском районе г.Ростова-на-Дону"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__fecha_emision">
												<label for="fecha_emision" class="formulario__label">Дата выдачи паспорта</label>
												<div class="formulario__grupo-input">
												<div class="input-group date fj_date2">
													<input
														type="text"
														class="form-control formulario__input"
														value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["fecha_emision"]?>"
														id="fecha_emision"
														name="fecha_emision"
														placeholder="Ejemplo: 2021-04-23"
														required
													/>
													<i class="formulario__validacion-estado fas fa-times-circle"></i>
													<span class="input-group-addon"
														><i class="glyphicon glyphicon-calendar"></i
													></span>
												</div>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__snils">
												<label for="snils" class="formulario__label">Снилс</label>
												<div class="formulario__grupo-input">
													<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["snils"]?>"
													id="snils"
													name="snils"
													placeholder="Например: 123-456-789-01"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__parientes">
												<label for="parientes" class="formulario__label">Представитель</label>
												<div class="formulario__grupo-input">
												<input
													type="text"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["parientes"]?>"
													id="parientes"
													name="parientes"
													placeholder="Например: Лукоянов Роман Денисович"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>

											<div class="col-md-6 mb-3" style="margin-top: 1%" id="grupo__telefono_pariente">
												<label for="telefono_pariente" class="formulario__label">Номер телефона представителя</label>
												<div class="formulario__grupo-input">
												<input
													type="tel"
													pattern="[+]7[0-9]{10}"
													maxlength="12"
													class="form-control formulario__input"
													value="<?php 
														$estudiante = UserControl::UserControlSeleccionar("ID_sesion_usuario",$_SESSION["ID_sesion_usuario"]);echo $estudiante["telefono_pariente"]?>"
													id="telefono_pariente"
													name="telefono_pariente"
													placeholder="Например: +7 918 571-74-41"
													value="+7"
													required
												/>
												<i class="formulario__validacion-estado fas fa-times-circle"></i>
												</div>
												<div class="formulario__input-error "> ⚠️ Пожалуйста, введите данные!...</div>
											</div>
											<div class="col-md-12 mb-4" style="margin-top: 1%">
												<div class="modal-footer">
					                                <div id="okmami">

													</div>
					                            	<button type="button" class="btn btn-primary" onclick="CambiarInfoEstudiante()">Сохранить</button>
					                            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
					                            </div>
											</div>
									</form>
								</div>
							</div>
							<!--END FORM-->
					    </div>
					</div>
				</div>
			</div>
			<!-- FIN MODAL -->
			<!-- End Contact Section -->
		</main>
		<!-- End #main -->
		<!-- ======= Footer ======= -->
		<footer id="footer">
			<div class="container"></div>
		</footer>
		<!-- End  Footer -->
		<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
		<!-- Assets JS Files -->
		<script src="Assets/jquery/jquery.min.js"></script>
        <!-- jQuery library -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <!-- Popper JS -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="Assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="Assets/jquery.easing/jquery.easing.min.js"></script>
		<script src="Assets/waypoints/jquery.waypoints.min.js"></script>
		<script src="Assets/counterup/counterup.min.js"></script>
		<script src="Assets/isotope-layout/isotope.pkgd.min.js"></script>
		<script src="Assets/venobox/venobox.min.js"></script>
		<script src="Assets/owl.carousel/owl.carousel.min.js"></script>
		<script src="Assets/typed.js/typed.min.js"></script>
		<script src="Assets/aos/aos.js"></script>
		<!-- End Assets JS Files -->
		<script type="text/javascript" src="JS/AboutPDF.min.js"></script>
		<!--END DataPicker JS-->
		<!-- Template Main JS File -->
		<script src="JS/user.js?0.17"></script>
		<script src="JS/email.js"></script>
	</body>
</html>
