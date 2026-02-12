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
                            {{-- Cambiamos $data por $papas --}}
                            @if(isset($papas) && $papas->count() > 0)
                                @foreach ($papas as $papa)
                                    <tr>
                                        {{-- Usamos flecha -> porque es un objeto de Eloquent --}}
                                        <td>{{ $papa->id }}</td>
                                        <td>{{ $papa->nombre_comun }}</td>
                                        <td>{{ $papa->nombre_cientifico }}</td>
                                        <td>{{ $papa->origen }}</td>
                                        <td>{{ $papa->color_piel }}</td>
                                        <td>{{ $papa->color_pulpa }}</td>
                                        <td>{{ $papa->forma }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-warning" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalActualizar{{ $papa->id }}">
                                                <i class="bi bi-pencil"></i> Actualizar
                                            </button>

                                            <button type="button" class="btn btn-outline-danger" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar{{ $papa->id }}">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    @include('components.modals.actualizar_papa', ['papa' => $papa])
                                    @include('components.modals.eliminar_papa', ['papa' => $papa])
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">No hay papas registradas :(</td>
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