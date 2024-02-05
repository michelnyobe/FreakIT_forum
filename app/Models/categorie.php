<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\rubrique;

class categorie extends Model
{
    use HasFactory;
    protected $fillable = [ 'intitule'];
    public function rubriques(){
        return $this->hasMany(rubrique::class  ,'categories_id','id');
}
public function commentaires()
    {
        return $this->hasManyThrough(Commentaire::class, rubrique::class ,'categories_id','rubriques_id','id','id');
    }

}
