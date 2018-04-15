function overlayOn(value) {
    document.getElementById(value).style.display = "block";
}
        
function overlayOff(value) {
    document.getElementById(value).style.display = "none";
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

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function firearmTypes() {
    document.getElementById("firearmTypes").classList.toggle("show");
}

function quantityChoice() {
    document.getElementById("quantity").classList.toggle("show")
}

function setFirearmType(fireArm) {
    document.getElementById("firearmTypeBtn").innerHTML = fireArm;
}

function setQuantity(num) {
    if (num == 6) {
        document.getElementById("quantityBtn").innerHTML = "6+";
    } else {
        document.getElementById("quantityBtn").innerHTML = num;
    }
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
  if (event.target == document.getElementById('loginOverlay')) {
      loginOverlay.style.display = "none";
  }
} 
