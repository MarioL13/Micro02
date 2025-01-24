<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'id_item';

    public $timestamps = false;

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_items', 'id_item', 'id_activity')
            ->withPivot('percentage');
    }
}
