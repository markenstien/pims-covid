$( document ).ready( function(e) {



	


	if( $("#id_comparison") )
	{
		const COMPARE_TO_FIELD = $("#id_comparison");

		if( COMPARE_TO_FIELD.val() == 'between' )
		{
			showBetweenItems();
		} else{
			hideBetweenItems();
		}

		COMPARE_TO_FIELD.change( function(e) {

			let target = $(this).data('target');
			let value = $(this).val();


			switch(value)
			{
				case 'between':
					$("input[name='compare_to']").parent().parent().hide();
					$("input[name='start_number']").parent().parent().show();
					$("input[name='end_number']").parent().parent().show();
				break;

				default:
					$("input[name='compare_to']").parent().parent().show();
					$("input[name='start_number']").parent().parent().hide();
					$("input[name='end_number']").parent().parent().hide();
			}
		});


		function hideBetweenItems()
		{
			$("input[name='compare_to']").parent().parent().show();
			$("input[name='start_number']").parent().parent().hide();
			$("input[name='end_number']").parent().parent().hide();
		}

		function showBetweenItems()
		{
			$("input[name='compare_to']").parent().parent().hide();
			$("input[name='start_number']").parent().parent().show();
			$("input[name='end_number']").parent().parent().show();
		}
	}
});