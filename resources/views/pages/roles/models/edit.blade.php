<div class="modal modal-blur fade" id="modal-edit_role{{$role->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('roles.update',$role->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your role name" value="{{$role->name}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <select class="form-select" id="permissions{{$role->id}}" name="permissions[]" data-placeholder="Choose anything" multiple>
                            @if(isset($permissions))
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}" @if(in_array($permission->id,$rolePermissions)) selected @endif>{{$permission->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary " data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-color-picker" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M11 7l6 6"></path>
                            <path d="M4 16l11.7 -11.7a1 1 0 0 1 1.4 0l2.6 2.6a1 1 0 0 1 0 1.4l-11.7 11.7h-4v-4z"></path>
                        </svg>                        Edit  role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.extra.js.select2')
<script>
    $( '#permissions{{$role->id}}' ).select2( {
        theme: 'bootstrap-5',
        placeholder:'selectionez les permissions'
    } );
</script>
