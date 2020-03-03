$(document).ready(function(){

	$('.deleting').on('click', function() {
		var clickedElement = $(this);
		$.ajax({
			url: 'ajax.php?action=del&item_id=' + $(this).attr("attr-id"),
			success: function( cont ) {
				if ( cont == 'deleted' ) {
					clickedElement.parent().parent().hide("fast", function(){});					
				}
			}
		});
	});

	$('.editing').on('click', function() {
		var item_id = $(this).attr("attr-id");

		var item_name = $( '#id-' + item_id + ' > h3').text();
		var item_descr = $( '#id-' + item_id + ' p.item_descr').text();
		var item_author = $( '#id-' + item_id + ' p.item_author').text();

		$('.modal input[name = "item_name"]').val( item_name );
		$('.modal textarea[name = "item_descr"]').text( item_descr );
		$('.modal input[name = "item_author"]').val( item_author );
		$('.modal').attr( "attr_id", item_id );

		$('.modal').show("fast", function(){});
	});		

	$('.modal input[name = "submit"]').on('click', function() {
		var modalObj = $(this).parent().parent();

		var item_id = modalObj.attr( 'attr_id' );
		var new_item_name = modalObj.find( 'input[name = "item_name"]' ).val();
		var new_item_descr = modalObj.find( 'textarea[name = "item_descr"]' ).val();
		var new_item_author = modalObj.find( 'input[name = "item_author"]' ).val();

		//alert( item_id + ' : ' + new_item_name + ' : ' + new_item_descr + ' : ' + new_item_author);
		
		$.ajax({
			url: 'ajax.php?action=edit&item_id=' + item_id + '&item_name=' + new_item_name + '&item_descr=' + new_item_descr + '&item_author=' + new_item_author,
			success: function( cont ) {
				if ( cont == 'edited' ) {
					modalObj.hide("fast", function(){});
					$( '#id-' + item_id + ' > h3').text( new_item_name );
					$( '#id-' + item_id + ' p.item_descr').text( new_item_descr );
					$( '#id-' + item_id + ' p.item_author').text( new_item_author );
				}
				else {
					alert( cont );
				}
			}
		});
	});
});
