<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Papa;
use Illuminate\Support\Facades\Validator; // <--- 1. CORREGIDO
use Illuminate\Http\Request;

class PapaController extends Controller
{
    public function index()
    {
        $papas = Papa::all();
        if ($papas->isEmpty()) {
            return response()->json(['message' => 'No hay papas'], 400);
        }
        return response()->json($papas, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255',
            'origen' => 'required|string|max:255',
            'color_piel' => 'required|string|max:255',
            'color_pulpa' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $papa = Papa::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Papa creada exitosamente',
            'data' => $papa
        ], 201);
    }

    public function show($id)
    {
        $papa = Papa::find($id);
        if (!$papa) {
            return response()->json(['message' => 'Papa no encontrada'], 404);
        }
        return response()->json($papa, 200);
    }

    public function update(Request $request, $id)
    {
        $papa = Papa::find($id);
        if (!$papa) {
            return response()->json(['message' => 'Papa no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255',
            'origen' => 'required|string|max:255',
            'color_piel' => 'required|string|max:255',
            'color_pulpa' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $papa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Papa reemplazada totalmente (PUT)',
            'data' => $papa
        ], 200);
    }

    public function patch(Request $request, $id)
    {
        $papa = Papa::find($id);
        if (!$papa) {
            return response()->json(['message' => 'Papa no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_comun' => 'sometimes|string|max:255',
            'nombre_cientifico' => 'sometimes|string|max:255',
            'origen' => 'sometimes|string|max:255',
            'color_piel' => 'sometimes|string|max:255',
            'color_pulpa' => 'sometimes|string|max:255',
            'forma' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $papa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Papa actualizada parcialmente (PATCH)',
            'data' => $papa
        ], 200);
    }

    public function destroy($id)
    {
        $papa = Papa::find($id);
        if (!$papa) {
            return response()->json(['message' => 'Papa no encontrada'], 404);
        }

        $papa->delete();

        return response()->json(['message' => 'Papa borrada exitosamente'], 200);
    }
}
