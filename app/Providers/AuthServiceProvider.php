<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', function(User $user) {
            return $user->role == 'admin';
        });

        Gate::define('user', function(User $user) {
            return $user->role == 'user';
        });

        Gate::define('can-edit-task', function(User $user) {
            $pieces = explode('/', request()->url());
            $ids = preg_grep('/^[0-9]+$/', $pieces);
            $id = reset($ids);
            // dd($id);
            // dd($id);
            $task = $id ? Task::find((int)$id) : null;
            return $task->user ? $task->user->id == $user->id : false;
        });
    }
}
