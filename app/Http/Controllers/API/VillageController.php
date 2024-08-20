<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Village;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function autoGenerateVillage(Request $req)
    {
        try {
            $api_key = $req->api_key;
            $id_kecamatan = $req->id_kecamatan;
            $client = new Client();

            $api_url = env('API_WILAYAH') . "/wilayah/kelurahan?api_key=$api_key&id_kecamatan=$id_kecamatan";

            $response = $client->get($api_url);
            $data = json_decode($response->getBody(), true);
            foreach ($data['value'] as $item) {
                Village::create([
                    'code_kecamatan' => $item['id_kecamatan'],
                    'code' => $item['id'],
                    'name' => $item['name']
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Successfully generate village'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}