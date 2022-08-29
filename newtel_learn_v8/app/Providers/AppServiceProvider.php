<?php

namespace App\Providers;

use App\Repositories\Department\DepartmentRepository;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Issue\IssueRepository;
use App\Repositories\Issue\IssueRepositoryInterface;
use App\Repositories\Oauth_client\Oauth_clientRepository;
use App\Repositories\Oauth_client\Oauth_clientRepositoryInterface;
use App\Repositories\Permit\PermitRepository;
use App\Repositories\Permit\PermitRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Role_permit\Role_permitRepository;
use App\Repositories\Role_permit\Role_permitRepositoryInterface;
use App\Repositories\Status\StatusRepository;
use App\Repositories\Status\StatusRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
// use App\Repositories\User\UserRepTest;
use App\Repositories\UserRole\UserRoleRepository;
use App\Repositories\UserRole\UserRoleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        // $this->app->singleton(UserRepositoryInterface::class, UserRepTest::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermitRepositoryInterface::class, PermitRepository::class);
        $this->app->singleton(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->singleton(IssueRepositoryInterface::class, IssueRepository::class);

        $this->app->singleton(Oauth_clientRepositoryInterface::class, Oauth_clientRepository::class);
        $this->app->singleton(Role_permitRepositoryInterface::class, Role_permitRepository::class);
        $this->app->singleton(StatusRepositoryInterface::class, StatusRepository::class);
        $this->app->singleton(UserRoleRepositoryInterface::class, UserRoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
