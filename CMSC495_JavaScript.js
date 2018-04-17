function overlayOn(value) {
    document.getElementById(value).style.display = "block";
}
        
function overlayOff(value) {
    document.getElementById(value).style.display = "none";
}

function addFirearm(additionalFirearm) {
    var toggleFirearm = document.getElementsByClassName(additionalFirearm);
    
    for(var i = 0; i < toggleFirearm.length; i++) {
        toggleFirearm[i].style.display = "block";
    }
}

function removeFirearm() {
    var remFirearm2 = document.getElementsByClassName('firearm2');
    var remFirearm3 = document.getElementsByClassName('firearm3');
    var remFirearm4 = document.getElementsByClassName('firearm4');

    
    for(var i = 0; i < remFirearm2.length; i++) {
        remFirearm2[i].style.display = "none";
    }
    for(var i = 0; i < remFirearm3.length; i++) {
        remFirearm3[i].style.display = "none";
    }
    for(var i = 0; i < remFirearm4.length; i++) {
        remFirearm4[i].style.display = "none";
    }
}

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: {lat: 42.3, lng: -97.6}
    });
    var geocoder = new google.maps.Geocoder();
    document.getElementById('search').addEventListener('click', function() {
        geocodeAddress(geocoder, map);
    });
}

function geocodeAddress(geocoder, resultsMap) {
    var address = document.getElementById('zip').value;
    geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            resultsMap.setZoom(11.5);
        } else {
            alert('No results found');
//Debug     alert('Error:' + status);
        }
    });
}

function setFirearmType(firearmNum, firearmType) {
    document.getElementById(firearmNum).innerHTML = firearmType;
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (event.target == document.getElementById('loginOverlay')) {
        loginOverlay.style.display = "none";
    }
    
} 
