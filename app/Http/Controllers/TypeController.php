<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeController extends Controller
{
    public function index(Request $request){

        $data=Type::query()->orderBy('id','desc');
        $links=array(['name'=>'Types','url'=>url('/types')]);
        if($request->ajax()){
            return DataTables::of($data)
                ->addColumn('actions',function ($type){
                    return view('pages.types.actions.btn',compact('type'));
                })
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('H:i');
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return  view('pages.types.index',compact('links'));
    }


    public function store(Request $request){

        $this->validate($request,[
            'name'=>['string','min:3','required']
        ]);

        $input=$request->all();
        Type::create($input);
        return redirect()->route('types.index')->with('success','le type ajouté avec succès');

    }



    public  function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['string','min:3','required']
        ]);
        $type=Type::find($id);
        $input=$request->all();
        $type->update($input);
        return redirect()->route('types.index')->with('success','le type a été mis à jour avec succès');
    }

    public function delete(Request $request,$id){

        $type=Type::find($id);
        $type->delete();
        return redirect()->route('types.index')->with('success','Le type supprimé avec succès');

    }
}
