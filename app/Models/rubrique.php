<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\commentaire;
use App\Models\categorie;
use App\Models\User;

class rubrique extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'categorie_id',
        'users_id',
        'message',
        'image',
        'etat',

    ];
    public function commentaires(){
        return $this->hasMany(commentaire::class ,'rubriques_id');
    }
    //categorie de la rubrique
    public function categories(){
        return $this->belongsTo(categorie::class ,'categorie_id','id');
    }
    //user de la rubrique
    public function users(){
        return $this->belongsTo(User::class ,'users_id','id');
    }
    
}
