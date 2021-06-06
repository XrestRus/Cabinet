<?php

namespace App\Models;

use FontLib\TrueType\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $photo
 * @property integer $price
 * @property Collection<User> $users
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'photo',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'orders')->withPivot('date', 'state');
    }
}
