<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreateLink extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'create_links';

    protected $fillable = [
        'affilate_link', 'merchent_link', 'filter_by','domain','name'
    ];

    public function redirectCount()
    {
        return $this->hasMany('App\Models\RedirectLinkTrack','linkid', 'id');
    }

}
