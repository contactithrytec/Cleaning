<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $data=User::query()->orderBy('id','desc');
        $links=array(['name'=>'utilisateurs','url'=>url('/users')],);
        if ($request->ajax()){
            return DataTables::of($data)
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('H:i');
                })
                ->addColumn('full_name',function ($data){
                    return $data->first_name.' '.$data->last_name;
                })
                ->addColumn('actions',function ($user){
                    return view('pages.users.actions.btn',compact('user'));
                })->rawColumns(['actions','full_name'])->make(true);
        }
        return view('pages.users.index',compact('links'));
    }

    public function create()
    {
        $links=array(['name'=>'utilisateurs','url'=>url('/users')],
            ['name'=>'Ajouter un nouvel utilisateur','url'=>url('/users/create')]);
        $roles = Role::get();
        return view('pages.users.create',compact('roles','links'));
    }

    public function store(Request $request)
    {
          $validator=  $this->validate($request, [
                'first_name' => ['required','string','max:50'],
                'last_name' => ['required','string','max:50'],
                'username' => ['required','unique:users','string','max:50'],
                'phone_number'=>['required','string','unique:users'],
                'address'=>['max:100','string'],
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'role_name' => ['required','array']
            ]);
          if ($request->has('residence_id'))
              $validator=  $this->validate($request, [
                  'residence_id'=>['required','exists:residences,id']
              ]);


            if(isset($request->status))
                $request->request->add(['status'=>1]);
            else
                $request->request->add(['status'=>0]);

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            $user->assignRole($request->input('role_name'));

            if ($request->has('residence_id')){
                $input=['user_id'=>$user->id,'residence_id'=>$request->residence_id];
                $controller=\App\Models\Controller::create($input);
                $path=$request->redirect_url;
                $tab='#tabs-controllers';
                return redirect()->to($path.$tab)->with('success',"le controlleur ajouté avec succès");

            }
            else{
                if ($request->from_residence=='0')
                    return redirect()->route('users.index')
                        ->with('success',"L'utilisateur créé avec succès");
                else
                    return redirect()->route('residences.index')
                        ->with('success',"L'utilisateur ajouté avec succès");
            }

    }

    public function show($id)
    {

        $user = User::find($id);
        $links=array(['name'=>'utilisateurs','url'=>url('/users')],
            ['name'=>'Modifier utilisateur ('.$user->username.')','url'=>url('/users/edit'.$user->id)]);
        return view('users.show',compact('user','links'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::get();
        //$userRole = $user->role_name->all();
        return view('pages.users.edit',compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => ['required','string','max:50'],
            'last_name' => ['required','string','max:50'],
            'username' => ['required','string','max:50','unique:users,username,'.$id],
            'phone_number'=>['required','string','unique:users,phone_number,'.$id],
            'address'=>['max:100','string'],
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'role_name' => 'required'
        ]);

        if ($request->has('residence_id'))
            $validator=  $this->validate($request, [
                'residence_id'=>['required','exists:residences,id']
            ]);

        if(isset($request->status))
            $request->request->add(['status'=>1]);
        else
            $request->request->add(['status'=>0]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        if ($request->has('residence_id')){
            $controller=\App\Models\Controller::find($request->controller_id);
            $input=['user_id'=>$user->id,'residence_id'=>$request->residence_id];
            $controller->update($input);
            $path=$request->redirect_url;
            $tab='#tabs-controllers';
            return redirect()->to($path.$tab)->with('success',"le controlleur a été mis à jour avec succès");

        }
        else {
            return redirect()->route('users.index')
                ->with('success', "L'utilisateur a été mis à jour avec succès");
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success',"L'utilisateur supprimé avec succès");
    }





}
