$('document').ready(function(){

	$('.inbox-mails ul li').click(function() {
		$('.message-body').html('<i class="fa mail-refresh fa-refresh fa-spin fa-3x"></i><br/>Please wait while we download the content');
		$('.inbox-mails > ul > li').removeClass('active');
		$(this).addClass('active');
		setTimeout(function() { $(".message-body").html('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');  }, 1000);
	});


	$('.inbox-mails li > h4 > span.option-icons > i.fa-circle, .inbox-mails li > h4 > span.option-icons > i.fa-star').click(function() {
		$(this).toggleClass('active');
	});

});