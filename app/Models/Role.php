<?php

namespace App\Models;

use App\Traits\UUID;
use \Spatie\Permission\Models\Role as BaseModel;

class Role extends BaseModel
{
    use UUID;

    /**
     * Get the ownership association of the role.
     *
     * @return HasOne
     */
    public function ownership()
    {
        return $this->hasOne(RoleOwnership::class);
    }
}
