<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLinkTrack extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'redirect_link_track';

    protected $fillable = [
        'ip','click_count','type','linkid','city','country'
    ];
}
