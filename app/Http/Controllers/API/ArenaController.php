<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Arena;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArenaController extends Controller
{
    /*
    Fetch all data arena
    Method: get
    Uri: /api/arena
    */
    public function fetchArenas()
    {
        try {
            $data = Arena::filter(request(['name']))->paginate(10);

            if (!$data) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'msg' => 'Fetching all arenas'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Fetch arena by id
    Method: get
    Uri: /api/arena/{id}
    */
    public function fetchArenaById(Arena $arena)
    {
        try {
            if (!$arena) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data not found'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => $arena,
                'msg' => 'Fetch arena by Id'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }

    /*
    Create new record arena
    Method: post
    Uri: /api/arena
    */
    public function createArena(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_desa' => ['required']
        ]);

        try {
            // Check data arena
            $slug = Str::slug($req->name, '-');

            $data = Arena::where('slug', $slug)->first();
            if ($data) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data already exists'
                ], 409);
            }

            $data = Arena::create([
                'id_desa' => $req->id_desa,
                'name' => $req->name,
                'slug' => $slug
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'Successfully create arena',
                'data' => $data
            ]);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'msg' => $err->getMessage()
            ]);
        }
    }
}