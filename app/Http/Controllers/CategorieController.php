<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Categorie::withCount('rubriques', 'commentaires')->get();
        return view('categories.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        request()->validate([
            'intitule' => 'required',
        ]);


        $categorie = new categorie();
        $categorie->intitule=$request->input('intitule');
        $categorie->details=$request->input('details');
        $categorie->save();
        return redirect()->route('categories.index')
            ->with('success','categorie cree avec succes.');
    }

    /**
     * Display the specified resource.
     */
    public function show(categorie $categorie)
    {
        //
        $categorie = categorie::findOrFail($categorie);
        return view('categories.show',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categorie $categorie , $id)
    {
        //
        $categorie = categorie::find($id);
        return view('categories.edit',compact('categorie'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categorie $categorie , $id)
    {
        //
        $request->validate([
            'intitule' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000',
        ]);
    
        // Récupérez la catégorie à mettre à jour
        $categorie = Categorie::findOrFail($id);
    
        // Mettez à jour les champs
        $categorie->intitule = $request->input('intitule');
        $categorie->details = $request->input('details');
    
        // Enregistrez les modifications dans la base de données
        $categorie->save();
        return redirect()->route('categories.index')
        ->with('success', 'categorie modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            
            $categorie = Categorie::findOrFail($id);

            
            $categorie->delete();

            
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
        } catch (\Exception $e) {
           
            return redirect()->route('categories.index')->with('error', 'Erreur lors de la suppression de la catégorie');
        }
    }
}
