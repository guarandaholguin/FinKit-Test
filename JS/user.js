!(function ($) {
	'use strict';

	// Hero typed
	if ($('.typed').length) {
		var typed_strings = $('.typed').data('typed-items');
		typed_strings = typed_strings.split(',');
		new Typed('.typed', {
			strings: typed_strings,
			loop: true,
			typeSpeed: 100,
			backSpeed: 50,
			backDelay: 2000,
		});
	}

	// Smooth scroll for the navigation menu and links with .scrollto classes
	$(document).on('click', '.nav-menu a, .scrollto', function (e) {
		if (
			location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
			location.hostname == this.hostname
		) {
			e.preventDefault();
			var target = $(this.hash);
			if (target.length) {
				var scrollto = target.offset().top;

				$('html, body').animate(
					{
						scrollTop: scrollto,
					},
					1500,
					'easeInOutExpo'
				);

				if ($(this).parents('.nav-menu, .mobile-nav').length) {
					$('.nav-menu .active, .mobile-nav .active').removeClass('active');
					$(this).closest('li').addClass('active');
				}

				if ($('body').hasClass('mobile-nav-active')) {
					$('body').removeClass('mobile-nav-active');
					$('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
				}
				return false;
			}
		}
	});

	// Activate smooth scroll on page load with hash links in the url
	$(document).ready(function () {
		if (window.location.hash) {
			var initial_nav = window.location.hash;
			if ($(initial_nav).length) {
				var scrollto = $(initial_nav).offset().top;
				$('html, body').animate(
					{
						scrollTop: scrollto,
					},
					1500,
					'easeInOutExpo'
				);
			}
		}
		SelectDatosUsuario();
		SelectDatosPeticion();
	});

	$(document).on('click', '.mobile-nav-toggle', function (e) {
		$('body').toggleClass('mobile-nav-active');
		$('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
	});

	$(document).click(function (e) {
		var container = $('.mobile-nav-toggle');
		if (!container.is(e.target) && container.has(e.target).length === 0) {
			if ($('body').hasClass('mobile-nav-active')) {
				$('body').removeClass('mobile-nav-active');
				$('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
			}
		}
	});

	// Navigation active state on scroll
	var nav_sections = $('section');
	var main_nav = $('.nav-menu, .mobile-nav');

	$(window).on('scroll', function () {
		var cur_pos = $(this).scrollTop() + 200;

		nav_sections.each(function () {
			var top = $(this).offset().top,
				bottom = top + $(this).outerHeight();

			if (cur_pos >= top && cur_pos <= bottom) {
				if (cur_pos <= bottom) {
					main_nav.find('li').removeClass('active');
				}
				main_nav
					.find('a[href="#' + $(this).attr('id') + '"]')
					.parent('li')
					.addClass('active');
			}
			if (cur_pos < 300) {
				$('.nav-menu ul:first li:first').addClass('active');
			}
		});
	});

	// Back to top button
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.back-to-top').fadeIn('slow');
		} else {
			$('.back-to-top').fadeOut('slow');
		}
	});

	$('.back-to-top').click(function () {
		$('html, body').animate(
			{
				scrollTop: 0,
			},
			1500,
			'easeInOutExpo'
		);
		return false;
	});

	// jQuery counterUp
	$('[data-toggle="counter-up"]').counterUp({
		delay: 10,
		time: 1000,
	});

	// Skills section
	$('.skills-content').waypoint(
		function () {
			$('.progress .progress-bar').each(function () {
				$(this).css('width', $(this).attr('aria-valuenow') + '%');
			});
		},
		{
			offset: '80%',
		}
	);

	// Porfolio isotope and filter
	$(window).on('load', function () {
		var portfolioIsotope = $('.portfolio-container').isotope({
			itemSelector: '.portfolio-item',
			layoutMode: 'fitRows',
		});

		$('#portfolio-flters li').on('click', function () {
			$('#portfolio-flters li').removeClass('filter-active');
			$(this).addClass('filter-active');

			portfolioIsotope.isotope({
				filter: $(this).data('filter'),
			});
			aos_init();
		});

		// Initiate venobox (lightbox feature used in portofilo)
		$(document).ready(function () {
			$('.venobox').venobox();
		});
	});

	// Testimonials carousel (uses the Owl Carousel library)
	$('.testimonials-carousel').owlCarousel({
		autoplay: true,
		dots: true,
		loop: true,
		responsive: {
			0: {
				items: 1,
			},
			768: {
				items: 2,
			},
			900: {
				items: 3,
			},
		},
	});

	// Portfolio details carousel
	$('.portfolio-details-carousel').owlCarousel({
		autoplay: true,
		dots: true,
		loop: true,
		items: 1,
	});

	// Init AOS
	function aos_init() {
		AOS.init({
			duration: 1000,
			easing: 'ease-in-out-back',
			once: true,
		});
	}
	$(window).on('load', function () {
		aos_init();
	});
})(jQuery);

// Activar el MODAL datos personales
function datospersonales() {
	$('#datospersonales').modal('show');
}

// Activar el MODAL para la заявка
function openDogoborModal() {
	$('#modalDogobor').modal('show');
}

//Seleccionar foto de usuario
function triggerClick() {
	document.querySelector('#profileImage').click();
}

function displayImage(e) {
	if (e.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
		};
		reader.readAsDataURL(e.files[0]);
	}
}

function CambiarInfoUsuarios() {
	$('.alert').remove();
	var email = $('#email').val();
	var nombre = $('#Username').val();
	var token = $('#tokenUsuario').val();
	var inutFile = document.getElementById('profileImage');

	var datos = new FormData();

	datos.append('actualizarUsuario', '1');
	datos.append('email', email);
	datos.append('Username', nombre);
	datos.append('tokenUsuario', token);
	datos.append('profileImage', inutFile.files[0]);

	$.ajax({
		url: 'Ajax/login_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
	})
		.done(function (x) {
			var errmsg = '';
			if (x == 'ok') {
				if (window.history.replaceState) {
					window.history.replaceState(null, null, window.location.href);
					errmsg =
						'<div class="alert alert-primary alert-dismissible fade show"' +
						'role="alert">' +
						'<strong>Данные пользователя</strong> были обновлены..' +
						'<button type="button" class="close" data-dismiss="alert"' +
						'aria-label="Close">' +
						'<span aria-hidden="true">&times;</span></button></div>';
					SelectDatosUsuario();
				}
			} else {
				errmsg =
					'<div class="alert alert-danger alert-dismissible fade show"' +
					'role="alert">' +
					'<strong>ERROR:</strong> Вы должны заполнить все поля и без специальных символов...' +
					'<button type="button" class="close" data-dismiss="alert"' +
					'aria-label="Close">' +
					'<span aria-hidden="true">&times;</span></button></div>';
			}
			$('#error').html(errmsg);
		})
		.fail(function (e) {
			console.log(e.responseText);
		});
}

/*FORMULARIO PETECION*/
function CambiarInfoEstudiante() {
	$('.alert').remove();
	var fecha_de_nacimiento = $('#fecha_de_nacimiento').val();
	var direccion = $('#direccion').val();
	var fecha_de_nacimiento_info = $('fecha_de_nacimiento_info').html();
	var telefono_info = $('telefono_info').html();
	//var residencia_usuario = $('residencia_usuario').html();
	var telefono = $('#telefono').val();
	var instituto = $('#instituto').val();
	var cafedra = $('#cafedra').val();
	var tipo_educacion = $('#tipo_educacion').val();
	var forma_educacion = $('#forma_educacion').val();
	var curso = $('#curso').val();
	var grupo = $('#grupo').val();
	var promedio_academico = $('#promedio_academico').val();
	var numero_serie_pasaporte = $('#numero_serie_pasaporte').val();
	var emitido_por_quien = $('#emitido_por_quien').val();
	var fecha_emision = $('#fecha_emision').val();
	var snils = $('#snils').val();
	var parientes = $('#parientes').val();
	var telefono_pariente = $('#telefono_pariente').val();
	var genero = $('#genero_estudiante').val();

	var datos = new FormData();
	datos.append('actualizarEstudiante', '1');
	datos.append('fecha_de_nacimiento', fecha_de_nacimiento);
	datos.append('direccion', direccion);
	datos.append('fecha_de_nacimiento_info', fecha_de_nacimiento_info);
	datos.append('telefono_info', telefono_info);
	//datos.append('residencia_usuario', residencia_usuario);
	datos.append('telefono', telefono);
	datos.append('instituto', instituto);
	datos.append('cafedra', cafedra);
	datos.append('tipo_educacion', tipo_educacion);
	datos.append('forma_educacion', forma_educacion);
	datos.append('curso', curso);
	datos.append('grupo', grupo);
	datos.append('promedio_academico', promedio_academico);
	datos.append('numero_serie_pasaporte', numero_serie_pasaporte);
	datos.append('emitido_por_quien', emitido_por_quien);
	datos.append('fecha_emision', fecha_emision);
	datos.append('snils', snils);
	datos.append('parientes', parientes);
	datos.append('telefono_pariente', telefono_pariente);
	datos.append('genero_estudiante', genero);

	$.ajax({
		url: 'Ajax/user_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
	})
		.done(function (x) {
			console.log(x);
			var okmsg = '';
			if (x == 'ok') {
				if (window.history.replaceState) {
					window.history.replaceState(null, null, window.location.href);
					okmsg =
						'<div class="alert alert-primary alert-dismissible fade show"' +
						'role="alert">' +
						'<strong>Данные пользователя</strong> были обновлены..' +
						'<button type="button" class="close" data-dismiss="alert"' +
						'aria-label="Close">' +
						'<span aria-hidden="true">&times;</span></button></div>';
					SelectDatosPeticion();
				}
			} else {
				okmsg =
					'<div class="alert alert-danger alert-dismissible fade show"' +
					'role="alert">' +
					'<strong>ERROR:</strong> Вы должны заполнить все поля и без специальных символов...' +
					'<button type="button" class="close" data-dismiss="alert"' +
					'aria-label="Close">' +
					'<span aria-hidden="true">&times;</span></button></div>';
			}
			console.log(okmsg);
			$('#okmami').html(okmsg);
		})
		.fail(function (e) {
			console.log(e.responseText);
		});
}

/*Validar formulario*/
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	FIO: /^[а-яёА-ЯЁ\s]{1,40}$/,
	telefono: /^[0-9_.+-]{12}$/,
	fecha_de_nacimiento: /^.{10,10}$/,
	direccion: /^[а-яёА-ЯЁ\s0-9_.,+-]{10,100}$/,
	instituto: /^[а-яёА-ЯЁ\s]{30,100}$/,
	cafedra: /^[а-яёА-ЯЁ\s]{10,100}$/,
	tipo_educacion: /^[а-яёА-ЯЁ\s]{1,20}$/,
	forma_educacion: /^[а-яёА-ЯЁ\s]{1,10}$/,
	curso: /^[0-9]{1}$/,
	grupo: /^[а-яёА-ЯЁ\s0-9-]{7,15}$/,
	promedio_academico: /^[0-9_.,+-]{4,6}$/,
	numero_serie_pasaporte: /^[A-Za-z0-9_-]{8,20}$/,
	emitido_por_quien: /^[а-яёА-ЯЁ\s0-9_.,+-]{7,100}$/,
	fecha_emision: /^.{10,10}$/,
	snils: /^[0-9]{5,20}$/,
	parientes: /^[а-яёА-ЯЁ\s]{1,40}$/,
	telefono_pariente: /^[0-9_.+-]{12}$/,
	Username: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	password: /^[A-Za-z0-9_-]{8,20}$/,
};

const campos = {
	FIO: false,
	telefono: false,
	fecha_de_nacimiento: false,
	direccion: false,
	instituto: false,
	cafedra: false,
	tipo_educacion: false,
	forma_educacion: false,
	curso: false,
	promedio_academico: false,
	numero_serie_pasaporte: false,
	emitido_por_quien: false,
	fecha_emision: false,
	snils: false,
	parientes: false,
	telefono_pariente: false,
	Username: false,
	email: false,
	password: false,
	grupo: false,
};

const validarFormulario = (e) => {
	switch (e.target.name) {
		case 'FIO':
			validarCampo(expresiones.FIO, e.target, 'FIO');
			break;
		case 'telefono':
			validarCampo(expresiones.telefono, e.target, 'telefono');
			break;
		case 'fecha_de_nacimiento':
			validarCampo(expresiones.fecha_de_nacimiento, e.target, 'fecha_de_nacimiento');
			break;
		case 'direccion':
			validarCampo(expresiones.direccion, e.target, 'direccion');
			break;
		case 'instituto':
			validarCampo(expresiones.instituto, e.target, 'instituto');
			break;
		case 'cafedra':
			validarCampo(expresiones.cafedra, e.target, 'cafedra');
			break;
		case 'tipo_educacion':
			validarCampo(expresiones.tipo_educacion, e.target, 'tipo_educacion');
			break;
		case 'forma_educacion':
			validarCampo(expresiones.forma_educacion, e.target, 'forma_educacion');
			break;
		case 'curso':
			validarCampo(expresiones.curso, e.target, 'curso');
			break;
		case 'promedio_academico':
			validarCampo(expresiones.promedio_academico, e.target, 'promedio_academico');
			break;
		case 'numero_serie_pasaporte':
			validarCampo(expresiones.numero_serie_pasaporte, e.target, 'numero_serie_pasaporte');
			break;
		case 'emitido_por_quien':
			validarCampo(expresiones.emitido_por_quien, e.target, 'emitido_por_quien');
			break;
		case 'fecha_emision':
			validarCampo(expresiones.fecha_emision, e.target, 'fecha_emision');
			break;
		case 'snils':
			validarCampo(expresiones.snils, e.target, 'snils');
			break;
		case 'parientes':
			validarCampo(expresiones.parientes, e.target, 'parientes');
			break;
		case 'telefono_pariente':
			validarCampo(expresiones.telefono_pariente, e.target, 'telefono_pariente');
			break;

		case 'Username':
			validarCampo(expresiones.Username, e.target, 'Username');
			break;
		case 'email':
			validarCampo(expresiones.email, e.target, 'email');
			break;
		case 'password':
			validarCampo(expresiones.password, e.target, 'password');
			break;
		case 'grupo':
			validarCampo(expresiones.grupo, e.target, 'grupo');
			break;
	}
};

const validarCampo = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document
			.querySelector(`#grupo__${campo} .formulario__input-error`)
			.classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document
			.querySelector(`#grupo__${campo} .formulario__input-error`)
			.classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
};

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

function SelectDatosUsuario() {
	var datos = new FormData();
	datos.append('getUsuario', '1');

	$.ajax({
		url: 'Ajax/login_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
	})
		.done(function (x) {
			$('#Username').val(x['nombre']);
			$('#email').val(x['email']);
			$('#UserNameInfo').html(x['nombre']);
			$('#emailInfo').html(x['email']);
			$('#profileImage1').attr('src', x['profileImage_dir']);
			$('#profileImage2').attr('src', x['profileImage_dir']);
		})
		.fail(function (e) {
			console.log('error2');
		});
}

function SelectDatosPeticion() {
	var datos = new FormData();
	datos.append('getTabla', '1');

	$.ajax({
		url: 'Ajax/user_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
	})
		.done(function (x) {
			$('#fecha_de_nacimiento').val(x['fecha_de_nacimiento']);
			$('#telefono').val(x['telefono']);
			$('#fecha_de_nacimiento_info').html(x['fecha_de_nacimiento']);
			$('#telefono_info').html(x['telefono']);
			//$('#residencia_usuario').html(x['ID_residencia']);
			$('#direccion').val(x['direccion']);
			$('#numero_serie_pasaporte').val(x['numero_serie_pasaporte']);
			$('#emitido_por_quien').val(x['emitido_por_quien']);
			$('#fecha_emision').val(x['fecha_emision']);
			$('#snils').val(x['snils']);
			$('#parientes').val(x['parientes']);
			$('#telefono_pariente').val(x['telefono_pariente']);
			$('#instituto').val(x['instituto']);
			$('#cafedra').val(x['cafedra']);
			$('#tipo_educacion').val(x['tipo_educacion']);
			$('#forma_educacion').val(x['forma_educacion']);
			$('#curso').val(x['curso']);
			$('#grupo').val(x['grupo']);
			$('#promedio_academico').val(x['promedio_academico']);
			$('#genero_estudiante').val(x['ID_tipo_genero']);
		})
		.fail(function (e) {
			console.log('error');
		});
}

function ImprimirPeticion() {
	window.open('Ajax/user_ajax.php?getNaima=1,', '_blank');
}

function ImprimirDesalojo() {
	window.open('Ajax/user_ajax.php?getNaimo=1,', '_blank');
}

function showContrato(id_doc) {
	var datos = new FormData();
	datos.append('getUploadedDocDir', '1');
	datos.append('id_doc', id_doc);
	$.ajax({
		url: 'Ajax/user_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
	})
		.done(function (x) {
			console.log(x);
			x = x.trim();
			if (x != 'VACIO') {
				$('#vistaPreviaModal').modal('show');
				PDFObject.embed(x, '#vista_previa_doc', { height: '40rem' });
			}
		})
		.fail(function (e) {
			var msj = e.responseText;
			if (msj != 'VACIO') {
				$('#vistaPreviaModal').modal('show');
				PDFObject.embed(msj, '#vista_previa_doc', { height: '40rem' });
				console.log(msj);
			}
		});
}
