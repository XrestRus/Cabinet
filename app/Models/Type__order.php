<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Type__order
 * @package App\Models
 *
 * @property integer $id
 * @property string $title
 */
class Type__order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];
}
