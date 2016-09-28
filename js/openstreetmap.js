var map = L.map('map').setView([46.47087, 6.81397], 17);
L.tileLayer('http://{s}.tile.osm.org//{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);
var marker = L.marker([46.47087, 6.81397]).addTo(map);
