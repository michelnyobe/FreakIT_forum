<?php

namespace App\Http\Controllers;

use App\Models\commentaire;
use App\Models\rubrique;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $commentaires = commentaire::all();
        $rubriques = rubrique::all();
        return view('commentaires.index', compact("commentaires"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users= User::all()->pluck('name','id');
        $rubriques = rubrique::all()->pluck('id');
        return view('commentaires.create',compact('users','rubriques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::id();
        request()->validate([
            'commentaire' => 'required',
        ]);
        
        $commentaire = new commentaire();
        $commentaire->users_id = $user;
        $commentaire->rubriques_id=$request->input('rubriques_id');;
        $commentaire->commentaire=$request->input('commentaire');
        $commentaire->save();
        return redirect()->route('post.show', $commentaire->rubriques_id) 
        ->with('success','commentaire cree avec succes.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(commentaire $commentaire)
    {
        //
        $commentaire = commentaire::findOrFail($commentaire);
        return view('commentaires.show',compact('commentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id )
    {
       
            
            $commentaire = commentaire::find($id);
            $commentaire->delete();

            return redirect()->route('post.show', $commentaire->rubriques_id) 
                         ->with('warning','Commentaire supprimé');  

           
    }
}
