<div class="btn-list flex-nowrap">
    <a href="#" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit_role{{$role->id}}">
        Edit
    </a>
    @include('pages.roles.models.edit')

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_role{{$role->id}}">
        Delete
    </a>
    @include('pages.roles.models.delete')
</div>

