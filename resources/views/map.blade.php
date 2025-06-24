@extends('layout/template')

@section('styles')
    <!-- Font Awesome (HARUS sebelum awesome markers) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet Draw -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
    <!-- Leaflet Awesome Markers -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.4/leaflet.awesome-markers.css" />

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

        .marker-location-dot {
            font-size: 1.8rem !important;
            width: 75px !important;
            height: 75px !important;
            line-height: 45px !important;
            color: rgb(35, 102, 184) !important;
        }

        body {
            background-color: #2a488e;
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

                <form method="POST" action="{{ route('polygons.store') }}"enctype="multipart/form-data">
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
                                onchange="document.getElementById('preview-image-polygons').src = window.URL.createObjectURL(this.files[0])">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.4/leaflet.awesome-markers.js"></script>
    <script src="https://unpkg.com/leaflet.awesome-markers@2.0.5/dist/leaflet.awesome-markers.js"></script>
    <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>

    <script>
        var map = L.map('map').setView([-7.789693169370688, 110.3692962319942], 13, 5);
        // Buat pane agar bisa atur urutan layer
        map.createPane('polygonPane');
        map.getPane('polygonPane').style.zIndex = 2000;

        map.createPane('polylinePane');
        map.getPane('polylinePane').style.zIndex = 300;

        map.createPane('pointsPane');
        map.getPane('pointsPane').style.zIndex = 400;

        // Definisi beberapa basemap
        // Tambahkan hanya salah satu default basemap
        var openStreetMap = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map); // ini yang aktif
        var esriWorldStreet = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri — Source: Esri, DeLorme, NAVTEQ',
                maxZoom: 19
            });
        var esriWorldImagery = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri & Earthstar Geographics',
                maxZoom: 19
            });
        var cartoLight = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 19
        });

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
            pane: 'pointsPane',
            pointToLayer: function(feature, latlng) {
                var awesomeIcon = L.AwesomeMarkers.icon({
                    icon: 'location-dot',
                    prefix: 'fa',
                    extraClasses: 'marker-location-dot',
                });


                return L.marker(latlng, {
                    icon: awesomeIcon,
                    pane: 'pointsPane'
                });
            },
            onEachFeature: function(feature, layer) {
                const name = feature.properties.name || "Tidak ada nama";
                const desc = feature.properties.description || "-";
                const created = feature.properties.created_at || "-";
                const user = feature.properties.user_created || "-";
                const image = feature.properties.image ?
                    `/storage/images/${feature.properties.image}` :
                    "";
                const editUrl = `/points/${feature.properties.id}/edit`;
                const deleteUrl = `/points/${feature.properties.id}`;
                const popup = `
                    <div class="text-center text-dark">
                        <strong>Nama:</strong> ${name}<br>
                        <strong>Deskripsi:</strong> ${desc}<br>
                        <strong>Dibuat:</strong> ${created}<br>
                        <strong>Dibuat oleh:</strong> ${user}<br>
                        ${image ? `<img src="${image}" width="200"><br>` : ""}
                        <div class="mt-2 d-flex justify-content-center gap-2">
                            <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                            <form method="POST" action="${deleteUrl}" class="delete-form" style="display:inline;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus point ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                `;
                layer.bindPopup(popup);
            }
        });

        // Load GeoJSON dari endpoint
        $.getJSON("{{ route('api.points') }}", function(data) {
            pointLayer.addData(data);
            map.addLayer(pointLayer);
        });


        //POlyline
        // Fungsi warna berdasarkan nama rute
        function getColorByName(name) {
            const colorMap = {
                "Jalur 1A": "#71C0BB",
                "Jalur 1B": "#00ff00",
                "Jalur 1C": "#0000ff",
                "Jalur 2A": "#FF6F3C",
                "Jalur 2B": "#9900ff",
                "Jalur 3A": "#66cc00",
                "Jalur 3B": "#cc0099",
                "Jalur 4A": "#9933ff",
                "Jalur 4B": "#ff3399",
                "Jalur 5A": "#6600cc",
                "Jalur 5B": "#cc6600",
                "Jalur 6A": "#cc0066",
                "Jalur 6B": "#347433",
                "Jalur 7": "#ffcc00", // Sesuaikan karena hanya ada 'Jalur 7'
                "Jalur 8": "#DC2525",
                "Jalur 9": "#ccff66",
                "Jalur 10": "#ff6666",
                "Jalur 11": "#ff9933",
                "Jalur 12": "#521C0D",
                "Jalur 13": "#cc3366",
                "Jalur 14": "#336633",
                "Jalur 15": "#ff00ff"
            };
            return colorMap[name] || "#000000"; // Default hitam kalau nama tidak cocok
        }

        // Fungsi ubah MultiLineString ke LineString
        function multiLineToLineStrings(feature) {
            if (feature.geometry.type === "MultiLineString") {
                return feature.geometry.coordinates.map(function(coords) {
                    return {
                        type: "Feature",
                        geometry: {
                            type: "LineString",
                            coordinates: coords
                        },
                        properties: feature.properties
                    };
                });
            } else {
                return [feature];
            }
        }

        // GeoJSON Polyline dengan styling berdasarkan nama
        var polylineLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: getColorByName(feature.properties.name),
                    weight: 4,
                    opacity: 1
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = `
        <div style="color:#333">
            <div style="text-align: center;">
                <strong>Nama:</strong> ${feature.properties.name} <br>
                <strong>Deskripsi:</strong> ${feature.properties.description} <br>
                <strong>Dibuat:</strong> ${feature.properties.created_at} <br>
                <strong>Dibuat oleh:</strong> ${feature.properties.user_created} <br>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center gap-2">
                        <a href="{{ url('polylines/${feature.properties.id}/edit') }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pencil-alt"></i> Edit
                        </a>
                        <form method="POST" action="{{ url('polylines') }}/${feature.properties.id}"
                            onsubmit="return confirm('Yakin ingin menghapus polylines ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>`;
                layer.bindPopup(popupContent);
            }
        });

        // Ambil dan tampilkan data GeoJSON dari API Laravel
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            let convertedFeatures = [];

            data.features.forEach(function(feature) {
                const converted = multiLineToLineStrings(feature);
                convertedFeatures = convertedFeatures.concat(converted);
            });

            polylineLayer.addData({
                type: "FeatureCollection",
                features: convertedFeatures
            });

            map.addLayer(polylineLayer);
        });

        // GeoJSON untuk Polygons
        var polygonLayer = L.geoJson(null, {
            style: function(feature) {
                return {
                    color: "rgb(35, 102, 184) ",
                    fillColor: "rgb(35, 102, 184) ",
                    weight: 10,
                    opacity: 1,
                    fillOpacity: 0.3
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = `
        <div style="color:rgb(35, 102, 184)  ">
            <div style="text-align: center;">
            <strong>Nama:</strong> ${feature.properties.name} <br>
            <strong>Deskripsi:</strong> ${feature.properties.description} <br>
            <strong>Dibuat:</strong> ${feature.properties.created_at} <br>
            <strong> Dibuat:</strong> ${feature.properties.user_created} <br>
            <img src="/storage/images/${feature.properties.image}" width="200"><br>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center gap-2">
                    <a href="/polygons/${feature.properties.id}/edit" class="btn btn-sm btn-warning">
                        <i class="fa-solid fa-pencil-alt"></i> Edit
                    </a>
                    <form method="POST" action="{{ url('polygons') }}/${feature.properties.id}"
                    onsubmit="return confirm('Yakin ingin menghapus polygons ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fa-solid fa-trash-can"></i> Hapus
                </button>
                </form>
                </div>
            </div>
            </div>
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


        // Kumpulan basemap
        var baseLayers = {
            "Open Street Map": openStreetMap,
            "Esri World Street": esriWorldStreet,
            "Esri Satellite": esriWorldImagery,
            "Carto Light": cartoLight

        };

        // Layer tambahan (misal pointLayer, polygonLayer, polylineLayer)
        var overlayLayers = {
            "Halte Trans Jogja": pointLayer,
            "Rute Trans Jogja": polylineLayer,
            "Terminal": polygonLayer,
        };

        // Tampilkan kontrol layer di kanan bawah
        L.control.layers(baseLayers, overlayLayers, {
            collapsed: false,
            position: 'bottomright'
        }).addTo(map);
    </script>
@endsection
