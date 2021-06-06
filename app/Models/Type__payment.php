<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Type__payment
 * @package App\Models
 *
 * @property integer $id
 * @property integer $type_transaction_id
 * @property string $title
 * @property Type__transaction $type_transaction
 */
class Type__payment extends Model
{
    use HasFactory;

    protected $with = ['type_transaction'];

    protected $fillable = [
        'title',
        'type_transaction_id',
    ];

    public function type_transaction() {
        return $this->belongsTo("App\Models\Type__transaction");
    }
}
