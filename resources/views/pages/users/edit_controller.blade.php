@extends('layouts.master')

@push('css')
    @include('layouts.extra.css.select2')
@endpush

@section('content')

    <div class="container-xl">
        <form @if(isset($controller)) action="{{route('users.update',$controller->user_id)}}" @endif method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Modifier l'utilisateur</h2>
                            <h3 class="card-title">Détails du profil</h3>
                            <div class="row align-items-center">
                                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                </div>
                                <div class="col-auto"><a href="#" class="btn">
                                        Modifier l'image
                                    </a></div>
                                <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                        Supprimer l'image
                                    </a></div>
                            </div>
                            <h3 class="card-title mt-4">Informations sur le profil</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nom d'utilisateur</div>
                                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                        <input type="text" class="form-control" name="username" id="username" @if(isset($controller->user->username)) value="{{$controller->user->username}}" @endif placeholder="entrez le nom d'utilisateur" Required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label Required">Nom</div>
                                    <input type="text" class="form-control" name="last_name" id="last_name" @if(isset($controller->user->last_name)) value="{{$controller->user->last_name}}" @endif placeholder="entrez le nom" Required>
                                </div>
                                <div class="col-md">
                                    <div class="form-label Required">Prénom</div>
                                    <input type="text" class="form-control" name="first_name" id="first_name" @if(isset($controller->user->first_name)) value="{{$controller->user->first_name}}" @endif placeholder="entrez le prénom" Required>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label Required">Adresse</div>
                                    <input type="text" class="form-control" @if(isset($controller->user->address)) value="{{$controller->user->address}}" @endif name="address" id="address" placeholder="entrez l'adresse">
                                </div>
                                <div class="col-md">
                                    <div class="form-label Required">Numéro de téléphone</div>
                                    <input type="text" class="form-control" @if(isset($controller->user->phone_number)) value="{{$controller->user->phone_number}}" @endif name="phone_number" id="phone_number" placeholder="entrez le numéro de téléphone" Required>
                                </div>
                            </div>
                            <h3 class="card-title mt-4 Required">Email</h3>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                      <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                    @
                                    </span>
                                            <input type="text" class="form-control" @if(isset($controller->user->email)) value="{{$controller->user->email}}" @endif name="email" id="email" placeholder="entrez l'e-mail" Required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-4 Required">Mot de passe</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" value="" @error('password') is-invalid @enderror  name="password" autocomplete="off">
                                        <label for="floating-password">Mot de passe</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="" autocomplete="off">
                                        <label for="floating-password">Confirmation du mot de passe</label>
                                    </div>
                                </div>
                            </div>
                            <h3 class="card-title mt-4">Status</h3>
                            <p class="card-subtitle">Rendre le profil activé signifie que l'utilisateur peut accéder à son profil.</p>
                            <div>
                                <label class="form-check form-switch form-switch-lg Required">
                                    <input class="form-check-input" type="checkbox" name="status" id="status" @if(isset($controller->user->status)) @if($controller->user->status==1) checked @endif @endif>
                                    <span class="form-check-label form-check-label-on">l'utilisateur est actuellement activé</span>
                                    <span class="form-check-label form-check-label-off">l'utilisateur est actuellement désactivé</span>
                                </label>
                            </div>
                            <h3 class="card-title mt-4 Required">Les rôles</h3>
                            <p class="card-subtitle">sélectionnez les rôles pour cet utilisateur.</p>
                            <div>
                                <div class="mb-3">
                                    <input class="form-control" name="role_name[]" value="{{$controller->user->role_name[0]}}" required readonly>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="residence_id" id="residence_id" value="{{$controller->residence_id}}">
                        <input type="hidden" name="controller_id" id="controller_id" value="{{$controller->id}}">
                        <input type="hidden" name="redirect_url" id="redirect_url" value="{{route('residences.show_controllers',$controller->residence_id)}}">
                        <div class="card-footer bg-transparent mt-auto">
                            <div class="btn-list justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Modifier
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection

@push('js')

    @include('layouts.extra.js.select2')

    <script>
        $( '#role_name' ).select2( {
            theme: 'bootstrap-5',
            placeholder:'selectionez les permissions'
        } );
    </script>

@endpush
