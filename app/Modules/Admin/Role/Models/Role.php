<?php

namespace App\Modules\Admin\Role\Models;

use App\Modules\Admin\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function savePermissions($perms) {
        if (!empty($perms)) {
            $this->permissions()->sync($perms);
        } else {
            $this->permissions()->detach();
        }
    }

}
