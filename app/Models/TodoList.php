<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'list_task');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
