<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmittedTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'assigned_task_id', 'title', 'description', 'file_uri', 'comment', 'progress'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTask()
    {
        return $this->belongsTo(AssignedTask::class);
    }
}
