var point = [59.95591, 30.35874];
var map = L.map('providersMap').setView(point, 12);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

let markers = [];

providers.forEach((el) => {
    let address = el.address.replace('Россия, Санкт-Петербург, ', '');
    let marker = L.marker([el.lat, el.lon], {
        title: address
    })
    .bindTooltip(address)
    //.bindPopup(address)
    ;

    markers.push(marker);
});

let group = L.featureGroup(markers).addTo(map);

map.fitBounds(group.getBounds());
