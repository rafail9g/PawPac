const lat = window.shelterLat;
const lng = window.shelterLng;

const map = L.map('map').setView([lat, lng], 16);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

L.marker([lat, lng])
    .addTo(map)
    .bindPopup(`<div style="text-align:center;">
            <b>PawPac Shelter</b><br>
            We're Here!
        </div>`)
    .openPopup();
