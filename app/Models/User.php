<?php

namespace App\Models;

use App\Supports\Model\CamelCase;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CamelCase;

    protected $table = 'user';
}
