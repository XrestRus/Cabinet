<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Vacation
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property Carbon $date_start
 * @property Carbon $date_end
 *
 * @property User $user
 * */
class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        "date_start",
        "date_end",
        "user_id"
    ];

    protected $casts = [
        "date_start" => "datetime:Y-m-d",
        "date_end" => "datetime:Y-m-d",
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }
}
