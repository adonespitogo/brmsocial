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
