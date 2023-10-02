<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Residence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Controller;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class ControllersController extends Controller
{
    public function index(Request $request){

        $data=Controller::query()->with(['user','residence'])->orderBy('id','desc');

        if($request->ajax()){

            $where=$this->getWhere($request->all());
            $data->where([$where]);

            return DataTables::of($data)
                ->editColumn('created_at',function($data){
                    return Carbon::parse($data->created_at)->format('H:i');
                })
                ->editColumn('phone_number',function($data){
                    return $data->user->phone_number;
                })
                ->editColumn('role_name',function($data){
                    return $data->user->role_name;
                })
                ->editColumn('status',function($data){
                    return $data->user->status;
                })
                ->addColumn('full_name',function ($data){
                    return $data->user->first_name.' '.$data->user->last_name;
                })
                ->addColumn('actions',function ($controller){
                    return view('pages.controllers.actions.btn',compact('controller'));
                })
                ->rawColumns(['actions','full_name'])
                ->make(true);
        }

        return view('pages.controllers.index');
    }

    public  function create(Request $request,$residence_id){

        $residence=Residence::where('id',$residence_id)->first();
        $links=array(['name'=>'Résidences','url'=>url('/residences')],
            ['name'=>'La liste des controlleurs','url'=>url('/residences/show_controllers/'.$residence->id.'#tabs-controllers')],
            ['name'=>'Ajouter un controlleur','url'=>url('/controllers/create/'.$residence->id)],);
        $role = Role::where('name','controlleur')->first();
        return view('pages.users.create',compact('role','links','residence'));

    }


    public function edit(Request $request,$id){
        $controller=Controller::find($id)->with(['user','residence'])->first();

        $links=array(['name'=>'Résidences','url'=>url('/residences')],
            ['name'=>'La liste des controlleurs','url'=>url('/residences/show_controllers/'.$controller->residence_id.'#tabs-controllers')],
            ['name'=>"Modifier le controlleur","url"=>url('/controllers/edit/'.$controller->residence_id)],);
        return view('pages.users.edit_controller',compact('links','controller'));

    }

    public function delet(Request $request,$id){
        $path=$request->redirect_url;
        $tab='#tabs-controllers';
        $controller=Controller::find($id);
        $user=User::find($controller->user_id);
        $user->delete();
        $controller->delete();
        return redirect()->to($path.$tab)->with('success',"Le controlleur supprimé avec succès");

    }

    private function getWhere($extra){

        $where = [
            'where' => []
        ];


        if(key_exists('where',$extra)){

            $where = $extra['where'];

            $where = json_decode($where,true);
        }

        return $where['where'];
    }
}
