<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'spaces';

    protected $fillable = [
        'uuid',
        'name',
        'space_id',
        'type_id',
        'slug',
        'user_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
