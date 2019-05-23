<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @mixin \Eloquent
 */
class Role extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'role_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasPermission($name)
    {
        foreach ($this->permissions as $permission) {
            if ($permission->name == $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $input
     */
    public function sync($input)
    {
        $this->permissions()->sync($input);
    }

    public function detach()
    {
        $this->permissions()->detach();
    }
}
