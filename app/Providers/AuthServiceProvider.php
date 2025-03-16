<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Gate::before(function ($user) {
            if ($user->role == 'superadmin') {
                return true;
            }
        });
        Gate::define('superadmin', function ($user) {
            return $user->role == 'superadmin';
        });
        Gate::define('olah_pasien', function ($user) {
            return $user->role == 'perawat' or $user->role == 'dokter';
        });
        Gate::define('olah_obat', function ($user) {
            return $user->role == 'dokter' or $user->role == 'perawat';
        });
        Gate::define('olah_rekmed', function ($user) {
            return $user->role == 'dokter' or $user->role == 'perawat' or $user->role == 'superadmin';
        });
        Gate::define('olah_keuangan', function ($user) {
            return $user->role == 'staff' or $user->role == 'superadmin';
        });
    }
}
