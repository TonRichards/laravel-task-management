<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checklist extends Model
{
    use HasFactory;

    protected $table = 'checklists';

    protected $fillable = [
        'name',
        'task_id',
        'is_checked'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
