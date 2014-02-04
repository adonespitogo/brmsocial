
// jQuery $('document').ready(); function
$('document').ready(function(){

    // Calling LayerSlider on your selected element after the document loaded
		$('#layerslider').layerSlider({
							skinsPath : 'layerslider/skins/',
							skin : 'carousel',
							thumbnailNavigation : 'hover',
							hoverPrevNext : true,
 							navButtons : false,
							navStartStop : false,
							responsive : true,
							autoPlayVideos : false,
							responsiveUnder : 960,
							sublayerContainer : 960
						});

					

	// tabs on about us page
		$('.nav-tabs a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
});


$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    itemWidth: 210,
    itemMargin: 5
  });
});


jQuery(document).ready(function() {
		
		//testimonials
		$('.testimonials').carousel({
			slider: '.slider',
			slide: '.slide',
			slideHed: '.slidehed',
			nextSlide : '.next',
			prevSlide : '.prev',
			addPagination: false,
			addNav : false
		});

		
	//Twitter api, Please replace username in the following line with your username
	$.getJSON('twitter.php?url='+encodeURIComponent('statuses/user_timeline.json?screen_name=tweetatvijay&count=3&include_rts=false&exclude_replies=true'), function(tweets){
		$("#tweet").html(tz_format_twitter(tweets));
		setTimeout(function(){
			$('.slidewrap').carousel({
				slider: '.slider',
				slide: '.slide',
				addNav: false,
				addPagination: false,
				speed: 300 // ms.
			})
			},200);
		}); 
	});

	// THE FANCYBOX PLUGIN INITALISATION
	jQuery(".fancybox").fancybox();


//Portfolio page jquery code
jQuery(document).ready(function() {
	
	jQuery('#home_latest_projects').showbizpro({
		dragAndScroll:"off",
		visibleElementsArray:[4,3,2,1],
		carousel:"off",
		entrySizeOffset:0,
		allEntryAtOnce:"off"
	});


	jQuery('#example2').showbizpro({
		dragAndScroll:"on",
		visibleElementsArray:[3,3,2,1],
		carousel:"off",
		entrySizeOffset:0,
		allEntryAtOnce:"off",
		ytMarkup:"<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1'></iframe>",
		vimeoMarkup:"<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
	});

})
jQuery('#example5').showbizpro({
	dragAndScroll:"off",
	visibleElementsArray:[3,2,1,1],
	carousel:"off",
	ytMarkup:"<iframe src='http://www.youtube.com/embed/%%videoid%%?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0&amp;autoplay=1'></iframe>",
	vimeoMarkup:"<iframe src='http://player.vimeo.com/video/%%videoid%%?title=0&amp;byline=0&amp;portrait=0;api=1&amp;autoplay=1'></iframe>",
	closeOtherOverlays:"on",
	allEntryAtOnce:"on",
	mediaMaxHeight:[450,300,340,260],

});
