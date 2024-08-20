<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function autoGenerateKecamatan(Request $req)
    {
        try {
            $api_key = $req->api_key;
            $id_kabupaten = $req->id_kabupaten;
            $client = new Client();

            $api_url = env('API_WILAYAH') . "/wilayah/kecamatan?api_key=$api_key&id_kabupaten=$id_kabupaten";

            $response = $client->get($api_url);
            $data = json_decode($response->getBody(), true);
            foreach ($data['value'] as $item) {
                Kecamatan::create([
                    'code_city' => $item['id_kabupaten'],
                    'code' => $item['id'],
                    'name' => $item['name']
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Successfully generate kecamatan'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}