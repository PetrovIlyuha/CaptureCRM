<?php


namespace App\Modules\Admin\Role\Models\Traits;


use App\Modules\Admin\Role\Models\Role;
use Illuminate\Support\Str;

trait UserRoles
{
    public function roles() {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function canDo($alias, $require = false)
    {
        if (is_array($alias)) {
            foreach ($alias as $permissionName) {
                $result = $this->canDo($permissionName);
                if ($result && !$require) {
                    return true;
                } elseif (!$result && $require) {
                    return false;
                }
            }
        }
        else {
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $permission) {
                    if (Str::is($alias, $permission->alias)) {
                        return true;
                    }
                }
            }
        }
        return $require;
    }

    public function hasRole($alias, $require = false): bool
    {
        if (is_array($alias)) {
            foreach ($alias as $roleName) {
                $hasRole = $this->hasRole($roleName);
                if ($hasRole && !$require) {
                    return true;
                } else if (!$hasRole && $require) {
                    return false;
                }
            }
        } else {
            foreach ($this->roles as $role) {
                if ($role->alias == $alias) {
                    return true;
                }
            }
        }
        return $require;
    }

    public function getMergedPermissions(): array
    {
        $result = [];
        foreach ($this->getRoles() as $role) {
            $result = array_merge($result, $role->permissions->toArray());
        }
        return $result;
    }

    public function getRoles() {
        if ($this->roles) {
            return $this->roles()->get();
        }
        return [];
    }

}
