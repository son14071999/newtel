<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\Permit;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $listPermit = Permit::getCode();
        $tokensCan = [];
        foreach($listPermit as $permit){
            $tokensCan[$permit] = $permit;
        }
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::personalAccessTokensExpireIn(now()->addDays(6));
        Passport::tokensCan($tokensCan);
        Passport::setDefaultScope([
            'viewListIssue',
            'viewIssue',
            'deleteIssue',
            'editIssue',
            'addIssue'
        ]);

        //
    }
}
