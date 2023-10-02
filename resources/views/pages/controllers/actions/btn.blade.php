<div class="btn-list flex-nowrap">
    <a href="{{route('controllers.edit',$controller->id)}}" class="btn btn-outline-warning">
        Modifier
    </a>

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_controller{{$controller->id}}">
        Supprimer
    </a>
   @include('pages.controllers.models.delete')
</div>
