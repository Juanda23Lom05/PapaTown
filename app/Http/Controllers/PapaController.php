<?php

namespace App\Http\Controllers;

use App\Models\Papa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PapaController extends Controller
{
    /**
     * Muestra la lista de papas ordenada por las más recientes primero.
     */
    public function index(): View
    {
        $papas = Papa::orderBy('created_at', 'asc')->paginate(10);
        return view('crud', compact('papas'));
    }

    /**
     * Guarda un nuevo registro con validación, sanitización y transacciones.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_comun' => 'required|string|max:30|unique:papas,nombre_comun',
        ]);

        $nombreLimpio = trim(strip_tags($request->input('nombre_comun')));

        try {
            DB::transaction(function () use ($nombreLimpio) {
                Papa::create([
                    'nombre_comun'      => $nombreLimpio,
                    'nombre_cientifico' => Papa::DEFAULT_CIENTIFICO,
                    'origen'            => Papa::DEFAULT_ORIGEN,
                    'color_piel'        => Papa::NO_DATA,
                    'color_pulpa'       => Papa::NO_DATA,
                    'forma'             => Papa::NO_DATA,
                ]);
            });

            $request->session()->regenerateToken();

            return redirect()->route('crud.view.index')->with('success', '¡Registro creado exitosamente!');

        } catch (\Exception $e) {
            Log::error('Error crítico al crear papa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error interno al guardar. El equipo de soporte ha sido notificado.');
        }
    }

    /**
     * Actualiza un registro existente usando Route Model Binding.
     * Nota: Laravel inyecta automáticamente el modelo (Papa $papa).
     */
    public function update(Request $request, Papa $papa): RedirectResponse
    {
        $request->validate([
            'nombre_comun' => 'required|string|max:30|unique:papas,nombre_comun,' . $papa->id,
        ]);

        $nombreLimpio = trim(strip_tags($request->input('nombre_comun')));

        try {
            DB::transaction(function () use ($papa, $nombreLimpio) {
                $papa->update([
                    'nombre_comun' => $nombreLimpio
                ]);
            });

            $request->session()->regenerateToken();

            return redirect()->route('crud.view.index')->with('success', '¡Registro actualizado exitosamente!');

        } catch (\Exception $e) {
            Log::error('Error crítico al actualizar papa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Fallo en la base de datos al intentar actualizar.');
        }
    }

    /**
     * Elimina una papa de la existencia.
     */
    public function destroy(Request $request, Papa $papa): RedirectResponse
    {
        try {
            DB::transaction(function () use ($papa) {
                $papa->delete();
            });

            $request->session()->regenerateToken();

            return redirect()->route('crud.view.index')->with('success', 'La papa ha sido eliminada del sistema.');

        } catch (\Exception $e) {
            Log::error('Error crítico al eliminar papa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo eliminar el registro de la base de datos.');
        }
    }
}