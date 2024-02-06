<?php

namespace App\Http\Controllers;

use App\Models\rubrique;
use App\Models\categorie;
use App\Models\commentaire;
use App\Models\User;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class RubriqueController extends Controller
{
    
    public function __construct()
    {
        
        

    }
    /**
     * Display a listing of the resource.
     */
    public function index( )
    {
        //
        $user = Auth::user();
       
        $categories = Categorie::withCount('rubriques')->get();
        $rubriques = rubrique::paginate(4);
        $totalRubriques = rubrique::count();
        $rubriquesWithCommentsCount = rubrique::with(['commentaires' => function ($query) {
            $query->selectRaw('rubriques_id, count(*) as commentaire_count')->groupBy('rubriques_id');
        }])->paginate(4);

        $rubriquefreaquents = Rubrique::withCount('commentaires')->orderByDesc('commentaires_count')->paginate(4);
        ;
          
        return view('rubriques.index', compact("rubriquesWithCommentsCount"))
        ->with('totalRubriques', $totalRubriques)
        ->with('categories', $categories)
        ->with('rubriquefreaquents', $rubriquefreaquents);
        ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      
        
        $users= User::all()->pluck('name','id');
        $categories = categorie::all();
        return view('rubriques.create',compact('users','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::id();
        request()->validate([
            'titre' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');
        if (!is_null($image)) {
            // La valeur de l'input existe, attribuer cette valeur à la variable
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $image = '/images/'.$imageName;
        } else {
            // La valeur de l'input n'existe pas, attribuer une valeur par défaut (par exemple, null)
            $image = "NULL";
        }

        

        $rubrique = new rubrique();
        $rubrique->users_id = $user;
        $rubrique->categories_id=$request->input('categories_id');
        $rubrique->titre=$request->input('titre');
        $rubrique->message=$request->input('message');
        $rubrique->image=$image;
        $rubrique->etat=true;
        $rubrique->save();
        return redirect()->route('post.show' , $rubrique->id)
            ->with('success','sujet cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(rubrique $rubrique, $id)
    {
        //
        $user = Auth::user();
        $rubrique = rubrique::find($id);
       
        $user->can('view', $rubrique);
       
    
       
        $commentaire = commentaire::where('rubriques_id', $id)->get();
        return view('rubriques.show',compact('rubrique','commentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rubrique $rubrique)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rubrique $rubrique, $id)
    {
        //
        $rubrique = rubrique::find($id);
        $rubrique->etat=$request->input('etat');
        $rubrique->save();
        

    
    return redirect()->back()->with('success', 'sujet modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rubrique $rubrique, $id)
    {
        //
        $rubrique = rubrique::find($id);
        $rubrique->commentaires()->delete();

    
    $rubrique->delete();

    return redirect()->route('post.index')->with('success', 'sujet supprimé avec succès');
    }
    public static function rendreLiensCliquables($texte)
    {
        return preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank">$1</a>', $texte);
    }
}
