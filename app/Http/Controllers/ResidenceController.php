<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ResidenceController extends Controller
{
    public function index(Request $request){
        $data=Residence::query()->with(['UserResidence'])->orderBy('id','desc');
        $users=User::all();
        $links=array(['name'=>'Résidences','url'=>url('/residences')]);
        if ($request->ajax()){
            return DataTables::of($data)
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('H:i');
                })
                ->addColumn('actions',function ($residence)use($users){
                    return view('pages.residences.actions.btn',compact('residence','users'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('pages.residences.index',compact('links','users'));
    }


    public function show(Request $request,$id){

        $links=array(['name'=>'Résidences','url'=>url('/residences')],
                     ['name'=>'La liste des appartements','url'=>url('/residences/detail/'.$id)]);
        $residence=Residence::with(['UserResidence'])->find($id);

        return view('pages.apartments.detail',compact('links','residence'));


    }

    public function showControllers(Request $request,$id){

        $links=array(['name'=>'Résidences','url'=>url('/residences')],
            ['name'=>'La liste des controlleur','url'=>url('/residences/detail/'.$id)]);
        $residence=Residence::with(['UserResidence'])->find($id);

        return view('pages.controllers.detail',compact('links','residence'));


    }

    public function store(Request $request){
            $this->validate($request,[
                'name'=>['required','string','max:50'],
                'user_id'=>['required','integer'],
            ]);
             $input=$request->all();
             $residence=Residence::create($input);
             return redirect()->route('residences.index')->with('success','Résidence ajoutée avec succès');
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['required','string','max:50'],
            'user_id'=>['required','integer'],
        ]);

        $residence=Residence::find($id);
        $input=$request->all();
        $residence->update($input);
        return redirect()->route('residences.index')->with('success','Résidence a été mis à jour avec succès');
    }

    public function delete($id){
        $residence=Residence::find($id);
        $residence->delete();
        return redirect()->route('residences.index')->with('success',"La résidence supprimée avec succès");
    }
}
