<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityItemGrade extends Model
{
    protected $table = 'activity_item_grades';

    // Definir las claves primarias compuestas
    protected $primaryKey = ['id_activity', 'id_user', 'id_item'];

    // Desactivar los incrementos automáticos, ya que no se usan claves autoincrementales
    public $incrementing = false;

    // Especificar el tipo de la clave primaria (generalmente entero)
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'id_activity',
        'id_user',
        'id_item',
        'grade',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    // Opcional: Desactivar casting si no lo necesitas
    protected $casts = [
        'id_activity' => 'integer',
        'id_user' => 'integer',
        'id_item' => 'integer',
        'grade' => 'float',
    ];
}
