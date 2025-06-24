@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }

        /* Geser tombol Leaflet Draw agar tidak ketutup navbar */
        .leaflet-top.leaflet-left {
            margin-top: 130px;
            /* sesuaikan tinggi navbar kamu, contoh: 100px */
        }

        body {
            background-color: #2a488e;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Edit Point -->
    <div class="modal fade" id="EditPointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.update', $id) }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image_point" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                width="300">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script>
        var map = L.map('map').setView([-7.789693169370688, 110.3692962319942], 13, 5);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //DIGITIZE FUNCTION//
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polyline: false,
                polygon: false,
                rectangle: false,
                circle: false,
                marker: false,
                circlemarker: false
            },
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layer) {
                var drawnJSONObject = layer.toGeoJSON();
                console.log(drawnJSONObject);

                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(objectGeometry);

                // layer properties
                var properties = drawnJSONObject.properties;
                console.log(properties);

                drawnItems.addLayer(layer);

                // Menampilkan data ke dalam modal
                $('#name').val(properties.name);
                $('#description').val(properties.description);
                $('#geom_point').val(objectGeometry);
                $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);

                // Menampilkan modal edit
                $('#EditPointModal').modal('show');
            });
        });

        // GeoJSON untuk Point
        var pointLayer = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 6,
                    color: "#093FB4",
                    weight: 8,
                    opacity: 1,
                });
            },
            onEachFeature: function(feature, layer) {

                // Menambahkan layer ke dalam drawnItems
                drawnItems.addLayer(layer);

                var properties = feature.properties;
                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {
                        // Menampilkan data ke dalam modal
                        $('#name').val(properties.name);
                        $('#description').val(properties.description);
                        $('#geom_point').val(objectGeometry);
                        $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" +
                            properties.image);

                        // Menampilkan modal edit
                        $('#EditPointModal').modal('show');
                    },
                });
            },
        });

        // Load GeoJSON from endpoint
        $.getJSON("{{ route('api.point', $id) }}", function(data) {
            pointLayer.addData(data);
            map.addLayer(pointLayer);
            var bounds = pointLayer.getBounds();
            map.fitBounds(bounds, {
                padding: [100, 100] // Optional padding for better visibility
            });
        });
    </script>
@endsection
