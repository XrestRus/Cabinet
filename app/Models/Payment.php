<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Payment
 * @package App\Models
 *
 * @property integer $id
 * @property integer $clock
 * @property integer $days
 * @property integer $sum
 * @property integer $user_id
 * @property User $user
 * @property string $comment
 * @property Carbon $date
 * @property Type__payment $type_payment
 */
class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        "date" => "datetime:Y-m-d"
    ];

    protected $with = [
        "type_payment"
    ];

    protected $fillable = [
        "type_payment",
        "comment",
        "user_id",
        "clock",
        "days",
        "sum",
        "date"
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function type_payment()
    {
        return $this->belongsTo('App\Models\Type__payment', "type_payment");
    }
}
