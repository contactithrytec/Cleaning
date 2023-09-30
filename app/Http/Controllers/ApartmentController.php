<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Residence;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ApartmentController extends Controller
{
    public function index(Request $request){

        $data=Apartment::query()->with(['TypeApartment','ResidenceApartment'])->orderBy('id','desc');
        $links=array(['name'=>'Appartements','url'=>url('/apartments')]);
        $types=Type::pluck('name','id');
        if ($request->ajax()){
            return DataTables::of($data)
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('H:i');
                })
                ->addColumn('actions',function ($apartment) use($types){
                    return view('pages.apartments.actions.btn',compact('apartment','types'));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return  view('pages.apartments.index',compact('links'));

    }

    public function create(Request $request,$id){
        $residence=Residence::find($id);
        $types=Type::all();
        $links=array(['name'=>'Résidences','url'=>url('/residences')],
            ['name'=>'La liste des appartements','url'=>url('/residences/detail/'.$residence->id.'#tabs-apartments')],
            ['name'=>'Ajouter un appartement','url'=>url('/apartments/create/'.$residence->id)],);
        return view('pages.apartments.create',compact('links','types','residence'));

    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>['string','max:20','min:3'],
            'num'=>['max:5','string','unique:apartments,residence_id','required'],
            'priority'=>['required'],
            'note'=>['string','min:10','max:3000'],
            'status'=>['required'],
            'residence_id'=>['required','exists:residences,id'],
            'type_id'=>['required','exists:types,id'],
        ]);

        $input=$request->all();
        Apartment::create($input);
        $path=$request->redirect_url;
        $tab='#tabs-apartments';
        return redirect()->to($path.$tab)->with('success',"l'appartement ajouté avec succès");

    }

    public function edit(Request $request,$id){
        $apartment=Apartment::find($id);
        $types=Type::all();
        $links=array(['name'=>'Résidences','url'=>url('/residences')],
            ['name'=>'La liste des appartements','url'=>url('/residences/detail/'.$apartment->residence_id.'#tabs-apartments')],
            ['name'=>"Modifier l'appartement","url"=>url('/apartments/edit/'.$apartment->residence_id)],);
        return view('pages.apartments.edit',compact('links','types','apartment'));

    }

    public  function update(Request $request,$id){
        $this->validate($request,[
            'name'=>['string','max:20','min:3'],
            'num'=>['max:5','string','unique:apartments,residence_id,'.$id,'required'],
            'priority'=>['required'],
            'note'=>['string','min:10','max:3000'],
            'status'=>['required'],
            'residence_id'=>['required','exists:residences,id'],
            'type_id'=>['required','exists:types,id'],
        ]);

        $input=$request->all();
        $apartment=Apartment::find($id);
        $apartment->update($input);
        $path=$request->redirect_url;
        $tab='#tabs-apartments';
        return redirect()->to($path.$tab)->with('success',"l'appartement a été mis à jour avec succès");

    }

    public function delete(Request $request,$id){

        $path=$request->redirect_url;
        $tab='#tabs-apartments';
        $apartment=Apartment::find($id);
        $apartment->delete();
        return redirect()->to($path.$tab)->with('success',"l'appartement supprimé avec succès");


    }
}
