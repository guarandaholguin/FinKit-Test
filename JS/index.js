const hamburger = document.querySelector('.Menu .nav-bar .nav-list .hamburger');
const mobile_menu = document.querySelector('.Menu .nav-bar .nav-list ul');
const menu_item = document.querySelectorAll('.Menu .nav-bar .nav-list ul li a');
const Menu = document.querySelector('.Menu.contenedor');

hamburger.addEventListener('click', () => {
	hamburger.classList.toggle('active');
	mobile_menu.classList.toggle('active');
});

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY;
	if (scroll_position > 250) {
		Menu.style.backgroundColor = '#29323c';
	} else {
		Menu.style.backgroundColor = 'transparent';
	}
});

menu_item.forEach((item) => {
	item.addEventListener('click', () => {
		hamburger.classList.toggle('active');
		mobile_menu.classList.toggle('active');
	});
});
