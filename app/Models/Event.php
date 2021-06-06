<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_author_id
 * @property string $title
 * @property string $desc
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property User $user_author
 */
class Event extends Model
{
    use HasFactory;

    protected $casts = [
        "date_start" => "datetime:Y-m-d",
        "date_end" => "datetime:Y-m-d",
    ];

    protected $with = [
        "user_author"
    ];

    protected $fillable = [
        "title",
        "desc",
        "date_start",
        "date_end",
        "user_author_id",
    ];

    public function user_author()
    {
        return $this->belongsTo('App\Models\User');
    }
}
