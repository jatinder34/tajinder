<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ISP extends Model
{
    protected $table = 'isp';

    protected $fillable = [
        'name',
    ];
}
