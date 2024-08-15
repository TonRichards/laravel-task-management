<?php

namespace App\Models;

use App\Enums\SpaceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Space extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'spaces';

    protected $fillable = [
        'uuid',
        'name',
        'space_id',
        'type',
        'user_id',
        'statuses',
        'is_favorited',
    ];

    protected $casts = [
        'statuses' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
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
        return $this->hasMany($this, 'space_id', 'uuid')->where('type', SpaceType::FOLDER->value);
    }

    public function subSpaceCount(): int
    {
        return $this->subSpaces->count();
    }
}
