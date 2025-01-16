<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $table = 'projects';

    protected $primaryKey = 'id_project';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'id_project', 'id_user');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'project_items', 'id_project', 'id_item');
    }
}
