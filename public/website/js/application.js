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
  free_steps(action,1);   
});

twttr.events.bind('click', function(event) {console.log(event);});

FB.Event.subscribe('edge.create', fb_like_callback);
FB.Event.subscribe('edge.remove', fb_unlike_callback); 

function fb_like_callback(url, html_element) {
	 free_steps('activate',1);
}
function fb_unlike_callback(url, html_element) {
	  free_steps('deactivate',1);
}

function gplus_callback(data){ 
  action = data.state=="on" ? 'activate' : 'deactivate';
	free_steps(action,1);
}

function gplus_callback_share(data){ 

  free_steps('activate',2);
}

function free_steps(action, step){
  productId = $('[product-id]').attr('product-id');
  $.post(baseUrl+'/product/'+action+'-free/'+step, {id: productId}, function(data){
      $('#free_step1').removeClass('active');
      $('#free_step2').removeClass('active');
      $('#get_free').removeClass('btn-green').addClass('btn-disabled').prop('disabled', true);

      if(data.step1 && data.step2)
      {
        $('#free_step1').addClass('active');
        $('#free_step2').addClass('active');
        $('#get_free').removeClass('btn-disabled').addClass('btn-green').prop('disabled', false).text('STEPS COMPLETED, GET IT NOW');
      }
      else if(data.step1){
        $('#free_step1').addClass('active');
      }
      else if(data.step2){
        $('#free_step2').addClass('active');
      }
  });
}

$(document).on('click', '#get_free', function(){ 
  productId = $('[product-id]').attr('product-id');
  document.location.href=baseUrl+'/get-free/'+productId;
});
 