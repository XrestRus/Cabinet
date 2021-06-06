<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Models
 *
 * @property integer $id
 * @property string $title
 * @property string $pdf_path
 */
class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;

    protected $fillable = [
        'title',
        'pdf_path'
    ];

    public function isAdmin() {
        return $this->id === Role::ADMIN;
    }

}
