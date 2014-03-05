var baseUrl = $('base').attr('href');

$(document).on('click', '[data-toggle="comments"]', function(){
	$('#comments').goTo();
	return false;
});

(function($) {
    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'fast');
        return this; // for chaining...
    }
})(jQuery);

twttr.events.bind('follow', function (event) {
  action = event.type=='follow' ? 'activate' : 'deactivate';
  free_steps(action);   
});

FB.Event.subscribe('edge.create', fb_like_callback);
FB.Event.subscribe('edge.remove', fb_unlike_callback); 

function fb_like_callback(url, html_element) {
	 free_steps('activate');
}
function fb_unlike_callback(url, html_element) {
	  free_steps('deactivate');
}

function gplus_callback(data){
  action = data.state=="on" ? 'activate' : 'deactivate';
	free_steps(action);
}

function free_steps(action){
  productId = $('[product-id]').attr('product-id');
  if(action=='activate')
    $('#get_free').removeClass('btn-disabled').addClass('btn-green').prop( "disabled", false );
  else
    $('#get_free').removeClass('btn-green').addClass('btn-disabled').prop( "disabled", true );
  
  $.post(baseUrl+'/product/'+action+'-free', {id: productId});
}

$(document).on('click', '#get_free', function(){
  $.post(baseUrl+'/payment/purchase-free', {id: productId});
  alert('redirect to thank you page. Edit this code in application.js');
});