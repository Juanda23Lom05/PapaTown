<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalCrearLabel">Registrar Nueva Papa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('crud.view.store') }}" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_comun" class="form-label">Nombre de la Papa</label>
                        <input type="text" class="form-control" name="nombre_comun" placeholder="Ingresa el nombre aquí..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>
</div>