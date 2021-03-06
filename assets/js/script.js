if (slug_for_js == 'user_clock' || slug_for_js == 'user_clock_out') {
	var video = document.querySelector("#videoElement"),
		canvas = document.querySelector('#canvas'),
		context = canvas.getContext('2d');
	if (navigator.mediaDevices.getUserMedia) {
		navigator.mediaDevices.getUserMedia({
				video: true
			})
			.then(function (stream) {
				video.srcObject = stream;
			})
			.catch(function (err0r) {
				console.log("Something went wrong!");
			});
	}
	/*
	$('#capture-image').click(function () {
		if ($(this).text().replace(/\s/g, '') == 'CaptureImage') {
			context.drawImage(video, 0, 0, 1024, 768);
			$('.capture-container').html('<img src="" id="emp-img">');
			var img_elem = document.getElementById('emp-img');
			img_elem.setAttribute('src', canvas.toDataURL('image/jpeg'));
			$('#hidden-field').val(canvas.toDataURL('image/jpeg'));

			$(this).children('span').text('Capture Again');
			$('#btn-get-loc').removeClass('disabled');
			if (clock_in_time != '') {
				$('#emp-img').css({
					'width': '400px',
					'margin': '0 auto',
					'display': 'block'
				});
			}
		} else {
			$(this).children('span').text('Capture Image');
			location.reload();
		}
	});
	$('#btn-get-loc').click(function () {
		$('.btn-spinner').css('display', 'block');
		get_curr_loc();
	});

	$('#btn-clock-in').click(function () {
		$('#clock_form').submit();
	});
	*/


	$('#capture-image').click(function (event) {
		// alert(event);
		event.preventDefault();
		console.log($(this).text().replace(/\s/g, ''));
		if ($(this).text().replace(/\s/g, '') === 'CaptureImageandClockIn' || 
			$(this).text().replace(/\s/g, '') === 'CaptureImageandClockOut') {
			context.drawImage(video, 0, 0, 1024, 768);
			$('.capture-container').html('<img src="" id="emp-img">');
			var img_elem = document.getElementById('emp-img');
			img_elem.setAttribute('src', canvas.toDataURL('image/jpeg'));
			$('#hidden-field').val(canvas.toDataURL('image/jpeg'));

			$(this).children('span').text('Capture Again');
			$('#btn-get-loc').removeClass('disabled');
			if (clock_in_time != '') {
				$('#emp-img').css({
					'width': '400px',
					'margin': '0 auto',
					'display': 'block'
				});
			}
			$('.btn-spinner').css('display', 'block');
			get_curr_loc();
		} else {
			$(this).children('span').text('Capture Image');
			location.reload();
		}
	});
	// $('#btn-get-loc').click(function () {
	// 	$('.btn-spinner').css('display', 'block');
	// 	get_curr_loc();
	// });

	// $('#btn-clock-in').click(function () {
	// 	$('#clock_form').submit();
	// });
	//    function check_if_clock_in() {
	//        if (clock_in_time != '') {
	//
	//        }
	//    }
}
if (slug_for_js == 'user_clock_out') {
	// ------------------------------------------------------------------
	//                            Timer logic
	// ------------------------------------------------------------------
	var startDateTime = new Date(clock_in_time); // YYYY (M-1) D H m s ms (start time and date from DB)
	var startStamp = startDateTime.getTime();
	// console.log(clock_in_time);
	// console.log(server_time);
	// var newDate = new Date(server_time);
	// var newStamp = newDate.getTime();

	var timer; // for storing the interval (to stop or pause later if needed)
	// alert(base_url);
	var server_time;
	
	function updateClock() {
		$.ajax({
			method: 'GET',
			url: base_url+'/TimeClock/get_updated_time',
			success: function(response){
				server_time = response
				// $('#timer').text(d + h + m + +s + " s");
				// console.log(server_time);
				// newDate = new Date(server_time);
				// newStamp = newDate.getTime();
				// var diff = Math.round((newStamp - startStamp) / 1000);
		
				// var d = Math.floor(diff / (24 * 60 * 60)); /* though I hope she won't be working for consecutive days :) */
				// diff = diff - (d * 24 * 60 * 60);
				// var h = Math.floor(diff / (60 * 60));
				// diff = diff - (h * 60 * 60);
				// var m = Math.floor(diff / (60));
				// diff = diff - (m * 60);
				// var s = diff;
		
				// if (d == 0) {
				// 	d = '';
				// } else {
				// 	d = d + " D, ";
				// }
				// if (h == 0) {
				// 	h = '';
				// } else {
				// 	h = h + " H, ";
				// }
				// if (m == 0) {
				// 	m = '';
				// } else {
				// 	m = m + " m, ";
				// }
				// // document.getElementById("time-elapsed").innerHTML = d + " day(s), " + h + " hour(s), " + m + " minute(s), " + s + " second(s) working";
				// // console.log(d + " day(s), " + h + " hour(s), " + m + " minute(s), " + s + " second(s) working");
				// $('#timer').text(d + h + m + +s + " s");
			}
		});
		// console.log(server_time);
	}
	if (clock_in_time != '') {
		// timer = setInterval(updateClock, 1000);
		$('.btn-group-clock-in-out').css('display', 'block');
	} else {}
	// $('#btn-clock-out').click(function (event) {
	// 	event.preventDefault();
	// 	$('.btn-group-clock-in-out').css('display', 'block');
	// 	$(this).css('display', 'none');
	// 	$('#btn-clock-in').text('Clock Out');
	// });
}
//$('.btn-add-current-loc').click(function () {
//    $('.btn-spinner').css('display', 'block');
//    if (navigator.geolocation) {
//        navigator.geolocation.getCurrentPosition(showPosition);
//    } else {
//        x.innerHTML = "Geolocation is not supported by this browser.";
//    }
//});

function showPosition(position) {
	$('.btn-spinner').css('display', 'none');
	$('#btn-clock-in').removeClass('disabled');
	var lat = position.coords.latitude;
	var long = position.coords.longitude;
	$('#lat').val(lat);
	$('#long').val(long);
	if (slug_for_js === 'bulk_link') {
		$('#bulk-form').submit();
	}else{
		$('#clock_form').submit();
	}

	// $('#bulk-form').submit();	
}
$('#loading').modal('show');

function get_curr_loc() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
		// $('#clock_form').submit();
	} else {
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}
if (slug_for_js === 'bulk_link') {
	get_curr_loc();
}
$('#term-link-input').focus(function () {
	//    alert(slug_for_js);
	//    alert('working');
});


function initMap() {
	// var map = new google.maps.Map(document.getElementById('map'), {
	//     center: { lat: -33.8688, lng: 151.2195 },
	//     zoom: 13
	// });
	var map, infoWindow;
	map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: -34.397,
			lng: 150.644
		},
		zoom: 18
	});
	infoWindow = new google.maps.InfoWindow;

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			var pos = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			$('#lat').val(position.coords.latitude);
			$('#long').val(position.coords.longitude);
			infoWindow.setPosition(pos);
			infoWindow.setContent('Location found.');
			infoWindow.open(map);
			map.setCenter(pos);
		}, function () {
			handleLocationError(true, infoWindow, map.getCenter());
		});
	} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
	}
	var card = document.getElementById('pac-card');
	var input = document.getElementById('pac-input');
	var types = document.getElementById('type-selector');
	var strictBounds = document.getElementById('strict-bounds-selector');

	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

	var autocomplete = new google.maps.places.Autocomplete(input);

	// Bind the map's bounds (viewport) property to the autocomplete object,
	// so that the autocomplete requests use the current map bounds for the
	// bounds option in the request.
	autocomplete.bindTo('bounds', map);

	// Set the data fields to return when the user selects a place.
	autocomplete.setFields(
		['address_components', 'geometry', 'icon', 'name']);

	var infowindow = new google.maps.InfoWindow();
	var infowindowContent = document.getElementById('infowindow-content');
	infowindow.setContent(infowindowContent);
	var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29)
	});

	autocomplete.addListener('place_changed', function (event) {
		infowindow.close();
		marker.setVisible(false);
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			// User entered the name of a Place that was not suggested and
			// pressed the Enter key, or the Place Details request failed.
			window.alert("No details available for input: '" + place.name + "'");
			return;
		}

		// If the place has a geometry, then present it on a map.
		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			map.setCenter(place.geometry.location);
			map.setZoom(17); // Why 17? Because it looks good.
		}
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);

		var address = '';
		if (place.address_components) {
			address = [
				(place.address_components[0] && place.address_components[0].short_name || ''),
				(place.address_components[1] && place.address_components[1].short_name || ''),
				(place.address_components[2] && place.address_components[2].short_name || '')
			].join(' ');
		}
		$('#lat').val(place.geometry.location.lat());
		$('#long').val(place.geometry.location.lng());
		infowindowContent.children['place-icon'].src = place.icon;
		infowindowContent.children['place-name'].textContent = place.name;
		infowindowContent.children['place-address'].textContent = address;
		infowindow.open(map, marker);
	});

	// Sets a listener on a radio button to change the filter type on Places
	// Autocomplete.
	// function setupClickListener(id, types) {
	//     var radioButton = document.getElementById(id);
	//     radioButton.addEventListener('click', function() {
	//     autocomplete.setTypes(types);
	//     });
	// }

	// setupClickListener('changetype-all', []);
	// setupClickListener('changetype-address', ['address']);
	// setupClickListener('changetype-establishment', ['establishment']);
	// setupClickListener('changetype-geocode', ['geocode']);

	// document.getElementById('use-strict-bounds')
	//     .addEventListener('click', function() {
	//         console.log('Checkbox clicked! New state=' + this.checked);
	//         autocomplete.setOptions({strictBounds: this.checked});
	//     });
	var input = document.getElementById('pac-input');
	google.maps.event.addDomListener(input, 'keydown', function (event) {
		if (event.keyCode === 13) {
			event.preventDefault();
		}
	});
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	infoWindow.setPosition(pos);
	infoWindow.setContent(browserHasGeolocation ?
		'Error: The Geolocation service failed.' :
		'Error: Your browser doesn\'t support geolocation.');
	infoWindow.open(map);
}

// initMap();
// -----------------------------------------------------------------
//                      Popup script
// -----------------------------------------------------------------
$('.my-tooltip').hide();
$('.tooltip-marker').on('mouseover', function () {
	$(this).parent().children('.my-tooltip').show();
});
$('.tooltip-marker').on('mouseout', function () {
	$(this).parent().children('.my-tooltip').hide();
});

/*-----------------------------------------------------------------
			Delete the employee
-----------------------------------------------------------------*/
function delete_employee(id) {
	var form_action = emp_del_form_action + id;
	$('#delete-form').attr('action', form_action);
}

/*-----------------------------------------------------------------
			Delete terminal link
-----------------------------------------------------------------*/
function delete_terminal_link(id) {
	var form_action = delete_terminal_link_url + id;
	$('#delete-form').attr('action', form_action);
}

/* 
----------------------------------------------------------------------
				Salary select details
----------------------------------------------------------------------
*/
$('#select-salary-type').on('change', function () {
	// Store
	localStorage.setItem("salary_type", $(this).val());
	select_salary_type();
	//    console.log($('#select-salary-type').val());
});

function select_salary_type(value) {
	var salary_type = localStorage.getItem("salary_type");
	if (salary_type === 'wages') {
		$('#vages-inputs').css('display', 'block');
		$('#monthly_salary').val('');
		$('#daily_hours').val('');
		$('#leave_condition').val('');
	} else {
		$('#vages-inputs').css('display', 'none');
	}
	if (salary_type === 'monthly') {
		$('#monthly-inputs').css('display', 'block');
		$('#per_hour_price').val('');
	} else {
		$('#monthly-inputs').css('display', 'none');
	}
	$('#salary-type-option').val(localStorage.getItem("salary_type"));
	$('#salary-type-option').html(localStorage.getItem("salary_type")+ ' selected');
}
//alert(localStorage.getItem("salary_type"));
//$('#btn-submit').click(function(event){
//    event.preventDefault();
//    alert('working');
//    localStorage.clear('salary_type');
//});
select_salary_type();

//function delete_location(){
//    $('#btn-delete-url').attr('href', delete_url);
//}
function set_id_to_form() {

}

//------------------------------------------------------------------
//                      Delete location
//------------------------------------------------------------------
function delete_location(id) {
	var delete_location_url = base_url + 'terminal/location/delete/'
	var form_action = delete_location_url + id;
	$('#delete-form').attr('action', form_action);
}
$('#btn-delete-url').click(function () {
	$('#delete-form').submit();
});




// ----------------------------------------------------------------------
//                          Hourly Rate Chart
// ----------------------------------------------------------------------
// $('.table-hourly-chart tr:nth-child(2) th input').on('keyup', function(){
//     console.log($(this).val());
// });
function update_rate_chart_labels(table_class, index, input_value){
    $(table_class + ' tbody tr td:nth-child(' + parseInt(index + 2) + ') input').each(function (index1, input) {
        $(input).val(input_value);
        // console.log($(label).html());
    });
}

function hourly_rate_chart(table_class){
    $(table_class + ' tr:nth-child(2) th input').each(function(index, input){
        var input_value = $(input).val();
        update_rate_chart_labels(table_class, index, input_value);
        $(input).on('keyup', function(){
            input_value = $(input).val();
            update_rate_chart_labels(table_class, index, input_value);
        });
    });
}
hourly_rate_chart('.table-hourly-chart');
hourly_rate_chart('.table-hourly-chart1');


// alert(server_time);
var timestamp = 1;
// var dateString = server_time,
// 	dateTimeParts = dateString.split(' '),
// 	timeParts = dateTimeParts[1].split(':'),
// 	dateParts = dateTimeParts[0].split('-'),
// 	date;

// date = new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]);

// timestamp = date.getTime() + timestamp

// -----------------------------------------------------------------
// console.log(timestamp); //1379426880000
// function updateTime(){
// 	d = new Date(Date.UTC(timestamp));
// 	d.getSeconds(d.getSeconds() + 1);
// 	console.log(d.getHours() +':' + d.getMinutes() + ':' + d.getSeconds());
// 	// var timestamp = date.getTime(); 
// 	// console.log( Date(timestamp) );
// 	// timestamp++;
// }
// $(function(){
// 	setInterval(updateTime, 1000);
// });

// var usaTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Karachi"});
// usaTime = new Date(usaTime);
// console.log('USA time: '+usaTime.toLocaleString());
// date = new Date(timestamp);
// console.log(date);





/*
---------------------------------------------------------------------------------------
								Notice module logic
---------------------------------------------------------------------------------------
*/
$('#notice-form').on('submit', function(event){
	event.preventDefault();
	var form_data = $(this);
	// alert(custom_base_url);
	$.ajax({
		url: custom_base_url + 'Welcome/add_notice',
		type: 'POST',
		data: form_data.serialize(),
		dataType: 'json',
		success: function(response){
			if(response.success === true){
				window.location.href = base_url;
			}else{
				$('#name_error').html(response.errors.name);
				$('#desc_error').html(response.errors.description);
			}
			
		},
		error: function(){
			console.log('error');
		}
	});
});


function delete_notice() {
	$("#delete-form").submit();
}

function add_delete_id(id){
	$('#btn-delete-notice').attr('onclick', "delete_notice("+id+")");
	$('#delete-form').attr("action", custom_base_url + "Welcome/delete_notice/" + id );
}

function edit_notice(id){
	if($('#add-notice').hasClass() === 'active'){
		$('#add-notice').removeClass('active');
		$('#all-notices').addClass('active');
		$('#btn-add-new').parent().removeClass('active');
		$('#btn-all-notices').parent().addClass('active');
	}else{
		$('#add-notice').addClass('active');
		$('#all-notices').removeClass('active');
		$('#btn-all-notices').parent().removeClass('active');
		$('#btn-add-new').parent().addClass('active');
	}
	get_single_notice_data(id);
}

function get_single_notice_data(id){
	$.ajax({
		url: base_url + 'Welcome/get_single_notice/'+id,
		type: 'get',
		success: function(response){
			console.log(response);
			// $('#id').val(response.id);
			// $('#name').val(response.name);
			// $('#description').val(response.description);
		}
	});
}

/*
----------------------------------------------------------------
					Position filter
----------------------------------------------------------------
*/
function pos_filter(){
	var json_val = $('#filter').val();
	// alert(json_val);
	if(json_val != ''){
		var value = JSON.parse(json_val);
		// alert(value.id);
		localStorage.setItem("pos_filter", json_val);
		$.ajax({
			url: pos_filter_url + 'Bulkattendance/position_filter/' + value.id,
			type: 'get',
			success: function(response){
				if(response === 'true'){
					location.reload();
				}
			} 
		});
	}else{
		localStorage.setItem("pos_filter", "");
		pos_fil_curr_val();
		location.reload();
	}
}
function pos_fil_curr_val(){
	var filter_pos = localStorage.getItem('pos_filter');
	// alert(filter_pos);
	if(filter_pos == null || filter_pos == ""){
		$('#pos_filter_option').val("");
		$('#pos_filter_option').text("All positions selected");
	}else{
		filter_pos = JSON.parse(filter_pos);
		$('#pos_filter_option').val(filter_pos.id);
		$('#pos_filter_option').text(filter_pos.name + " selected");
	}
}
if(filter_status == true){
	// alert('working');
	pos_fil_curr_val();
}else{
}


/*
-------------------------------------------------------------------------------------------------
								Delete rate Card
-------------------------------------------------------------------------------------------------
*/
function delete_ratecard(id){
	var delete_url = delete_ratecard_url + id;
	var form_id = '#delete-form';
	$(form_id).attr('action', delete_url);
}
$('#delete-btn').click(function(){
	$(form_id).submit();
});