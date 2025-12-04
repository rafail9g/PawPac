document.addEventListener("DOMContentLoaded", () => {

    const latInput = document.getElementById("lat");
    const lngInput = document.getElementById("lng");

    if (!latInput || !lngInput) {
        console.error("Input lat/lng tidak ditemukan!");
        return;
    }

    let lat = parseFloat(latInput.value);
    let lng = parseFloat(lngInput.value);

    // Default fallback kalau DB kosong
    if (isNaN(lat) || isNaN(lng)) {
        lat = -6.2;
        lng = 106.8;
    }

    // FIX error: Map container already initialized
    const container = L.DomUtil.get("map");
    if (container !== null) {
        container._leaflet_id = null;
    }

    const map = L.map("map").setView([lat, lng], 17);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    const marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    marker.on("dragend", () => {
        const pos = marker.getLatLng();
        latInput.value = pos.lat;
        lngInput.value = pos.lng;
    });

    // Input manual update marker
    function updateMarker() {
        const newLat = parseFloat(latInput.value);
        const newLng = parseFloat(lngInput.value);

        if (!isNaN(newLat) && !isNaN(newLng)) {
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng]);
        }
    }

    latInput.addEventListener("input", updateMarker);
    lngInput.addEventListener("input", updateMarker);
});
