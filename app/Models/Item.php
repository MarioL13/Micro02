<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'id_item';

    public $timestamps = false;

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_items', 'id_item', 'id_project');
    }
}
