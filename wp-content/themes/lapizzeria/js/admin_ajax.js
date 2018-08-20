$ = jQuery.noConflict();

$(document).ready(function() {
	$('.delete_reservation').on('click', function(e) {
		e.preventDefault(); //JS method that will ignore the default action on the browser; in this case, the link won't be open (which is the default behavior of clicking on a link)
		var id = $(this).attr('data-reservation'); //$(this) refers to the element that was clicked on
		
		swal({
			title: 'Delete this reservation?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				//using AJAX in jQuery
				$.ajax({
					type: 'post',
					data: {
						'action': 'lapizzeria_delete_reservation',
						'id': id,
						'type': 'delete'
					},
					url: admin_ajax.ajaxurl,
					success: function(data) {
						var result = JSON.parse(data);
						if (result.response == 'success') {
							jQuery("[data-reservation='"+ result.id+"']").parent().parent().remove(); //parent().parent() = because the element a with attribute data-reservation is a child of a td and then a tr -> traversing a document
							swal(
							  'Reservation deleted!',
							  'Succes, the reservation was deleted!',
							  'success'
							)
						}
					}
					
				});	
			}
		});
		
		/*
		type: how the data will be passed. Can be 'post' or 'get'
		data: a JS object; 'action' is the function that will tell WP what data to retrieve and to make when the AJAX request is made; 'id' will tell the server which reservation we want to delete by passing the value of the id variable declared and initialized above; 'type' = delete because we want to delete a reservation
		url: the URL containing the AJAX file with the methods (specified in functions.php)
		success: runs code every time we make an AJAX call and will return the parameter "data" (from function()data) from the server; "data" is the JS object previosly defined, sent to the server via "post" (available in the type key value defined above)
		*/
	});
});