@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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

    <!-- Modal Edit Polyline -->
    <div class="modal fade" id="EditPolylineModal" tabindex="-1" aria-labelledby="polylineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('polylines.update', $id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="polylineModalLabel">Edit Polyline</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="polyline_name" name="name"
                                placeholder="Fill polyline name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="polyline_description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3" readonly></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polyline" class="img-thumbnail mt-2"
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
            attribution: '&copy; OpenStreetMap'
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

                // Menampilkan data ke dalam modal untuk polyline
                $('#polyline_name').val(properties.name);
                $('#polyline_description').val(properties.description);
                $('#geom_polyline').val(objectGeometry);
                $('#preview-image-polyline').attr('src', "{{ asset('storage/images') }}/" + properties
                    .image);

                // Menampilkan modal edit
                $('#EditPolylineModal').modal('show');
            });
        });

        // **GeoJSON untuk Polyline**
        var polylineLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    radius: 6,
                    color: "#093FB4",
                    weight: 5,
                    opacity: 1
                };
            },

            onEachFeature: function(feature, layer) {
                // Menambahkan layer ke dalam drawnItems
                drawnItems.addLayer(layer);

                var properties = feature.properties;
                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {
                        // Menampilkan data ke dalam modal untuk polyline
                        $('#polyline_name').val(properties.name);
                        $('#polyline_description').val(properties.description);
                        $('#geom_polyline').val(objectGeometry);
                        $('#preview-image-polyline').attr('src', "{{ asset('storage/images') }}/" +
                            properties.image);

                        // Menampilkan modal edit
                        $('#EditPolylineModal').modal('show');
                    },
                });
            },
        });

        // Load GeoJSON from endpoint
        $.getJSON("{{ route('api.polyline', $id) }}", function(data) {
            polylineLayer.addData(data);
            map.addLayer(polylineLayer);
            map.fitBounds(polylineLayer.getBounds(), {
                padding: [100, 100]
            });
        });
    </script>
@endsection
