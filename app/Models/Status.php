<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = [
        'name',
        'display_name',
        'space_id',
    ];

    public const TODO = 'todo';

    public static function getStatusId(string $name): int
    {
        return self::where('name', $name)->first()->id;
    }
}
