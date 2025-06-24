@extends('layout.template')

@section('content')
    <div class="container pt-5 mt-5" style="padding-top: 100px;">
        {{-- Daftar Titik --}}
        <div class="card mb-4">
            <div class="card-header text-white bg-primary">
                <h4 class="mb-0">Daftar Titik</h4>
            </div>
            <div class="card-body bg-light">
                <table class="table table-striped table-bordered" id="points-table">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Daftar Garis --}}
        <div class="card mb-4">
            <div class="card-header text-white bg-primary">
                <h4 class="mb-0">Daftar Garis</h4>
            </div>
            <div class="card-body bg-light">
                <table class="table table-striped table-bordered" id="polylines-table">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polylines as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Daftar Poligon --}}
        <div class="card mb-5">
            <div class="card-header text-white bg-primary">
                <h4 class="mb-0">Daftar Poligon</h4>
            </div>
            <div class="card-body bg-light">
                <table class="table table-striped table-bordered" id="polygons-table">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($polygons as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->description }}</td>
                                <td>
                                    @if ($p->image)
                                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="Image" width="200" class="img-fluid rounded" title="{{ $p->image }}">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at }}</td>
                                <td>{{ $p->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <style>
        body {
            background-color: #2a488e;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        table img {
            border-radius: 6px;
        }

        th, td {
            vertical-align: middle;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        new DataTable('#points-table');
        new DataTable('#polylines-table');
        new DataTable('#polygons-table');
    </script>
@endsection
