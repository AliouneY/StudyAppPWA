var inputWasClicked = mapWasClicked = false;

$(window).click(function(e)
{   
    handleMap();
});

$("button[name='cancel']").click(function(e)
{
    e.preventDefault();
    window.location.href = '../pages/home.php';
});

$(".locationInput").click(function(e)
{
    inputWasClicked = mapWasClicked = true;
    $("#map").css({'display':'block'});
});

function handleMap()
{
    console.log("inputWasClicked: " + inputWasClicked + " mapWasClicked: " + mapWasClicked);
    if(inputWasClicked)
    {
        if(!mapWasClicked)
        {
            $('#map').css({'display':'none'});
            inputWasClicked = mapWasClicked = false;
        }
        mapWasClicked = false;
    }
}

/*function setMap()
{*/
    var map;                                                                //this function works...clean it up later...
    var locationInput = document.getElementById('location');
		  
		  function initMap() // callback function
		  {
			map = new google.maps.Map(document.getElementById('map'), {
																		center: {lat: 33.418950, lng: -111.934539},
																		zoom: 18
																	  });
																	  
			var geocoder = new google.maps.Geocoder();
			
			map.setOptions({draggableCursor: 'default'});
			
			/* The following event listener makes it so that when the user clicks, we add a marker, get that location, reverse geocode it, and put it in the location input*/
			google.maps.event.addListener(map, 'click', function(event) 
			                                            {
                                                            mapWasClicked = true;
															updateLocation({lat:event.latLng.lat(), lng:event.latLng.lng()}); 
															var coord = {lat:event.latLng.lat(), lng:event.latLng.lng()};
															
															geocoder.geocode({'location':coord}, function(results, status)
																								{
																									console.log(status + " " + event.latLng.lat() + ", " + event.latLng.lng());
																									if(status === 'OK')
																									{
																										if(results[0])
																										{
																											if(results[0].formatted_address == null)
																											{
																												locationInput.value = event.latLng.lat() + ", " + event.latLng.lng();
																											}
																											
																											else
																											{
																												locationInput.value = results[0].formatted_address;
																											}
																										}
																										
																										else
																										{
																											console.log("No results");
																										}
																									}
																									else
																									{
																										console.log("Failed due to " + status);
																										locationInput.value = event.latLng.lat() + ", " + event.latLng.lng();
																									}
																								});
                                                               
														});			
			//new script here (this comment is for debugging purposes)
			
			/*locationInput.onkeypress = function(e)
												 {
													 var key = e.keyCode;
													 if(key == 13)
													 {
														 geocoder.geocode({'address': locationInput.value}, function(results, status)
																										   {
																											   if(status === 'OK')
																											   {
																												   if(results[0])
																												   {
																														map.setCenter(results[0].geometry.location);
																														updateLocation(results[0].geometry.location);
																												   }
																												   
																											   }
																											   
																											   else
																											   {
																												   console.log("Failed due to " + status);
																												   locationInput.value = "Sorry, server failure. Do file a complaint and we'll fix it as fast as we can...";
																											   }
																										   });
																										   
														 e.preventDefault();
													 }
												 }*/

			var markers = new Array();
			
			function updateLocation(coord)
			{
				var marker = new google.maps.Marker({position:coord, map:map});
				markers.push(marker);
				
				if(markers.length > 1)
				{
					markers[0].setMap(null);					//setMap places the marker on a map whose name goes in the parenthesis. Here we are saying set the map to nothing (MAKE THE MARKER DISAPPEAR)
					markers[0] = markers[1];
					markers.pop();
				}
			}
		  }
//}