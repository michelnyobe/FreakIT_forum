<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'commentaire',
        'users_id',
        'rubriques_id',
    ];
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function rubrique(){
        return $this->belongsTo(rubrique::class ,'rubriques_id','id');
    }
    
}
