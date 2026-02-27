<?php

namespace App\Http\Controllers;

use App\Models\Papa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PapaController extends Controller
{
    /**
     * Muestra la lista de papas ordenada por ID descendente.
     */
    public function index(): View
    {
        // Mantenemos tu variable $papas y el orden descendente
        $papas = Papa::orderBy('id', 'desc')->get();
        return view('crud', compact('papas'));
    }

    /**
     * Guarda un nuevo registro sanitizando la entrada.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validación estricta
        $request->validate([
            'nombre_comun' => 'required|string|max:30|unique:papas,nombre_comun',
        ]);

        // 2. Sanitización y lógica de negocio
        $nombreLimpio = strip_tags($request->input('nombre_comun'));

        Papa::create([
            'nombre_comun'      => $nombreLimpio,
            'nombre_cientifico' => 'Solanum tuberosum',
            'origen'            => 'Andes',
            'color_piel'        => 'N/A',
            'color_pulpa'       => 'N/A',
            'forma'             => 'N/A',
        ]);

        // 3. Seguridad: Rotación de token para evitar el "arrastre"
        $request->session()->regenerateToken();

        return redirect()->route('crud.view.index')->with('success', '¡Papa guardada con éxito!');
    }

    /**
     * Actualiza un registro existente.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $papa = Papa::findOrFail($id);

        // Validación ignorando el ID actual para el unique
        $request->validate([
            'nombre_comun' => 'required|string|max:30|unique:papas,nombre_comun,' . $papa->id,
        ]);

        $nombreLimpio = strip_tags($request->input('nombre_comun'));

        $papa->update([
            'nombre_comun' => $nombreLimpio
        ]);

        $request->session()->regenerateToken();

        return redirect()->route('crud.view.index')->with('success', '¡Registro actualizado!');
    }

    /**
     * Elimina una papa de la existencia.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $papa = Papa::findOrFail($id);
        $papa->delete();

        // También regeneramos token aquí por seguridad en cascada
        $request->session()->regenerateToken();

        return redirect()->route('crud.view.index')->with('success', 'La papa ha sido eliminada.');
    }
}