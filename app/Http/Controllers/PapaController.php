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
        // 1. Validamos que el input llegó
        $request->validate([
            'nombre_comun' => 'required|string|max:255',
        ]);

        // 2. Limpiamos etiquetas (para tu tarea de vulnerabilidades)
        $inputUsuario = $request->input('nombre_comun');
        $nombreLimpio = strip_tags($inputUsuario);

        // 3. Creamos el registro
        Papa::create([
            'nombre_comun'      => $nombreLimpio,
            'nombre_cientifico' => 'Solanum tuberosum',
            'origen'            => 'Andes',
            'color_piel'        => 'N/A',
            'color_pulpa'       => 'N/A',
            'forma'             => 'N/A',
        ]);

        return redirect()->route('crud.view.index')->with('success', '¡Papa guardada!');
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
