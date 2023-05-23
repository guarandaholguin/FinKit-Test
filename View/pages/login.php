<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
		<!-- Latest compiled and minified CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="" />
		<link href="CSS/styleLogin.css" rel="stylesheet" type="text/css" />
		<title>Логин</title>
	</head>
	<body>
		<div class="container_" id="container">
			<div class="forms-container">
				<div class="signin-signup">
					<!--start session-->
					<form method="post" action="#" class="sign-in-form">
						<h2 class="title">Вход в систему</h2>
						<div class="input-field" id="grupo__ingemail">
							<i class="formulario__validacion-estado fas fa-envelope"></i>
							<input
								type="email"
								class="formulario__input"
								name="ingemail"
								id="ingemail"
								placeholder="Email"
							/>
						</div>
						<div class="input-field" id="grupo__ingpassword">
							<i class="formulario__validacion-estado fas fa-lock"></i>
							<input
								type="password"
								class="formulario__input"
								name="ingpassword"
								id="ingpassword"
								placeholder="Password"
							/>
						</div>
						<?php
						$ingreso = new LoginControl();
						$ingreso-> ControlIngreso();
						?>
						<button type="submit" class="btn solid">Login</button>
					</form>
					<!--End start session-->
					<!--REGISTER-->
					<form method="post" action="#" class="sign-up-form">
						<h2 class="title">Зарегистрироваться</h2>
						<div class="input-field" id="grupo__FIO">
							<i class="formulario__validacion-estado fas fa-user"></i>
							<input
								type="text"
								class="formulario__input"
								name="FIO"
								id="FIO"
								placeholder="ФИО"
								
							/>
						</div>
						<div class="input-field" id="grupo__Username">
							<i class="formulario__validacion-estado fas fa-user"></i>
							<input
								type="text"
								class="formulario__input"
								name="Username"
								id="Username"
								placeholder="Имя пользователя"
								
							/>
						</div>
						<div class="input-field" id="grupo__email">
							<i class="formulario__validacion-estado fas fa-envelope"></i>
							<input
								type="email"
								class="formulario__input"
								name="email"
								id="email"
								placeholder="Email"
								
							/>
						</div>
						<div class="input-field" id="grupo__password">
							<i class="formulario__validacion-estado fas fa-lock"></i>
							<input
								type="password"
								class="formulario__input"
								name="password"
								id="password"
								placeholder="Password"
							/>
						</div>
						<div class="input-field" id="grupo__password2">
							<i class="formulario__validacion-estado fas fa-lock"></i>
							<input
								type="password"
								class="formulario__input"
								name="password2"
								id="password2"
								placeholder="Repeat Password"
								
							/>
						</div>
						
						<?php
							$con=Conexion::conectar();
							$con->beginTransaction();
							$registro = LoginControl::ControlRegistro();
							if($registro == "ok"){
								echo '<script>
								if ( window.history.replaceState ) {
									window.history.replaceState( null, null, window.location.href );
								}
							</script>';
							echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
								<strong>Пользователь!</strong> был зарегистрирован....
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								</div>';

								$estudiante = UserControl::IngresarEstudiante($_SESSION["ID_sesion_usuario"]);
								if ($estudiante == "ok" && empty(error_get_last ( )))
								{
								$con->commit();
								}
							}else $con->rollBack();
							if ($registro=="error"){ 
							
							echo '<script>
								if ( window.history.replaceState ) {
									window.history.replaceState( null, null, window.location.href );
								}
							</script>';
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>ERROR:</strong> Вы должны заполнить все поля и без специальных символов...
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								</div>';
							}
						?>
						<button type="submit" class="btn">Sign up</button>
                        <div class="formulario__mensaje" id="formulario__mensaje">
							<p>
								<i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Пожалуйста, заполните форму правильно.
							</p>
						</div>
					</form>
					<!--End REGISTER-->
				</div>
			</div>

			<div class="panels-container">
				<div class="panel left-panel">
					<div class="content">
						<h3>Здесь новенький?</h3>
						<p>Используйте вашу электронную почту для регистрации</p>
						<button class="btn transparent" id="sign-up-btn">Sign up</button>
					</div>
					<img src="Image/log.svg" class="image" alt="" />
				</div>
				<div class="panel right-panel">
					<div class="content">
						<h3>Один из нас?</h3>
						<p>
							Чтобы оставаться на связи с нами, пожалуйста, войдите в систему с вашими личными
							данными
						</p>
						<button class="btn transparent" id="sign-in-btn">Sign in</button>
					</div>
					<img src="Image/register.svg" class="image" alt="" />
				</div>
			</div>
		</div>
		<!-- jQuery library -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <!-- Popper JS -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<!-- Latest compiled JavaScript -->
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="JS/login.js"></script>
	    <script type="text/javascript" src="JS/email.js"></script>
	</body>
</html>
