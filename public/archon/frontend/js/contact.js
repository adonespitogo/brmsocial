jQuery(document).ready(function(){

	$('.popular-customers li a').tooltip('hide'); //this code for making a tool tip for the thumbnails on the rightside bar

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


//Contact form
	$('#contactform').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
			$('#message').hide();
			$('#submit')
			.attr('disabled','disabled');

			$.post(action, { 
				name: $('#name').val(),
				email: $('#email').val(),
				comments: $('#comments').val(),
				subject: $('#subject').val(),
				verify: $('#verify').val()
			},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contactform #submit').attr('disabled',''); 
				//				if(data.match('success') != null) $('#contactform').slideUp('slow');

			}
		);
	});

	return false; 

});

});



//Map icons on contact page
function initialize() {
	var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(-33.9, 151.2),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [
		{stylers: [{ visibility: 'simplified' }]},
		{elementType: 'labels', stylers: [{ visibility: 'off' }]}
		]
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	var marker1 = new Marker({
		map: map,
		zIndex: 9,
		title: 'Gym',
		position:  new google.maps.LatLng(-33.890542, 151.274856),
		icon: {
			path: MAP_PIN,
			fillColor: '#0E77E9',
			fillOpacity: 1,
			strokeColor: '',
			strokeWeight: 0,
			scale: 1/2
		},
		label: '<i class="icon-gym"></i>'
	});

	var marker2 = new Marker({
		map: map,
		zIndex: 9,
		title: 'Parking',
		position:  new google.maps.LatLng(-33.923036, 151.259052),
		icon: {
			path: SQUARE_PIN,
			fillColor: '#0E77E9',
			fillOpacity: 1,
			strokeColor: '',
			strokeWeight: 0,
			scale: 1/2
		},
		label: '<i class="icon-parking"></i>'
	});

	var marker3 = new Marker({
		map: map,
		zIndex: 9,
		title: 'Cafe',
		position:  new google.maps.LatLng(-33.903036, 151.229052),
		icon: {
			path: SHEILD,
			fillColor: '#0E77E9',
			fillOpacity: 1,
			strokeColor: '',
			strokeWeight: 0,
			scale: 1/2
		},
		label: '<i class="icon-cafe"></i>'
	});

	var marker4 = new Marker({
		map: map,
		zIndex: 9,
		title: 'My office',
		position:  new google.maps.LatLng(-33.923036, 151.129052),
		icon: {
			path: ROUTE,
			fillColor: '#0E77E9',
			fillOpacity: 1,
			strokeColor: '',
			strokeWeight: 0,
			scale: 1/2
		},
		label: '<i class="icon-store"></i>'
	});
}

google.maps.event.addDomListener(window, 'load', initialize);