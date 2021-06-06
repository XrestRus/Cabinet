<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property integer $money
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property string $photo
 * @property Role $role
 * @property Carbon $birthday
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'patronymic',
        'money',
        'role',
        'photo',
        'birthday',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'created_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        "role",
    ];

    protected $appends = [
        'title',
    ];

    public function role() {
        return $this->belongsTo("App\Models\Role", "role");
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    public function vacations()
    {
        return $this->hasMany('App\Models\Vacation');
    }

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'orders')->withPivot('date', 'state');
    }

    public function getTitleAttribute() {
        return $this->title = $this->surname.' '.$this->name.' '.$this->patronymic;
    }

    public function isAdmin() {
        return $this->role()->first()->isAdmin();
    }

}
