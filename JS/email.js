$('#email').change(function () {
	$('.alert').remove();
	var email = $(this).val();

	var datos = new FormData();
	datos.append('validarEmail', email);

	$.ajax({
		url: 'Ajax/email_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (respuesta) {
			if (respuesta) {
				$('#email').val('');

				$('#email').parent().after(`
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>ERROR:</strong> электронная почта уже существует.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
				`);
			}
		},
	});
});
