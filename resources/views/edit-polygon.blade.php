@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Edit Polygon -->
    <div class="modal fade" id="EditPolygonModal" tabindex="-1" aria-labelledby="polygonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('polygons.update', $id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="polygonModalLabel">Edit Polygon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="polygon_name" name="name"
                                placeholder="Fill polygon name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="polygon_description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3" readonly></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygon" class="img-thumbnail mt-2" width="300">
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
        var map = L.map('map').setView([-8.725550870233365, 115.19240080909411], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        //DIGITIZE FUNCTION//
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polyline: false,
                polygon: true,  // Enable polygon drawing
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

                // Menampilkan data ke dalam modal untuk polygon
                $('#polygon_name').val(properties.name);
                $('#polygon_description').val(properties.description);
                $('#geom_polygon').val(objectGeometry);
                $('#preview-image-polygon').attr('src', "{{ asset('storage/images') }}/" + properties.image);

                // Menampilkan modal edit
                $('#EditPolygonModal').modal('show');
            });
        });

        // **GeoJSON untuk Polygon**
        var polygonLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "#ff1493", // pink
                    weight: 3,
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
                        // Menampilkan data ke dalam modal untuk polygon
                        $('#polygon_name').val(properties.name);
                        $('#polygon_description').val(properties.description);
                        $('#geom_polygon').val(objectGeometry);
                        $('#preview-image-polygon').attr('src', "{{ asset('storage/images') }}/" +
                            properties.image);

                        // Menampilkan modal edit
                        $('#EditPolygonModal').modal('show');
                    },
                });
            },
        });

        // Load GeoJSON from endpoint
        $.getJSON("{{ route('api.polygon', $id) }}", function(data) {
            polygonLayer.addData(data);
            map.addLayer(polygonLayer);
            map.fitBounds(polygonLayer.getBounds(), {
                padding: [100, 100]
            });
        });
    </script>
@endsection
