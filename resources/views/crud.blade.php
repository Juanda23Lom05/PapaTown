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
                            {{-- Cambiamos el badge del header a texto fijo --}}
                            <th scope="col">Referencia de Sistema</th>
                            <th scope="col">Nombre Común</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($papas) && $papas->count() > 0)
                            @foreach ($papas as $papa)
                            <tr>
                                {{-- Aplicamos ID Masking visual en la celda --}}
                                <td>
                                    <span class="badge bg-dark">
                                        REF-{{ strtoupper(substr(md5($papa->id . 'semilla-secreta'), 0, 6)) }}
                                    </span>
                                </td>

                                {{-- Doble llave para evitar XSS --}}
                                <td>{{ $papa->nombre_comun }}</td>

                                <td class="text-center">
                                    {{-- El target debe coincidir con el ID ofuscado del modal --}}
                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ md5($papa->id) }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>

                                    {{-- El target debe coincidir con el ID ofuscado del modal de eliminar --}}
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ md5($papa->id) }}">
                                        <i class="bi bi-trash"></i> Borrar
                                    </button>
                                </td>
                            </tr>

                            {{-- Incluimos los modales --}}
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