<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\rubrique;
use App\Models\commentaire;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\RubriquePolicy;
use App\Policies\CommentairePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        rubrique::class => RubriquePolicy::class,
        commentaire::class => CommentairePolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
    }
   
}
