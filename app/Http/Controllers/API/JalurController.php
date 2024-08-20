<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jalur;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JalurController extends Controller
{
    /*
    Fetching all data jalur
    Method: get
    Uri: /api/jalur/
    */
    public function fetchJalur()
    {
        try {
            $data = Jalur::paginate(10);

            return response()->json([
                'success' => true,
                'data' => $data,
                'msg' => 'Fetching all data jalur'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Fetching data jalur by Id
    Method: get
    Uri: /api/jalur/{id}
    */
    public function fetchById(Jalur $jalur)
    {
        try {
            if (!$jalur) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $jalur,
                'msg' => 'Fetch data by Id'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Create new record jalur
    Method: post
    Uri: /api/jalur/create
    */
    public function createJalur(Request $request)
    {
        $valid = $request->vlaidate([
            'name' => ['required', 'string', 'max:255'],
            'id_desa' => ['required']
        ]);

        try {
            // Check data
            $data = Jalur::where('slug', Str::slug($request->name, '-'))->first();

            if ($data) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data is already exists'
                ], 409);
            }

            $data = Jalur::create([
                'id_desa' => $request->id_desa,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Successfully create record',
                'data' => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Update data jalur
    Method: post
    Uri: /api/jalur/update/{id}
    */
    public function updateJalur(Request $request, Jalur $jalur)
    {
        $valid = $request->vlaidate([
            'name' => ['required', 'string', 'max:255'],
            'id_desa' => ['required']
        ]);

        try {
            // Check data
            $data = Jalur::where('slug', Str::slug($request->name, '-'))->first();

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data not found'
                ], 404);
            }

            $data->update([
                'id_desa' => $request->id_desa,
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Successfully updated record',
                'data' => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Delete record by Id
    Method: delete
    Uri: /api/jalur/delete/{id}
    */
    public function deleteJalur(Jalur $jalur)
    {
        try {

            $jalur->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Successfully deleted record'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}