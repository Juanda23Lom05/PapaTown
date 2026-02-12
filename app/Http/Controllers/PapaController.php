<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Papa;
use Illuminate\Http\Request;

class PapaController extends Controller
{
    public function index()
    {
        // Traemos todas las papas de la DB
        $papas = Papa::all();
        // IMPORTANTE: Mandamos 'papas' a la vista 'crud'
        return view('crud', compact('papas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255',
            'origen' => 'required|string|max:255',
            'color_piel' => 'required|string|max:255',
            'color_pulpa' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
        ]);

        Papa::create($data);

        // Redirigimos a la ruta que definiste en web.php
        return redirect()->route('crud.view.index')->with('success', '¡Papa creada!');
    }

    public function update(Request $request, $id)
    {
        $papa = Papa::findOrFail($id);
        $data = $request->validate([
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255',
            'origen' => 'required|string|max:255',
            'color_piel' => 'required|string|max:255',
            'color_pulpa' => 'required|string|max:255',
            'forma' => 'required|string|max:255',
        ]);

        $papa->update($data);
        return redirect()->route('crud.view.index')->with('success', 'Papa actualizada.');
    }

    public function destroy($id)
    {
        $papa = Papa::findOrFail($id);
        $papa->delete();
        return redirect()->route('crud.view.index')->with('success', 'Papa eliminada.');
    }
}