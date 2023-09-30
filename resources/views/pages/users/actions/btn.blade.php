<div class="btn-list flex-nowrap">
    <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-warning">
        Modifier
    </a>

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_user{{$user->id}}">
        Supprimer
    </a>
    @include('pages.users.models.delete')
</div>
