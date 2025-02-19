<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_name', 'project_type_id','project_subcategory_id', 'price', 'starting_date', 'note'];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }
    public function projectSubcategory()
    {
        return $this->belongsTo(ProjectSubcategory::class);
    }
}
