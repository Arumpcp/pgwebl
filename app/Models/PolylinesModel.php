<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['id'];

    // Metode untuk mendapatkan seluruh polyline sebagai GeoJSON
    public function gejson_polylines()
    {
        $polyline = $this
        ->select(DB::raw('polylines.id, ST_AsGeoJSON(polylines.geom) as geom, polylines.name, polylines.description, polylines.image,
        polylines.created_at, polylines.updated_at, polylines.user_id, users.name as user_created'))
        ->leftJoin('users', 'polylines.user_id', '=', 'users.id')
        ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polyline as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_created' => $p->user_created,
                    'user_id' => $p->user_id,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    // Metode untuk mendapatkan polyline berdasarkan ID dalam format GeoJSON
    public function gejson_polyline($id)
    {
        $polyline = $this
        ->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image,
        created_at,updated_at, name as user_created'))
        ->where('id', $id)
        ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polyline as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
