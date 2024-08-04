<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class petController extends Controller
{
    public function findByStatus()
    {
        $pets = Pet::all();
        if ($pets->isEmpty()) {
            return response()->json(['message' => 'No hay mascotas registradas', 'status' => 200], 200);
        }
        return response()->json($pets, 200);
    }

    public function findById($id)
    {
        $pets = Pet::find($id);
        if (!$pets) {
            return response()->json(['message' => 'No se encontró la mascota', 'status' => 200], 200);
        }
        return response()->json($pets, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'photoUrls' => 'required',
            'status' => 'required|in:available,pending,sold',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $pet = Pet::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'photoUrls' => $request->photoUrls,
            'status' => $request->status,
        ]);

        if (!$pet) {
            $data = [
                'message' => 'Error al crear la mascota',
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'pet' => $pet,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function destroy($id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            $data = [
                'message' => 'No se encontró la mascota',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $pet->delete();
        $data = [
            'message' => 'Mascota eliminada correctamente',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            $data = [
                'message' => 'No se encontró la mascota',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'photoUrls' => 'required',
            'status' => 'required|in:available,pending,sold',
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $pet->category_id = $request->category_id;
        $pet->name = $request->name;
        $pet->photoUrls = $request->photoUrls;
        $pet->status = $request->status;
        $pet->save();
        $data = [
            'message' => 'Mascota actualizada correctamente',
            'pet' => $pet,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $pet = Pet::find($id);
        if (!$pet) {
            $data = [
                'message' => 'No se encontró la mascota',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:available,pending,sold',
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('name')){
            $pet->name = $request->name;
        }
        
        if($request->has('status')){
            $pet->status = $request->status;
        }

        $pet->save();

        $data = [
            'message' => 'Mascota actualizada correctamente',
            'pet' => $pet,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
