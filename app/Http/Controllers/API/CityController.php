<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function autoGenerateCity(Request $req)
    {
        try {
            $api_key = $req->api_key;
            $id_prov = $req->id_provinsi;
            $client = new Client();

            $api_url = env('API_WILAYAH') . "/wilayah/kabupaten?api_key=$api_key&id_provinsi=$id_prov";

            $response = $client->get($api_url);
            $data = json_decode($response->getBody(), true);
            foreach ($data['value'] as $item) {
                City::create([
                    'code_provinsi' => $item['id_provinsi'],
                    'code' => $item['id'],
                    'name' => $item['name']
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Successfully generate cities'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}