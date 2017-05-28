<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed roles
 */
class Permission extends Model
{

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}