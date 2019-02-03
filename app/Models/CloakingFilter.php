<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CloakingFilter extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'cloaking_filters';

    protected $fillable = [
        'filter_name'
    ];

}
