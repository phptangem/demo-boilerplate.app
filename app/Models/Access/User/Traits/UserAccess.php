<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 9:27
 */
namespace App\Models\Access\User\Traits;
trait UserAccess
{


    /**
     * Check to see if the user has a role by its name or id
     *
     * @param $nameOrId role name or id
     * @return bool
     */
    public function hasRole($nameOrId)
    {
        foreach($this->roles as $role){
            //First check to see if it's an ID
            if(is_numeric($nameOrId)){
                if($role->id == $nameOrId){
                    return true;
                }
            }
            //Otherwise check by name
            if($role->name == $nameOrId){
                return true;
            }
        }

        return false;
    }

    /**
     * Checks to see if user has array of roles
     *
     * @param $roles
     * @param $needsAll
     * @return bool
     */
    public function hasRoles($roles, $needsAll)
    {
        //User has to possess all of the roles specified
        if($needsAll){
            $hasRoles = 0;
            $numRoles = count($roles);
            foreach($roles as $role){
                if($this->hasRole($role)){
                    $hasRoles++;
                }
            }

           return $numRoles == $hasRoles;
        }

        //User has to posses one of roles specified
        foreach($roles as $role){
            if($this->hasRole($role)){
                return true;
            }
        }
        return false;
    }

    /**
     * Check if the user has a permission by its name or id
     *
     * @param $nameOrId
     * @return bool
     */
    public function allow($nameOrId)
    {
        foreach($this->roles as $role){
            //See if role has all permissions
            if($role->all){
                return true;
            }

            //Validate against the Permission table
            foreach($role->permissions as $perm){
                //First check to see if it's an ID
                if(is_numeric($nameOrId)){
                    if($perm->id == $nameOrId){
                        return true;
                    }
                }

                //Otherwise check by name
                if($perm->name == $nameOrId){
                    return true;
                }
            }
        }

        //Check permissions directly tied to user
        foreach($this->permissions as $perm){
            //First check to see if it's an ID
            if(is_numeric($nameOrId)){
                if($perm == $nameOrId){
                    return true;
                }
            }

            //Otherwise check by name
            if($perm->name == $nameOrId){
                return true;
            }
        }

        return false;
    }

    /**
     * Check an array of permissions and whether or not all are required to continue
     *
     * @param $permissions
     * @param bool $needsAll
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        //User has to possess all permissions specified
        if($needsAll){
            $hasPermissions = 0;
            $numPermissions = count($permissions);

            foreach($permissions as $perm){
                if($this->allow($perm)){
                    $hasPermissions++;
                }
            }

            return $numPermissions == $hasPermissions;
        }

        //User has to possess one of the permissions specified
        $hasPermissions = 0;
        foreach($permissions as $perm){
            if($this->allow($perm)){
                $hasPermissions++;
            }
        }

        return $hasPermissions > 0;
    }

    /**
     * @param $nameOrId
     * @return bool
     */
    public function hasPermission($nameOrId)
    {
        return $this->allow($nameOrId);
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

    /**
     * Alias to eloquent many-to-many relation's attach() method
     * @param $role
     */
    public function attachRole($role)
    {
        if(is_object($role)){
            $role = $role->getKey();
        }

        if(is_array($role)){
            $role = $role['id'];
        }
        $this->roles()->attach($role);
    }

    /**
     * Alias to eloquent many-to-many relations's detach() method
     *
     * @param $role
     */
    public function detachRole($role)
    {
        if(is_object($role)){
            $role = $role->getKey();
        }
        if(is_array($role)){
            $role = $role['id'];
        }
        $this->roles()->detach($role);
    }

    /**
     * Attach multiple roles to user
     *
     * @param $roles
     */
    public function attachRoles($roles)
    {
        foreach($roles as $role){
            $this->attachRole($role);
        }
    }

    /**
     * Detach multiple roles from a user
     *
     * @param $roles
     */
    public function detachRoles($roles)
    {
        foreach($roles as $role){
            $this->detachRole($role);
        }
    }

    /**
     * Attach one permission not associated with a role directly to a user
     *
     * @param $permission
     */
    public function attachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);
    }

    /**
     * Attach other permissions not associated with a role directly  to a user
     *
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        if(count($permissions)){
            foreach($permissions as $permission){
                $this->attachPermission($permission);
            }
        }
    }

    /**
     * Detach one permission not associated with a role directly to a user
     *
     * @param $permission
     * @return mixed
     */
    public function detachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }

        return $this->permissions()->detach($permission);
    }

    /**
     * Detach other permissions not associated with a role directly to a user
     * @param $permissions
     */
    public function detachPermissions($permissions)
    {
        if(count($permissions)){
            foreach($permissions as $permission){
                $this->detachPermission($permission);
            }
        }
    }
}