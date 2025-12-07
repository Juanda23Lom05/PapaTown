<div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning ">
                <h5 class="modal-title" id="modalActualizarLabel">Editar Papa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombreComun" class="form-label">Nombre Común</label>
                            <input type="text" class="form-control" id="nombreComun" value="Papa Blanca">
                        </div>
                        <div class="col-md-6">
                            <label for="nombreCientifico" class="form-label">Nombre Científico</label>
                            <input type="text" class="form-control" id="nombreCientifico" value="Solanum tuberosum">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Color Piel</label>
                            <input type="text" class="form-control" value="Beige">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Color Pulpa</label>
                            <input type="text" class="form-control" value="Blanca">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Forma</label>
                            <select class="form-select">
                                <option selected>Redonda</option>
                                <option>Alargada</option>
                                <option>Ovalada</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>