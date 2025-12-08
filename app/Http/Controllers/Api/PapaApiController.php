<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http;
use Illuminate\Http\Request;

class PapaApiController extends Controller
{
    protected $baseURL;

    public function __construct()
    {
        $this->baseURL = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
    }

    public function index()
    {
        $response = Http::withoutVerifying()->get("$this->baseURL/papas/");
        $data = $response->successful() ? $response->json() : [];
        return view('crud', compact('data'));
    }

    public function store(Request $request)
    {
        $response = Http::withoutVerifying()->post("$this->baseURL/papas", $request->all());
        return $response->successful()
            ? redirect()->route('crud.view.index')->with('success', 'Papa creada')
            : back()->withErrors($response->json('errors'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::withoutVerifying()->put("$this->baseURL/papas/$id", $request->all());
        return $response->successful()
            ? redirect()->route('crud.view.index')->with('success', 'Papa actualizada correctamente')
            : back()->withErrors($response->json('errors'));
    }

    public function destroy($id)
    {
        Http::withoutVerifying()->delete("$this->baseURL/papas/$id");
        return back()->with('success', 'Papa eliminada correctamente');
    }

}
