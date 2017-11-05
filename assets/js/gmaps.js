function initMap() {
    var myLatLng = {lat: 46.470892, lng: 6.813895};
    var map = new google.maps.Map(document.getElementById('mapid'), {
    center: myLatLng,
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.HYBRID
    });
    var contentString = '<div class="markerWindow">'+
        '<h4 id="firstHeading" class="firstHeading">Roseville Escape</h4>'+
        '<div id="bodyContent">'+
        '<p>Route du Lavaux 44'+'<br />'+
        'CH-1802 Corseaux</p>'+
        '</div>'+
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Roseville Escape Room'
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}
