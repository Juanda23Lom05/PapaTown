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
                            <th scope="col">#</th>
                            <th scope="col">Nombre Común</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($papas) && $papas->count() > 0)
                        @foreach ($papas as $papa)
                        <tr>
                            <td>
                                <span class="fw-bold text-muted">
                                    {{ $papas->firstItem() + $loop->index }}
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
                            <td colspan="3" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center opacity-75">
                                    {{-- Ícono gigante de caja vacía de Bootstrap --}}
                                    <i class="bi bi-box-seam text-success" style="font-size: 4rem;"></i>
                                    <h4 class="mt-3 text-secondary">Aún no hay papas en el huerto</h4>
                                    <p class="text-muted">Comienza agregando tu primera variedad de papa al sistema.</p>
                                    {{-- Botón que abre el modal de crear directamente desde aquí --}}
                                    <button type="button" class="btn btn-sm btn-outline-success mt-2" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                        <i class="bi bi-plus-circle"></i> Agregar la primera
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4 mb-5">
                    {{ $papas->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.crear_papa')
@endsection