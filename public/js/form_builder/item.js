$( document ).ready( function(e) {

	if( $('#id_type') )
	{
	
		const TYPE_FIELD = $('#id_type');

		if( TYPE_FIELD.val() != 'dropdown') {
			toggleOptionItemField('none');
		}


		TYPE_FIELD.change( function(e) {

			let target = $(this).data('target');
			let value = $(this).val();

			if( value == 'dropdown'){
				toggleOptionItemField('show');
			}else{
				toggleOptionItemField('none');
			}
		});

		function toggleOptionItemField( display )
		{
			if( display == 'none')
			{
				$("#id-options").parent().parent().hide();
			}else{
				$("#id-options").parent().parent().show();
			}

		}
	}

});