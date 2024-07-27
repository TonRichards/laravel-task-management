<?php

namespace App\Models;

use App\Enums\SpaceType;
use App\Enums\TaskType;
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
        'type_id',
        'slug',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function mainTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('type_id', getTaskTypeId(TaskType::MAIN_TASK->value));
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function subSpaces(): HasMany
    {
        return $this->hasMany($this)->where('type_id', getSpaceTypeId(SpaceType::SUB_SPACE->value));
    }

    public function subSpaceCount(): int
    {
        return $this->subSpaces->count();
    }
}
