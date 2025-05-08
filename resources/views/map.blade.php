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
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Create Point-->
    <div class="modal fade" id="CreatePointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Point Name</label>
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
                            <label for="name" class="form-label">Photo</label>
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

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="CreatePolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Polyline Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill polyline name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polylines" name="image"
                                onchange="document.getElementById('preview-image-polylines').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polylines" class="img-thumbnail"
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

    <!-- Modal Create Polygon -->
    <div class="modal fade" id="CreatePolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polygon.store') }}"enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Polygon Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill polygon name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygons" name="image"
                                onchange="document.getElementById('preview-image-polylgons').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygons" class="img-thumbnail"
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
        var map = L.map('map').setView([-8.725550870233365, 115.19240080909411], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            if (type === 'polyline') {
                $('#geom_polyline').val(objectGeometry);
                $('#CreatePolylineModal').modal('show');
            } else if (type === 'polygon' || type === 'rectangle') {
                $('#geom_polygon').val(objectGeometry);
                $('#CreatePolygonModal').modal('show');
            } else if (type === 'marker') {
                $('#geom_point').val(objectGeometry);
                $('#CreatePointModal').modal('show');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON untuk Point
        var pointLayer = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 6,
                    color: "#ff1493", // Pink
                    weight: 5,
                    opacity: 1,
                });
            },
            onEachFeature: function(feature, layer) {
                var popupContent = `
            <div style="color:#ff1493">
                <strong>Nama:</strong> ${feature.properties.name} <br>
                <strong>Deskripsi:</strong> ${feature.properties.description} <br>
                <strong>Dibuat:</strong> ${feature.properties.created_at} <br>
                <img src="{{ asset('storage/images') }}/${feature.properties.image}" width="200"> <br>
                <form method="POST" action="{{ url('points') }}/${feature.properties.id}" onsubmit="return confirm('Yakin ingin menghapus titik ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash-can"></i></button>
                </form>
            </div>`;
                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent).openPopup();
                    },
                });
            }
        });

        // Load GeoJSON dari endpoint
        $.getJSON("{{ route('api.points') }}", function(data) {
            pointLayer.addData(data);
            map.addLayer(pointLayer);
        });

        // **GeoJSON untuk Polyline**
        var polylineLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "#ff1493", // Pink
                    weight: 3,
                    opacity: 1
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = `
            <div style="color:#ff1493">
                <strong>Nama:</strong> ${feature.properties.name} <br>
                <strong>Deskripsi:</strong> ${feature.properties.description} <br>
                <strong>Dibuat:</strong> ${feature.properties.created_at} <br>
                <img src="{{ asset('storage/images') }}/${feature.properties.image}" width="200"><br>
                <form method="POST" action="{{ url('polylines') }}/${feature.properties.id}" onsubmit="return confirm('Yakin ingin menghapus titik ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                    </button>
                </form>
             </div>`;
                        layer.bindPopup(popupContent);

                layer.on('mouseover', function(e) {
                    layer.bindTooltip(feature.properties.keterangan, {
                        sticky: true
                    }).openTooltip();
                });
            }
        });

        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polylineLayer.addData(data);
            map.addLayer(polylineLayer);
        });

        // **GeoJSON untuk Polygon**
        var polygonLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "#ff1493", // Pink
                    fillColor: "#ff1493",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.3
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = `
        <div style="color:#ff1493">
                <strong>Nama:</strong> ${feature.properties.name} <br>
                <strong>Deskripsi:</strong> ${feature.properties.description} <br>
                <strong>Dibuat:</strong> ${feature.properties.created_at} <br>
                <img src="{{ asset('storage/images') }}/${feature.properties.image}" width="200"><br>
                 <form method="POST" action="{{ url('polygon') }}/${feature.properties.id}" onsubmit="return confirm('Yakin ingin menghapus titik ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                    </button>
                </form>
            </div>`;

                layer.bindPopup(popupContent);

                layer.on('mouseover', function(e) {
                    layer.bindTooltip(feature.properties.kecamatan, {
                        sticky: true
                    }).openTooltip();
                });
            }
        });

        // Ambil data GeoJSON dari API
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygonLayer.addData(data);
            map.addLayer(polygonLayer);
        });
    </script>
@endsection
