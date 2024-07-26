<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'name',
        'display_name',
        'scope',
    ];

    public function getTypeId(string $name): int
    {
        return $this->where('name', $name)->first()->id;
    }
}
