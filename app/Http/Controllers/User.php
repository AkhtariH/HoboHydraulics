<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    const ADMIN_ROLE = 'admin';
    const DEFAULT_ROLE = 'employee';

    public function isAdmin() {
        return $this->type === self::ADMIN_ROLE;
    }
}
