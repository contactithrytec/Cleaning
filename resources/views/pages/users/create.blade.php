@extends('layouts.master')

@push('css')
    @include('layouts.extra.css.select2')
@endpush

@section('content')

    <div class="container-xl">
        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
            <div class="row g-0">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4"> Ajouter un nouvel utilisateur</h2>
                        <h3 class="card-title">Détails du profil</h3>
                        <div class="row align-items-center">
                            <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                            </div>
                            <div class="col-auto"><a href="#" class="btn">
                                    Ajouter une image
                                </a></div>
                            {{--<div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                    Delete avatar
                                </a></div>--}}
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
                                    <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="entrez le nom d'utilisateur" Required>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-label Required">Nom</div>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="entrez le nom" Required>
                            </div>
                            <div class="col-md">
                                <div class="form-label Required">Prénom</div>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="entrez le prénom" Required>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-label Required">Adresse</div>
                                <input type="text" class="form-control" value="{{old('address')}}" name="address" id="address" placeholder="entrez l'adresse">
                            </div>
                            <div class="col-md">
                                <div class="form-label Required">Numéro de téléphone</div>
                                <input type="text" class="form-control" value="{{old('phone_number')}}" name="phone_number" id="phone_number" placeholder="entrez le numéro de téléphone" Required>
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
                                        <input type="text" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="entrez l'e-mail" Required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mt-4 Required">Password</h3>
                        <div class="row g-3">
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" value="" @error('password') is-invalid @enderror  name="password" autocomplete="off" Required>
                                    <label for="floating-password">Mot de passe</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="" autocomplete="off" Required>
                                    <label for="floating-password">Confirmation du mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title mt-4">Status</h3>
                        <p class="card-subtitle">Rendre le profil activé signifie que l'utilisateur peut accéder à son profil.</p>
                        <div>
                            <label class="form-check form-switch form-switch-lg Required">
                                <input class="form-check-input" type="checkbox" name="status" id="status" >
                                <span class="form-check-label form-check-label-on">l'utilisateur est actuellement activé</span>
                                <span class="form-check-label form-check-label-off">l'utilisateur est actuellement désactivé</span>
                            </label>
                        </div>
                        @if(isset($residence))
                            @if(isset($role))
                                <h3 class="card-title mt-4 Required">Les rôles</h3>
                                <div>
                                    <div class="mb-3">
                                        <input class="form-control"  name="role_name[]" value="{{old('role_name',$role->name)}}" required readonly>
                                    </div>
                                </div>
                            @endif
                                <input type="hidden" name="residence_id" value="{{$residence->id}}">
                                <input type="hidden" name="redirect_url" id="redirect_url" value="{{route('residences.show_controllers',$residence->id)}}">

                        @else
                            <h3 class="card-title mt-4 Required">Les rôles</h3>
                            <p class="card-subtitle">sélectionnez les rôles pour cet utilisateur.</p>
                            <div>
                                <div class="mb-3">
                                    <select class="form-select" id="role_name" name="role_name[]" data-placeholder="Choose anything" multiple required>
                                        <option></option>
                                        @if(isset($roles))
                                            @foreach($roles as $role)
                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="0" id="from_residence" name="from_residence">

                        @endif
                    </div>
                    <div class="card-footer bg-transparent mt-auto">
                        <div class="btn-list justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Ajouter
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

        var url = window.location.href;
        console.log(url)
        var activeTab = url.substring(url.indexOf("=") + 1);

        if(activeTab==1)
            document.getElementById('from_residence').value=activeTab;

    </script>

@endpush

