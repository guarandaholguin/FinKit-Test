const sign_in_btn = document.querySelector('#sign-in-btn');
const sign_up_btn = document.querySelector('#sign-up-btn');
const container = document.getElementById('container');
const inputs = document.querySelectorAll('#container input');

sign_up_btn.addEventListener('click', () => {
	container.classList.add('sign-up-mode');
});

sign_in_btn.addEventListener('click', () => {
	container.classList.remove('sign-up-mode');
});
const expresiones = {
	FIO: /^[а-яёА-ЯЁ\s]{1,40}$/,
	Username: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
	password: /^[A-Za-z0-9_-]{8,20}$/,
	email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
};

const campos = {
	FIO: false,
	Username: false,
	email: false,
	password: false,
};

const VaLogin = (e) => {
	switch (e.target.name) {
		case 'FIO':
			var fio_input = e.target.value;
			if (
				fio_input.split(' ').length < 3 ||
				(fio_input.split(' ').length == 3 && fio_input.split(' ')[2] == '') ||
				!expresiones.FIO.test(fio_input)
			) {
				document.getElementById('grupo__FIO').classList.add('formulario__grupo-incorrecto');
				document.getElementById('grupo__FIO').classList.remove('formulario__grupo-correcto');
			} else {
				document.getElementById('grupo__FIO').classList.remove('formulario__grupo-incorrecto');
				document.getElementById('grupo__FIO').classList.add('formulario__grupo-correcto');
			}
			break;
		case 'Username':
			VaCampo(expresiones.Username, e.target, 'Username');
			break;
		case 'email':
			VaCampo(expresiones.email, e.target, 'email');
			break;
		case 'password':
			VaCampo(expresiones.password, e.target, 'password');
			break;
		case 'password2':
			VaPassword2();
			break;
		case 'ingemail':
			VaCampo(expresiones.email, e.target, 'ingemail');
			break;
		case 'ingpassword':
			VaCampo(expresiones.password, e.target, 'ingpassword');
			break;
	}
};

const VaCampo = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
	}
};

const VaPassword2 = () => {
	const inputPassword1 = document.getElementById('password');
	const inputPassword2 = document.getElementById('password2');

	if (inputPassword1.value !== inputPassword2.value) {
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-correcto');
		campos['password'] = false;
	} else {
		document.getElementById(`grupo__password2`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__password2`).classList.add('formulario__grupo-correcto');
		campos['password'] = true;
	}
};
inputs.forEach((input) => {
	input.addEventListener('keyup', VaLogin);
	input.addEventListener('blur', VaLogin);
});
