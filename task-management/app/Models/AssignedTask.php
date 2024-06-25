<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedTask extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'description', 'file_uri'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submittedTasks()
    {
        return $this->hasMany(SubmittedTask::class);
    }
}
