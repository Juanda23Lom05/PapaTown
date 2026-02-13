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
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($papas) && $papas->count() > 0)
                                @foreach ($papas as $papa)
                                    <tr>
                                        <td>{{ $papa->id }}</td>
                                        {{-- Este es el único punto de salida de datos (Vector de XSS) --}}
                                        <td>{{ $papa->nombre_comun }}</td>
                                        
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-warning btn-sm" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalActualizar{{ $papa->id }}">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>

                                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar{{ $papa->id }}">
                                                <i class="bi bi-trash"></i> Borrar
                                            </button>
                                        </td>
                                    </tr>
                                    {{-- Incluimos los modales aquí para que tengan acceso a la variable $papa --}}
                                    @include('components.modals.actualizar_papa', ['papa' => $papa])
                                    @include('components.modals.eliminar_papa', ['papa' => $papa])
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No hay papas registradas :(</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.crear_papa')
@endsection