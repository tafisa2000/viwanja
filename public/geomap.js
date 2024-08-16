var map;
var mapcanvas;

let coordinates = [];

function initMap() {
    var location = new google.maps.LatLng(51.5074, 0.1278);
    mapOptions = {
        center: location,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    map = new google.maps.Map(document.getElementById("plots-map"), mapOptions);
}
