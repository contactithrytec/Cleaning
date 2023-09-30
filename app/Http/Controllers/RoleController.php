<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /*function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }*/

    public function index(Request $request)
    {
        $permissions = Permission::get();
        $data=Role::query()->orderBy('id','desc');
        $links=array(['name'=>'Rôles','url'=>url('/roles')],);

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($role)use($permissions){
                    $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                        ->all();
                    return view('pages.roles.actions.btn',compact('role','permissions','rolePermissions'));
                })
                ->editColumn('created_at', function ($param) {
                    return Carbon::parse($param->created_at)->format('H:i');
                })
                ->rawColumns(['actions'])->make(true);
        }
        return  view('pages.roles.index',compact('links','permissions'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')
            ->with('success','Le rôle ajouté avec succès');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => ['required',Rule::unique('roles','name')->ignore($id)],
            'permissions' => ['required','array'],
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles.index')
            ->with('success','Le rôle a été mis à jour avec succès');
    }

    public function delete($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success','Le rôle supprimé avec succès');
    }
}
