<div class="modal fade" id="modalActualizar{{ $papa['id'] }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Papa #{{ $papa['id'] }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('crud.view.update', $papa->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- ESTA LÍNEA ES LA QUE TE FALTA --}}

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_comun" class="form-label">Editar Nombre</label>
                        <input type="text" class="form-control" name="nombre_comun" value="{{ $papa->nombre_comun }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning w-100">Actualizar</button>
                </div>
            </form>


        </div>
    </div>
</div>