@extends('layout.app')
@section('titulo', 'PapaTown')

@section('content')

    <div class="container-fluid">
        <h1 class="mb-4 text-success">Gestión de Papas</h1>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                 <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalCrear">
                    <i class="bi bi-plus-lg"></i> Crear Registro
                </button>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre Común</th>
                                <th scope="col">Nombre Científico</th>
                                <th scope="col">Origen</th>
                                <th scope="col">Color Piel</th>
                                <th scope="col">Color Pulpa</th>
                                <th scope="col">Forma</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Papa Blanca (Tomasa)</td>
                                <td><em>Solanum tuberosum</em></td>
                                <td>Andes Centrales</td>
                                <td>Beige Claro</td>
                                <td>Blanca</td>
                                <td>Redonda</td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalActualizar">
                                        <i class="bi bi-pencil"></i> Actualizar
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modales --}}
    @include('components.modals.crear_papa')
    @include('components.modals.actualizar_papa')
    @include('components.modals.eliminar_papa')

@endsection