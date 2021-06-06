<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property Product $product
 * @property User $user
 * @property Type__order $state
 * @property Carbon $date
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'date',
        'state'
    ];

    protected $casts = [
        "date"
    ];

    protected $with = [
        "user",
        "product",
        'state'
    ];

    public function user() {
        return $this->belongsTo("App\Models\User");
    }

    public function product() {
        return $this->belongsTo("App\Models\Product");
    }

    public function state() {
        return $this->belongsTo("App\Models\Type__order", "state");
    }
}
