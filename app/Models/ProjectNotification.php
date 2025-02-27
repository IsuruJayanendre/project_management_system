<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNotification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'project_id', 'message', 'read_at'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
