<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Type__transaction
 * @package App\Models
 *
 * @property integer $id
 * @property string $title
 */
class Type__transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];


}
