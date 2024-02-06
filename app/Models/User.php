<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\role;
use App\Models\Commentaire;
use App\Models\rubrique;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;




class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $dispatchesEvents = [
        'login' => Login::class,
        'logout' => Logout::class,
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'banner',
        'Birthdate',
        'roles_id',
        'actived',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function roles() {
        return $this->belongsTo(role::class);
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'users_id');
    }

    public function rubriques()
    {
        return $this->hasMany(rubrique::class, 'users_id');
    }
    



    


}
