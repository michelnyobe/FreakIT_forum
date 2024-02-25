<?php

namespace App\Http\Controllers;
//creation des Models 

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\rubrique;
use App\Models\categorie;
use App\Models\commentaire;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    //
    public function showForum()
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
    public function redirection()
    {
        //
        $role = Auth::user()->roles_id;
        switch ($role) {
            case 1:
                return redirect(route('dashboard'));
            case 2:
                return redirect(route('dashboard'));
            default:    
                return redirect(route('dashboard'));
                }
    
}
public function userlist( )
    {
        //
        $rubriques = rubrique::first();
        $users = User::paginate(20);
        return view('userlist',compact('users'))
        ->with('rubriques', $rubriques);
        
    
}
public function userUpdate( Request $request , $id)
    {
        //
        
        $users = User::find($id);
        $users->roles_id=$request->input('roles_id');
        $users->save();
    
    

    
    return redirect('bob') ;
        
    
}
public function userCreationChart()
{
    $userCounts = User::select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, HOUR(created_at) as hour, COUNT(*) as count'))
        ->groupBy('year', 'month', 'day', 'hour')
        ->orderBy('year')
        ->orderBy('month')
        ->orderBy('day')
        ->orderBy('hour')
        ->get();

    $labels = [];
    $data = [];

    foreach ($userCounts as $userCount) {
        $formattedDate = Carbon::create($userCount->year, $userCount->month, $userCount->day, $userCount->hour)->format('Y-m-d H:i:s');
        $labels[] = $formattedDate;
        $data[] = $userCount->count;
    }

    return view('statistique', compact('labels', 'data'));
}

public function userDelete($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('userlist')->with('success', 'Utilisateur supprimé avec succès');
}
public function search(Request $request)
{
    $query = $request->get('query');
    $rubriques = Rubrique::where('titre', 'like', '%'.$query.'%')->get();

    return response()->json($rubriques);
}

}
