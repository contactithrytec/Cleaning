<div class="modal modal-blur fade" id="modal-create_residence" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('residences.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une nouvelle résidences</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom de résidence</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="entrez le nom de la résidence">
                    </div>

                    <div class="mb-3 select-container" >
                        <label class="form-label">Propriétaire de résidence</label>
                        <div class="row g-2">
                            <div class="col">
                                <select class="form-select select-dropdown" id="users" name="user_id" data-placeholder="sélectionner le propriétaire de cette résidence" multiple>
                                    <option></option>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name .' '.$user->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-auto align-self-center">
                                  <a href="{{route('users.create',['from_residence'=>true])}}" style="text-decoration: none" class="form-help"
                                     data-title="Ajouter un utilisateur s'il n'existe pas">+</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-primary " data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
