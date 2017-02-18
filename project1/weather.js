var api_key = "0feb1bb908107b575b9dacb8ca07b808";

function domReady(){
    var displayBtn = document.getElementsByClassName('btn')[1];
    displayBtn.addEventListener('click', function(event){
        event.preventDefault();
        console.log("button clicked");
        var city = encodeURI(document.getElementById("form-input").value);
        updateWeatherDetails(city);
    });
    var clearBtn = document.getElementsByClassName('btn')[0];
    clearBtn.addEventListener('click', function(){
        event.preventDefault();
        clear();
    });
}

function sendRequest (url) {
    console.log("entering : "+api_key);
    var xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Accept","application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log("success");
            json = JSON.parse(this.responseText);
            var visibility = json.main.visibility;
            if(!visibility){
                var clouds = json.clouds.all;
                if(clouds >= 0 && clouds <= 50){
                    visibility = "Visble";
                } else if (clouds > 50 && clouds <= 80){
                    visibility = "Partially Visible";
                } else {
                    visibility = "Not Visible";
                }
            }
            document.getElementById("weather-panel").classList.remove("hide"); 
            createRow('Coordinates', formatCoords(json.coord.lat,json.coord.lon));
            createRow('Sunrise Time',formatTime(json.sys.sunrise));
            createRow('Sunset Time',formatTime(json.sys.sunset));
            createRow('Pressure', json.main.pressure + " hPa");
            createRow('Humidity', json.main.humidity + "%");
            createRow('Temperature', formatTemperature(json.main.temp));
            createRow('Minimum Temperature', formatTemperature(json.main.temp_min));
            createRow('Maximum Temperature', formatTemperature(json.main.temp_max));
            createRow('Clouds',json.clouds.all + "%");
            createRow('Wind Speed',json.wind.speed + " meter/sec");
            createRow('Wind Degree',json.wind.deg + String.fromCharCode("176"));
            createRow('Weather Description',json.weather[0].description);
            createRow('Sea Level',json.main.sea_level + " hPa");
            createRow('Ground Level',json.main.grnd_level + " hPa");
            createRow('Visibility', visibility);
            loadTemperaturePanel(json.weather[0].icon, json.main.temp, json.weather[0].description);
            displayAdviceForUser(json.weather[0].id);
        }
    };
    xhr.send(null);
}

function clear(){
    console.log("clear");
    document.getElementById("weather-panel").classList.add("hide");
    document.getElementById("form-input").value = "";
}

function updateWeatherDetails(city){
    document.getElementById('city').innerHTML = decodeURI(city).toUpperCase();
    document.getElementById("weather-info").innerHTML = "";
    var url = "proxy.php?q="+city+"&appid="+api_key+"&format=json"+"&units=imperial";
    sendRequest(url);
}

function createRow(key, value){
    var row = "<tr><td>"+key+"</td><td>"+value+"</td></tr>";
    var weatherDetailsNode = document.getElementById("weather-info");
    weatherDetailsNode.innerHTML += row;
}

function formatTime(GMTTimestamp, mode){
    var date = new Date(GMTTimestamp*1000);
    return date.getHours()+":"+date.getMinutes();
}

function formatCoords(lat, long){
    var linkText = "[" + lat + "," + long + "]";
    var redirectUrl = "https://www.google.com/maps/@"+lat+","+long+",14.77z";
    document.getElementById('morelink').href = "https://weather.com/weather/today/l/"+lat+","+long;
    return "<a target='_blank' href='"+redirectUrl+"'>"+linkText+"</a>";
}

function formatTemperature(temperature){
    return temperature + String.fromCharCode("176") + "F";
}

function loadTemperaturePanel(icon, temp, desc){
    var img = "<img width='150px' src='http://openweathermap.org/img/w/"+icon+".png'/>";
    var degree = "<figcaption>"+temp + String.fromCharCode("176")+ " ( "+desc.toUpperCase()+" )</figcaption>";
    document.getElementById("weather-image").innerHTML = "<figure>"+img + degree +"</figure>";
}

function displayAdviceForUser(weathercode){
    console.log("weathercode = "+weathercode);
    var advice = "";
    var msgType = "";
    if(weathercode >= 200 && weathercode <= 232){
        advice = "Thunderstorm : Stay right where you are!";
        msgType = "alert-danger";
    }
    else if(weathercode >= 300 && weathercode <= 321){
        advice = "Drizzling : You can go out but you might expect a rain soon!";
        msgType = "alert-info";
    }
    else if(weathercode >= 500 && weathercode <= 531){
        advice = "Raining : Take an umbrella and/or rain coat!";
        msgType = "alert-warning";
    }
    else if(weathercode >= 600 && weathercode <= 622 || weathercode == 903){
        advice = "Snow : Oops! You will freeze if you forget your winter jacket";
        msgType = "alert-warning";
    }
    else if(weathercode == 800){
        advice = "It's a clear sky out there. No issues. Perfect weather :)";
        msgType = "alert-success";
    }
    else if(weathercode > 800 && weathercode < 805){
        advice = "It's cloudy. There is a possibility for rain. Nothing to worry otherwise :)";
        msgType = "alert-success";
    }
    else if(weathercode == 904){
        advice = "Extremely hot outside. Protect your skin and eyes if you need to go out";
        msgType = "alert-danger";
    }
    else if(weathercode > 900){
        advice = "Extremely bad weather. Stay inside home and keep watching news!";
        msgType = "alert-danger";
    }

    document.getElementById('advice-msg').innerHTML = advice;
    document.getElementById('advice-msg').classList.add(msgType);

}