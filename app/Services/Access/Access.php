<?php

namespace App\Services\Access;

/**
 * Class Access
 * @package App\Services\Access
 */
class Access
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null
     */
    public function user()
    {
        return auth()->user();
    }

    /**
     * Get the currently authenticated user's id
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * Checks if the current user has a Role by its name or id
     *
     * @param string $role Role name
     * @return bool
     */
    public function hasRole($role)
    {
        if($user = $this->user()){
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Checks if the user has one or more, or all of an array of roles
     *
     * @param $roles
     * @param bool $needsAll
     * @return bool
     */
    public function hasRoles($roles, $needsAll = false)
    {
        if($user = $this->user()){
            //if not an array, make a one item array
            if(!is_array($roles)){
                $roles = array($roles);
            }

            $user->hasRoles($roles, $needsAll);
        }

        return false;
    }

    /**
     * Check if the current user has  a permission by its name or id
     *
     * @param $permission
     * @return bool
     */
    public function allow($permission)
    {
        if($user = $this->user()){
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * Check an array of permissions whether or not all are required to continue
     *
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if($user= $this->user()){
            //if not an array, make a one item array
            if(! is_array($permissions)){
                $permission = array($permissions);
            }

            return $user->allowMutiple($permissions, $needsAll);
        }

        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->allow($permission);
    }

    /**
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }
}
