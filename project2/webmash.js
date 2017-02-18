// Geoname API Username
var username = "ganesht";
// Request object used to make ajax calls to Geoname API
var request = new XMLHttpRequest();

/* initMap() which initiates map to a location */
function initMap() {
	//initialize map
    var lat = 32.75;
    var lng = -97.13;
    var centerposition = {
        lat: lat,
        lng: lng
    };
    var zoomLevel = 17; 
    var mapDiv = document.getElementById('map');
	var map = new google.maps.Map(mapDiv, {
        zoom: zoomLevel,
        center: centerposition
    });
    window.map = map;

	//Initialize a mouse click event on map which then calls reversegeocode function
    map.addListener('click', function(event){
        // Get the clicked position
        var latitude = event.latLng.lat();
        var longitude = event.latLng.lng();
        window.position = {
            lat: latitude,
            lng: longitude
        };
        // Call the reverse geocoding to get the address of the clicked point
        reversegeocode();
    });
}

/* Reserse Geocoding */
function reversegeocode() {
    //get the latitude and longitude from the mouse click and get the address.
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({location: position}, function(results){
        console.log("results = ",results);
        var markerPopup = document.getElementById('markerPopup');
        // Check for the invalid address
        if(results && results.length>0){
            markerPopup.innerHTML = results[0].formatted_address;
            document.getElementById('message').innerHTML = "";
        } else{
            // Don't do anything. Just show a message to the user
            document.getElementById('message').innerHTML = "Invalid Address. You clicked on ocean probably! <br/>";
        }
    });
    //call geoname api asynchronously to get the weather details 
    sendRequest();
}

/* Display the address and weather on the display text area */
function displayResult () {
    if (request.readyState == 4) {
        xml = request.responseXML.documentElement;
        var address = document.getElementById('markerPopup').innerHTML;
        var observation = xml.getElementsByTagName('observation');
        console.log("observation = ",observation);
        // Check for absence of weather information
        if(observation && observation.length>0){
            // Extract temperature, windspeed and clouds and construct markup to be shown
            var temperature = xml.getElementsByTagName("temperature")[0].innerHTML;
            var windspeed = xml.getElementsByTagName("windSpeed")[0].innerHTML;
            var clouds = xml.getElementsByTagName("clouds")[0].innerHTML;
            var weatherHtml = "<table><tr><td>Address</td><td>"+address+"</td></tr><tr><td>Temperature</td><td>"+temperature+"</td></tr>"+
                         "<tr><td>Wind Speed</td><td>"+windspeed+"</td></tr>"+
                         "<tr><td>Clouds</td><td>"+clouds+"</td></tr></table>";
            document.getElementById("weatherLog").innerHTML += "<hr/>"+weatherHtml;
            // Create new marker for the current location
            addOverlayMarker(weatherHtml);
        } else{
            // Don't do anything. Just show a message to the user
            document.getElementById('message').innerHTML += "No weather information for this location!!";
        }
    }
}

/* Sends asynchronous request to Geoname API to get the weather details */
function sendRequest () {
    request.onreadystatechange = displayResult;
    request.open("GET", "http://api.geonames.org/findNearByWeatherXML?lat="+position.lat+"&lng="+position.lng+"&username="+username);
    request.send(null);
}

/* Clears the previous marker and add new marker with a given content */
function addOverlayMarker(content){
    var infoWindow = new google.maps.InfoWindow();
    // Clear the previous marker
    if(window.marker)
        window.marker.setMap(null);
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });
    // Clear the message
    document.getElementById('message').innerHTML = "";
    window.marker = marker;
    infoWindow.setContent(content);
    infoWindow.open(map, marker);
}

/* 
    Triggered on click of Clear Log button
    Clears the Weather Log and Message
    Map will still display the latest marker
*/
function clearLog(){
    document.getElementById("weatherLog").innerHTML = "";
    document.getElementById("message").innerHTML = "Nothing to show. Click on a map to see address and weather details.";
}