<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    // Fungsi untuk mengambil data GeoJSON
    public function gejson_polygons()
    {
        $polygons = $this
        ->select(DB::raw('polygons.id, ST_AsGeoJSON(polygons.geom) as geom, polygons.name, polygons.description, polygons.image,
        polygons.created_at, polygons.updated_at, polygons.user_id, users.name as user_created'))
        ->leftJoin('users', 'polygons.user_id', '=', 'users.id')
        ->get(); // Ambil semua data polygon

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), // Konversi geometry ke JSON
                'properties' => [
                    'id' => $p->id, // ID polygon
                    'name' => $p->name, // Nama polygon
                    'description' => $p->description, // Deskripsi polygon
                    'created_at' => $p->created_at, // Waktu pembuatan
                    'updated_at' => $p->updated_at, // Waktu update terakhir
                    'image' => $p->image, // Foto terkait polygon
                    'user_created' => $p->user_created,
                    'user_id' => $p->user_id,
                ],
            ];

            // Menambahkan feature ke dalam collection GeoJSON
            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    // Fungsi untuk mengambil data GeoJSON berdasarkan ID tertentu
    public function gejson_polygon($id)
    {
        $polygon = $this
        ->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image,
        created_at,updated_at, name as user_created'))
        ->where('id', $id)
        ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygon as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), // Konversi geometry ke JSON
                'properties' => [
                    'id' => $p->id, // ID polygon
                    'name' => $p->name, // Nama polygon
                    'description' => $p->description, // Deskripsi polygon
                    'created_at' => $p->created_at, // Waktu pembuatan
                    'updated_at' => $p->updated_at, // Waktu update terakhir
                    'image' => $p->image, // Foto terkait polygon
                ],
            ];

            // Menambahkan feature ke dalam collection GeoJSON
            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
