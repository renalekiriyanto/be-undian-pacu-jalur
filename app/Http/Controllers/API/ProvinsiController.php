<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function autoGenerateProvinsi(Request $req)
    {
        try {
            $api_key = $req->api_key;
            $client = new Client();

            $api_url = env('API_WILAYAH') . "/wilayah/provinsi?api_key=$api_key";

            $response = $client->get($api_url);
            $data = json_decode($response->getBody(), true);
            foreach ($data['value'] as $item) {
                Provinsi::create([
                    'code' => $item['id'],
                    'name' => $item['name']
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Successfully generate provinsi'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}