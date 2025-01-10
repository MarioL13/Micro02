<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user',
        'name',
        'surname',
        'email',
        'password',
        'birthdate',
        'state',
        'dni',
        'is_profesor',
        'image',
        'creation_date'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_projects', 'id_user', 'id_project');
    }

}
