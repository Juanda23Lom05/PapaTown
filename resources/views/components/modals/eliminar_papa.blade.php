<div class="modal fade" id="delete-{{ md5($papa->id) }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">⚠️ Confirmar Baja de Registro</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro que deseas eliminar la referencia:</p>
                <h4 class="text-danger">REF-{{ strtoupper(substr(md5($papa->id), 0, 6)) }}?</h4>
                <p class="text-muted small">Esta acción es irreversible y se notificará al sistema.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <form action="{{ route('crud.view.destroy', $papa->id) }}" method="POST">
                    @csrf 
                    @method('DELETE') 
                    <button type="submit" class="btn btn-danger shadow">
                        Sí, Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>