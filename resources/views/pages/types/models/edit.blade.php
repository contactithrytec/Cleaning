<div class="modal modal-blur fade" id="modal-edit_type{{$type->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('types.update',$type->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un nouveau type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="entrez le nom du type" value="{{$type->name}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary " data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
