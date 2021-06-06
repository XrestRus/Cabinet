<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Type__mark
 * @package App\Models
 *
 * @property integer $id
 * @property string $code
 * @property string $title
 */
class Type__mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
    ];
}
