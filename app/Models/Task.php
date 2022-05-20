<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public const NOT_STARTED = 'not_started';
    public const STARTED = 'started';
    public const PAUSED = 'paused';
    public const DONE = 'done';

    protected $fillable = ['name', 'todo_list_id', 'status'];

    public function todo_list()
    {
        return $this->belongsTo(TodoList::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => TaskStatus::class,
    ];
}