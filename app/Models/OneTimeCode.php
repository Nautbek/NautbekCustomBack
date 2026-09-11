<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property int code
 */
class OneTimeCode extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];
}
