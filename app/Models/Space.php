<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $table = 'spaces';

    protected $fillable = [
        'uuid',
        'name',
        'space_id',
        'type_id',
        'slug',
        'user_id'
    ];
}
