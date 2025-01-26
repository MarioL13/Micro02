<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $primaryKey = 'id_activity';

    protected $fillable = [
        'title',
        'description',
        'limit_date',
    ];

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'activity_items', 'id_activity', 'id_item')
            ->withPivot('percentage'); // Incluye el porcentaje desde la tabla pivot
    }


}
