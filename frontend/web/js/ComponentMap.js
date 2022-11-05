const Map = {
    template: '<div id="providersMap"></div>',
    data() {
        return {
            header: "We kiss the Stars",
            map: null,
        }
    },
    mounted() {
        this.map = L.map("providersMap").setView([59.95591, 30.35874], 12)

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(this.map)

        this._showProviders(window.providers)
    },
    methods: {
        _showProviders(providers) {
            let markers = []
            providers.forEach((el) => {
                let address = el.address.replace('Россия, Санкт-Петербург, ', '')
                let marker = L.marker([el.lat, el.lon], {
                    title: address
                })
                .bindTooltip(address)
                //.bindPopup(address)
            
                markers.push(marker)
            })
            
            let group = L.featureGroup(markers).addTo(this.map)
            
            this.map.fitBounds(group.getBounds())
        }
    }
}

export default Map