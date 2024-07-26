<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Type as TypeEnum;
use Illuminate\Database\Eloquent\Builder;

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
        'user_id',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function subSpaces(): HasMany
    {
        return $this->hasMany($this)->where('type_id', getSpaceTypeId(TypeEnum::SUB_SPACE->value));
    }
}
