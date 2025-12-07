<div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalCrearLabel">Registrar Nueva Papa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="crearNombreComun" class="form-label">Nombre Común</label>
                            <input type="text" class="form-control" id="crearNombreComun" placeholder="Ej. Papa Rosada">
                        </div>
                        <div class="col-md-6">
                            <label for="crearNombreCientifico" class="form-label">Nombre Científico</label>
                            <input type="text" class="form-control" id="crearNombreCientifico" placeholder="Ej. Solanum tuberosum">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Origen</label>
                            <input type="text" class="form-control" placeholder="Ej. Andes">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Forma</label>
                            <select class="form-select">
                                <option selected disabled>Selecciona una...</option>
                                <option>Redonda</option>
                                <option>Alargada</option>
                                <option>Ovalada</option>
                                <option>Irregular</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Color Piel</label>
                            <input type="text" class="form-control" placeholder="Ej. Roja">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Color Pulpa</label>
                            <input type="text" class="form-control" placeholder="Ej. Amarilla">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success">Guardar Papa</button>
            </div>
        </div>
    </div>
</div>