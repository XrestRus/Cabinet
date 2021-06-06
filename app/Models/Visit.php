<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Visit
 * @package App\Models
 *
 * @property integer $id
 * @property integer $clock
 * @property integer $user_id
 * @property integer $type_mark_id
 * @property Type__mark $type_mark
 * @property Carbon $date
 */
class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'clock',
        'type_mark_id',
        'date',
        'user_id'
    ];

    protected  $casts = [
        "date" => "datetime:Y-m-d",
    ];

    protected $with = [
        "type_mark"
    ];

    public function type_mark() {
        return $this->belongsTo("App\Models\Type__mark");
    }



}
