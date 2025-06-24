@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            width: 100%;
            height: 90vh;
        }

        .legend-wms {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .legend-wms img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        body {
            background-color: #2a488e;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-7.797068, 110.370529], 14);

        // Base map
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan WMS layer
        const transJogjaLayer = L.tileLayer.wms("http://localhost:8080/geoserver/pgwebl_responsi/wms", {
            layers: 'pgwebl_responsi:RUTE_TRANS_JOGJA',
            styles: 'TRANS_JOGJA_STYLE_BARU',
            format: 'image/png',
            transparent: true,
            version: '1.1.0',
            tiled: false,
            attribution: "Rute TransJogja"
        }).addTo(map);

        // Tambahkan legenda sebagai kontrol
        const legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            const div = L.DomUtil.create('div', 'legend-wms');
            const legendUrl =
                "http://localhost:8080/geoserver/pgwebl_responsi/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&LAYER=pgwebl_responsi:RUTE_TRANS_JOGJA&STYLE=TRANS_JOGJA_STYLE_BARU";
            div.innerHTML = `<strong>Legenda:</strong><br><img src="${legendUrl}" alt="Legenda WMS">`;
            return div;
        };

        legend.addTo(map);
    </script>
@endsection
