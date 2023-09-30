<div class="btn-list flex-nowrap">
    <a href="{{route('apartments.edit',$apartment->id)}}" class="btn btn-outline-warning">
        Modifier
    </a>

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_apartment{{$apartment->id}}">
        Supprimer
    </a>
    @include('pages.apartments.models.delete')
</div>
