<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading the provider is deferred
     *
     * @var bool
     */
    protected $deferred=false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
        $this->registerBindings();
        $this->registerFacade();
    }

    /**
     * Register the application bindings
     *
     * return void
     */
    private function registerAccess()
    {
        $this->app->bind('access', function($app){
            return new Access($app);
        });
    }

    /**
     *Register the vault facade without the user having to add it to the  app.php file
     */
    public function registerFacade()
    {
        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Access', \App\Services\Access\Facades\Access::class);
        });
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
        $this->app->bind(
            \App\Repositories\Frontend\Access\User\UserRepositoryContract::class,
            \App\Repositories\Frontend\Access\User\EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\User\UserRepositoryContract::class,
            \App\Repositories\Backend\Access\User\EloquentUserRepository::class
            );

        $this->app->bind(
            \App\Repositories\Backend\Access\Role\RoleRepositoryContract::class,
            \App\Repositories\Backend\Access\Role\EloquentRoleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\Permission\PermissionRepositoryContract::class,
            \App\Repositories\Backend\Access\Permission\EloquentPermissionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract::class,
            \App\Repositories\Backend\Access\Permission\Group\EloquentPermissionGroupRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\Permission\Dependency\PermissionDependencyRepositoryContract::class,
            \App\Repositories\Backend\Access\Permission\Dependency\EloquentPermissionDependencyRepository::class
        );
    }

    /**
     * Register the blade extender to use new blade sections
     */
    protected function registerBladeExtensions()
    {
        Blade::directive('role', function($role){
            return "<?php if(access()->hasRole({$role})): ?>";
        });

        Blade::directive('roles', function($roles){
            return "<?php if(access()->hasRoles({$roles})):?>";
        });

        Blade::directive('needsroles', function($roles){
            return "<?php if(access()->hasRoles({$roles}, true)):?>";
        });
        Blade::directive('permission', function($permission){
            return "<?php if(access()->allow({$permission})): ?>";
        });
        Blade::directive('permissions', function($permissions){
            return "<?php if(access()->allowMultiple({$permissions})): ?>";
        });
        Blade::directive('needspermissions', function($permissions){
            return "<?php if(access()->allowMultiple({$permissions}, true)): ?>";
        });

        Blade::directive('endauth', function(){
            return '<?php endif;?>';
        });
    }
}
