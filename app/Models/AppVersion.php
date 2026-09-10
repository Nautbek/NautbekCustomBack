<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string app
 * @property integer version_code
 * @property string version_name
 */
class AppVersion extends Model
{
    protected $fillable = [
        'app',
        'version_code',
        'version_name',
    ];
}
