<div class="btn-list flex-nowrap">
    <a href="#" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit_residence{{$residence->id}}">
        Modifier
    </a>
    @include('pages.residences.models.edit')

    <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-delete_risedence{{$residence->id}}">
        Supprimer
    </a>
    @include('pages.residences.models.delete')

    <a href="{{route('residences.show',$residence->id.'#tabs-apartments')}}" class="btn btn-outline-primary">
        Les appartements
    </a>

    <a href="{{route('residences.show_controllers',$residence->id)}}" class="btn btn-outline-success">
        Les controlleurs
    </a>
</div>
