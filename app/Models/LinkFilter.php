<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkFilter extends Model
{
    protected $table = 'link_filter';

    protected $fillable = [
        'link_id','type','parameter'
    ];
}
