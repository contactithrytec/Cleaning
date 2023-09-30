<div class="btn-list flex-nowrap">
    <a href="#" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit_type{{$type->id}}">
        Modifier
    </a>
    @include('pages.types.models.edit')

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_type{{$type->id}}">
        Supprimer
    </a>
    @include('pages.types.models.delete')
</div>

