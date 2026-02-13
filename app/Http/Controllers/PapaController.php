<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Papa;
use Illuminate\Http\Request;

class PapaController extends Controller
{
    public function index()
    {
        $papas = Papa::all();
        return view('crud', compact('papas'));
    }

    public function store(Request $request)
    {
        // Único punto de entrada validado
        $request->validate([
            'nombre_comun' => 'required|string|max:255',
        ]);

        Papa::create([
            'nombre_comun'      => $request->nombre_comun,
            'nombre_cientifico' => 'Solanum tuberosum', 
            'origen'            => 'Andes',              
            'color_piel'        => 'Desconocido',
            'color_pulpa'       => 'Desconocida',
            'forma'             => 'Variable',
        ]);

        return redirect()->route('crud.view.index')->with('success', '¡Registro creado exitosamente!');
    }

    public function update(Request $request, $id)
    {
        $papa = Papa::findOrFail($id);

        // Solo permitimos actualizar el nombre
        $request->validate([
            'nombre_comun' => 'required|string|max:255',
        ]);

        $papa->update([
            'nombre_comun' => $request->nombre_comun
        ]);

        return redirect()->route('crud.view.index')->with('success', 'Nombre actualizado.');
    }

    public function destroy($id)
    {
        $papa = Papa::findOrFail($id);
        $papa->delete();
        return redirect()->route('crud.view.index')->with('success', 'Registro eliminado.');
    }
}