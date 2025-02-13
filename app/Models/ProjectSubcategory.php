<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_type_id'];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }
}