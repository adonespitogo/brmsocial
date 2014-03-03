$(document).ready(function() {
	
	$('.buyer_email').on('blur', function() {
		
		var email = $(this).val();
		if (isValidEmailAddress(email)) {
			$.post(base_url+'/cart/update-buyer-email', { 'email': email }, function() { });
		}else alert('Invalide email.');

	});

});

function removeItem(id) {

	$('.item-'+id).fadeOut();

	$.post(base_url + '/cart/delete', { id: id }, function() {});


}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};

